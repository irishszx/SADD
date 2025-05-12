<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'admin') {
    header("Location: signin.php");
    exit();
}

// Get filter parameters
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';

// Build the query with filters
$query = "SELECT t.*, u.user_name, u.email 
          FROM transactions t 
          JOIN users u ON t.user_id = u.usersID 
          WHERE 1=1";

$params = [];
$types = "";

if (!empty($status_filter)) {
    $query .= " AND t.status = ?";
    $params[] = $status_filter;
    $types .= "s";
}

if (!empty($date_from)) {
    $query .= " AND DATE(t.transaction_date) >= ?";
    $params[] = $date_from;
    $types .= "s";
}

if (!empty($date_to)) {
    $query .= " AND DATE(t.transaction_date) <= ?";
    $params[] = $date_to;
    $types .= "s";
}

$query .= " ORDER BY t.transaction_date DESC";

// Prepare and execute the query
$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Group transactions by reference number
$groupedTransactions = [];
while ($transaction = $result->fetch_assoc()) {
    $ref = $transaction['reference_number'];
    if (!isset($groupedTransactions[$ref])) {
        $groupedTransactions[$ref] = [
            'user_name' => $transaction['user_name'],
            'email' => $transaction['email'],
            'transaction_date' => $transaction['transaction_date'],
            'status' => $transaction['status'],
            'reference_number' => $ref,
            'items' => [],
            'total_amount' => 0,
            'admin_notes' => $transaction['admin_notes'],
            'confirmation_date' => $transaction['confirmation_date']
        ];
    }
    $groupedTransactions[$ref]['items'][] = $transaction;
    $groupedTransactions[$ref]['total_amount'] += $transaction['amount'];
}

// Define fee details array for display
$feeDetails = [
    'COG' => 'Certificate of Grades (COG)',
    'GOOD_MORAL' => 'Good Moral Certificate',
    'BONAFIDE' => 'Bonafide Student Certificate',
    'ENROLLMENT' => 'Certificate of Enrollment (COE)',
    'PAYMENT' => 'Certification of Payment (O.R.)',
    'COMPLETION' => 'Completion Form',
    'AUTHENTICATION' => 'Authentication of Documents',
    'DISMISSAL' => 'Honorable Dismissal',
    'TRANSCRIPT' => 'Transcript of Record (PER PAGE)',
    'ID' => 'Identification Card',
    'CHANGE_SUBJECT' => 'Adding/Changing/Dropping of Subjects',
    'THESIS' => 'Thesis Fee',
    'OJT' => 'On The Job Training Fee',
    'TEACHING' => 'Practice Teaching Fee'
];

// Function to get status badge class
function getStatusBadgeClass($status) {
    switch ($status) {
        case 'user_confirmed':
            return 'status-pending';
        case 'admin_confirmed':
            return 'status-approved';
        case 'cancelled':
            return 'status-rejected';
        default:
            return 'status-default';
    }
}

// Function to get status display text
function getStatusDisplay($status) {
    switch ($status) {
        case 'user_confirmed':
            return 'Pending Review';
        case 'admin_confirmed':
            return 'Approved';
        case 'cancelled':
            return 'Rejected';
        default:
            return ucfirst($status);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History | Bicol University Polangui</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        :root {
            --primary-color: #478fe2;
            --secondary-color: #ff9100;
            --nav-bg: #4326aa3a;
            --dark-bg: #121212;
            --light-text: #ffffff;
            --muted-text: #bbbbbb;
            --success-color: #4CAF50;
        }
        
        body {
            background: url('image1.jpeg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            min-height: 100vh;
        }
        
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: rgba(0, 0, 0, 0.16);
            position: relative;
            z-index: 1;
        }
        
        .logo {
            display: flex;
            align-items: center;
            color: white;
        }
        
        .logo img {
            height: 50px;
            margin-right: 10px;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .main-content {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: rgba(86, 85, 85, 0.258);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
            color: white;
        }

        .filters {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .filter-group {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .filter-item {
            flex: 1;
        }

        .filter-item label {
            display: block;
            margin-bottom: 5px;
            color: var(--muted-text);
        }

        .filter-item select,
        .filter-item input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #444;
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .filter-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .apply-btn {
            background-color: var(--primary-color);
            color: white;
        }

        .reset-btn {
            background-color: #666;
            color: white;
        }

        .transaction-group {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #444;
        }

        .user-info {
            flex-grow: 1;
        }

        .user-name {
            font-size: 1.2em;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .user-email {
            color: var(--muted-text);
            font-size: 0.9em;
        }

        .reference-number {
            color: var(--primary-color);
            font-weight: bold;
            margin-top: 5px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
            font-weight: bold;
        }

        .status-pending {
            background-color: #ffc107;
            color: #000;
        }

        .status-approved {
            background-color: var(--success-color);
            color: white;
        }

        .status-rejected {
            background-color: #dc3545;
            color: white;
        }

        .transaction-items {
            margin: 15px 0;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #333;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            flex-grow: 1;
        }

        .item-amount {
            font-weight: bold;
            color: var(--success-color);
        }

        .total-amount {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
            color: var(--success-color);
        }

        .admin-notes {
            margin-top: 15px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
        }

        .admin-notes h4 {
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .transaction-date {
            color: var(--muted-text);
            font-size: 0.9em;
        }

        .no-transactions {
            text-align: center;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            color: var(--muted-text);
        }

        .footer {
            margin-top: 50px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            text-align: center;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
            color: white;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .filter-group {
                flex-direction: column;
                gap: 10px;
            }
            
            .transaction-header {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="r.png" alt="BU Logo">
            <span>
                <strong>BICOL UNIVERSITY</strong><br>
                POLANGUI
            </span>
        </div>
        <nav>
            <ul>
                <li><a href="adminhomepage.php">GO TO HOME</a></li>
                <li><a href="admin_manage_transaction.php">MANAGE TRANSACTIONS</a></li>
                <li><a href="admin_transaction_history.php">ADMIN TRANSACTION HISTORY</a></li>
            </ul>
        </nav>
        <p style="color: white;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
        <a href="logout.php" style="color: white; text-decoration: none;">Log Out</a>
    </header>

    <div class="overlay"></div>
    
    <div class="main-content">
        <h1 style="text-align: center; color: var(--primary-color); margin-bottom: 30px;">Transaction History</h1>
        
        <div class="filters">
            <form method="GET" action="">
                <div class="filter-group">
                    <div class="filter-item">
                        <label for="status">Status</label>
                        <select name="status" id="status">
                            <option value="">All Status</option>
                            <option value="user_confirmed" <?php echo $status_filter === 'user_confirmed' ? 'selected' : ''; ?>>Pending Review</option>
                            <option value="admin_confirmed" <?php echo $status_filter === 'admin_confirmed' ? 'selected' : ''; ?>>Approved</option>
                            <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="date_from">Date From</label>
                        <input type="date" name="date_from" id="date_from" value="<?php echo $date_from; ?>">
                    </div>
                    <div class="filter-item">
                        <label for="date_to">Date To</label>
                        <input type="date" name="date_to" id="date_to" value="<?php echo $date_to; ?>">
                    </div>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="filter-btn apply-btn">Apply Filters</button>
                    <a href="admin_transaction_history.php" class="filter-btn reset-btn">Reset</a>
                </div>
            </form>
        </div>
        
        <?php if (!empty($groupedTransactions)): ?>
            <?php foreach ($groupedTransactions as $ref => $group): ?>
                <div class="transaction-group">
                    <div class="transaction-header">
                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($group['user_name']); ?></div>
                            <div class="user-email"><?php echo htmlspecialchars($group['email']); ?></div>
                            <div class="reference-number">Reference: <?php echo htmlspecialchars($ref); ?></div>
                        </div>
                        <div class="transaction-info">
                            <div class="status-badge <?php echo getStatusBadgeClass($group['status']); ?>">
                                <?php echo getStatusDisplay($group['status']); ?>
                            </div>
                            <div class="transaction-date">
                                <?php echo date('M j, Y g:i a', strtotime($group['transaction_date'])); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="transaction-items">
                        <?php foreach ($group['items'] as $item): ?>
                            <div class="item-row">
                                <div class="item-name">
                                    <?php 
                                    if ($item['fee_type'] === 'AUTHENTICATION') {
                                        echo "Authentication - " . htmlspecialchars($item['document_type']);
                                        echo " (" . $item['page_count'] . " pages)";
                                    } else {
                                        echo htmlspecialchars($feeDetails[$item['fee_type']] ?? $item['fee_type']);
                                    }
                                    ?>
                                </div>
                                <div class="item-amount">₱<?php echo number_format($item['amount'], 2); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="total-amount">
                        Total Amount: ₱<?php echo number_format($group['total_amount'], 2); ?>
                    </div>

                    <?php if (!empty($group['admin_notes'])): ?>
                        <div class="admin-notes">
                            <h4>Admin Notes</h4>
                            <p><?php echo nl2br(htmlspecialchars($group['admin_notes'])); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($group['status'] === 'admin_confirmed' && !empty($group['confirmation_date'])): ?>
                        <div class="transaction-date" style="margin-top: 10px;">
                            Confirmed on: <?php echo date('M j, Y g:i a', strtotime($group['confirmation_date'])); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-transactions">
                <p>No transactions found.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>© 2025 Bicol University Polangui. All rights reserved</p>
        <p>Email: bupc-dean@bicol-u.edu.ph</p>
    </div>
</body>
</html> 
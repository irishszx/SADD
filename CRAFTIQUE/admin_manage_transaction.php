<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'admin') {
    header("Location: signin.php");
    exit();
}

// Handle admin actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve'])) {
        $transaction_id = $_POST['transaction_id'];
        $notes = $_POST['admin_notes'] ?? '';
        
        // Debug: Print transaction ID and notes
        error_log("Approving transaction ID: " . $transaction_id . " with notes: " . $notes);
        
        // Update the transaction status
        $stmt = $conn->prepare("UPDATE transactions SET status = 'admin_confirmed', admin_notes = ?, confirmation_date = NOW() WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("si", $notes, $transaction_id);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        
        // Debug: Print affected rows
        error_log("Rows affected: " . $stmt->affected_rows);
        
        // Redirect back to the same page after successful update
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
        
    } elseif (isset($_POST['reject'])) {
        $transaction_id = $_POST['transaction_id'];
        $notes = $_POST['admin_notes'] ?? '';
        
        // Debug: Print transaction ID and notes
        error_log("Rejecting transaction ID: " . $transaction_id . " with notes: " . $notes);
        
        $stmt = $conn->prepare("UPDATE transactions SET status = 'cancelled', admin_notes = ? WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("si", $notes, $transaction_id);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        
        // Debug: Print affected rows
        error_log("Rows affected: " . $stmt->affected_rows);
        
        // Redirect back to the same page after successful update
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Get all pending transactions with user information
$query = "SELECT t.*, u.user_name, u.email 
          FROM transactions t 
          JOIN users u ON t.user_id = u.usersID 
          WHERE t.status = 'user_confirmed' 
          ORDER BY t.transaction_date DESC";
$result = $conn->query($query);

// Group transactions by user and date
$groupedTransactions = [];
while ($transaction = $result->fetch_assoc()) {
    $key = $transaction['user_id'] . '_' . $transaction['transaction_date'];
    if (!isset($groupedTransactions[$key])) {
        $groupedTransactions[$key] = [
            'user_name' => $transaction['user_name'],
            'email' => $transaction['email'],
            'transaction_date' => $transaction['transaction_date'],
            'items' => [],
            'total_amount' => 0
        ];
    }
    $groupedTransactions[$key]['items'][] = $transaction;
    $groupedTransactions[$key]['total_amount'] += $transaction['amount'];
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Transaction Management | Bicol University Polangui</title>
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
        
        body, html {
            height: 100%;
        }
        
        body {
            background: url('image1.jpeg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
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
            margin-left: 60px;
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

        .page-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .page-subtitle {
            color: var(--secondary-color);
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        
        .divider {
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin: 0 auto 30px;
        }

        .transaction-group {
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .transaction-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .admin-actions {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #444;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid #444;
            color: white;
            border-radius: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .approve-btn, .reject-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .approve-btn {
            background-color: var(--success-color);
            color: white;
        }

        .approve-btn:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
        }

        .reject-btn:hover {
            background-color: #da190b;
            transform: translateY(-3px);
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
                margin-left: 0;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
            
            .page-subtitle {
                font-size: 1rem;
            }
            
            .transaction-group {
                margin: 10px;
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
                <li><a href="admin_transaction_history.php">TRANSACTION HISTORY</a></li>
            </ul>
        </nav>
        <p style="color: white;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
        <a href="logout.php" style="color: white; text-decoration: none;">Log Out</a>
    </header>

    <div class="overlay"></div>
    
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Transaction Management</h1>
            <p class="page-subtitle">Admin Dashboard</p>
            <div class="divider"></div>
        </div>
        
        <?php if (!empty($groupedTransactions)): ?>
            <?php foreach ($groupedTransactions as $key => $group): ?>
                <div class="transaction-group">
                    <div class="transaction-header">
                        <div class="user-info">
                            <div class="user-name"><?php echo htmlspecialchars($group['user_name']); ?></div>
                            <div class="user-email"><?php echo htmlspecialchars($group['email']); ?></div>
                            <div class="reference-number">Reference: <?php echo htmlspecialchars($group['items'][0]['reference_number'] ?? 'N/A'); ?></div>
                        </div>
                        <div class="transaction-date">
                            <?php echo date('M j, Y g:i a', strtotime($group['transaction_date'])); ?>
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
                    
                    <div class="admin-actions">
                        <form method="post" class="action-form">
                            <input type="hidden" name="transaction_id" value="<?php echo $item['id']; ?>">
                            <textarea name="admin_notes" placeholder="Add admin notes..."></textarea>
                            <div class="action-buttons">
                                <button type="submit" name="approve" class="approve-btn">Approve</button>
                                <button type="submit" name="reject" class="reject-btn">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-transactions">
                <p>No pending transactions requiring approval.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>© 2025 Bicol University Polangui. All rights reserved</p>
        <p>Email: bupc-dean@bicol-u.edu.ph</p>
    </div>
</body>
</html>
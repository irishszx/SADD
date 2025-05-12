<?php
session_start();
include 'db_connection.php';

// Debug: Print session data
echo "<!-- Debug: Session data: ";
print_r($_SESSION);
echo " -->";

// Check if user is logged in
if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'user') {
    header("Location: signin.php");
    exit();
}

// Get user's transactions including approved ones
$query = "SELECT t.*, u.user_name 
          FROM transactions t 
          JOIN users u ON t.user_id = u.usersID 
          WHERE t.user_id = ? 
          ORDER BY t.transaction_date DESC";

// Debug: Print the query and user ID
echo "<!-- Debug: Query = " . $query . " -->";
echo "<!-- Debug: User ID = " . $_SESSION['usersID'] . " -->";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $_SESSION['usersID']);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

// Debug: Print number of results and first row
echo "<!-- Debug: Number of transactions found = " . $result->num_rows . " -->";
if ($result->num_rows > 0) {
    $first_row = $result->fetch_assoc();
    echo "<!-- Debug: First row data: ";
    print_r($first_row);
    echo " -->";
    // Reset the result pointer
    $result->data_seek(0);
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

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            overflow: hidden;
        }

        .transaction-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: left;
        }

        .transaction-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .transaction-table tr:last-child td {
            border-bottom: none;
        }

        .status-pending {
            color: var(--secondary-color);
            font-weight: bold;
        }

        .status-approved {
            color: var(--success-color);
            font-weight: bold;
        }

        .status-rejected {
            color: #f44336;
            font-weight: bold;
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
            
            .transaction-table {
                display: block;
                overflow-x: auto;
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
                <li><a href="user_homepage.php">GO TO HOMEPAGE</a></li>
                
                <li><a href="transactionpage.php">TRANSACT NOW</a></li>
                <li><a href="user_transaction_history.php">TRANSACTION HISTORY</a></li>
            </ul>
        </nav>
        <p style="color: white;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
        <a href="logout.php" style="color: white; text-decoration: none;">Log Out</a>
    </header>

    <div class="overlay"></div>
    
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Transaction History</h1>
            <p class="page-subtitle">View your payment requests and their status</p>
            <div class="divider"></div>
        </div>
        
        <?php if ($result->num_rows > 0): ?>
            <table class="transaction-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Reference Number</th>
                        <th>Item</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Admin Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($transaction = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo date('M j, Y g:i a', strtotime($transaction['transaction_date'])); ?></td>
                            <td><?php echo htmlspecialchars($transaction['reference_number'] ?? 'N/A'); ?></td>
                            <td>
                                <?php 
                                if ($transaction['fee_type'] === 'AUTHENTICATION') {
                                    echo "Authentication - " . htmlspecialchars($transaction['document_type']);
                                    echo " (" . $transaction['page_count'] . " pages)";
                                } else {
                                    echo htmlspecialchars($feeDetails[$transaction['fee_type']] ?? $transaction['fee_type']);
                                }
                                ?>
                            </td>
                            <td>₱<?php echo number_format($transaction['amount'], 2); ?></td>
                            <td class="status-<?php echo strtolower($transaction['status']); ?>">
                                <?php 
                                switch($transaction['status']) {
                                    case 'user_confirmed':
                                        echo 'Pending Review';
                                        break;
                                    case 'admin_confirmed':
                                        echo 'Approved';
                                        break;
                                    case 'cancelled':
                                        echo 'Rejected';
                                        break;
                                    default:
                                        echo ucfirst($transaction['status']);
                                }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($transaction['admin_notes'] ?? '-'); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-transactions">
                <p>No transactions found. Your payment history will appear here once you make a payment.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>© 2025 Bicol University Polangui. All rights reserved</p>
        <p>Email: bupc-dean@bicol-u.edu.ph</p>
    </div>
</body>
</html>
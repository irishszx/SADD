<?php
session_start();
include 'db_connection.php'; // Include your database connection file

// Check if user is logged in and role is user
if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'user') {
    header("Location: signin.php");
    exit();
}

// Function to generate reference number
function generateReferenceNumber() {
    $prefix = 'BU';
    $timestamp = date('YmdHis');
    $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    return $prefix . $timestamp . $random;
}

// Initialize variables
$currentTotal = 0;
$selectedFees = [];
$selectedDocs = [];
$error = "";
$confirmationMessage = "";

// Store transaction data in local variables before processing
$transactionData = [];
if (isset($_SESSION['transaction_data'])) {
    $transactionData = $_SESSION['transaction_data'];
}

// Check if transaction data exists and is valid
if (empty($transactionData) || !isset($transactionData['fees']) || !is_array($transactionData['fees'])) {
    header("Location: transactionpage.php");
    exit();
}

// Define fee details array
$feeDetails = [
    'COG' => ['name' => 'Certificate of Grades (COG)', 'amount' => 20],
    'GOOD_MORAL' => ['name' => 'Good Moral Certificate', 'amount' => 20],
    'BONAFIDE' => ['name' => 'Bonafide Student Certificate', 'amount' => 20],
    'ENROLLMENT' => ['name' => 'Certificate of Enrollment (COE)', 'amount' => 20],
    'PAYMENT' => ['name' => 'Certification of Payment (O.R.)', 'amount' => 20],
    'COMPLETION' => ['name' => 'Completion Form', 'amount' => 20],
    'AUTHENTICATION' => ['name' => 'Authentication of Documents', 'amount' => 0],
    'DISMISSAL' => ['name' => 'Honorable Dismissal', 'amount' => 75],
    'TRANSCRIPT' => ['name' => 'Transcript of Record (PER PAGE)', 'amount' => 30],
    'ID' => ['name' => 'Identification Card', 'amount' => 75],
    'CHANGE_SUBJECT' => ['name' => 'Adding/Changing/Dropping of Subjects', 'amount' => 20],
    'THESIS' => ['name' => 'Thesis Fee', 'amount' => 1200],
    'OJT' => ['name' => 'On The Job Training Fee', 'amount' => 200],
    'TEACHING' => ['name' => 'Practice Teaching Fee', 'amount' => 1000]
];

// Process form submission for confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['usersID'];
    $totalAmount = 0;
    $error = "";

    // Generate reference number for this transaction
    $referenceNumber = generateReferenceNumber();

    // Get user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE usersID = ?");
    if ($stmt === false) {
        $error = "Database error: " . $conn->error;
    } else {
        $stmt->bind_param("i", $userId);
        if (!$stmt->execute()) {
            $error = "Failed to get user ID: " . $stmt->error;
        } else {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                // Process selected fees
                foreach ($transactionData['fees'] as $feeCode) {
                    if (array_key_exists($feeCode, $feeDetails)) {
                        $itemAmount = $feeDetails[$feeCode]['amount'];
                        $totalAmount += $itemAmount;
                        
                        // Insert fee transaction with reference number
                        $insertStmt = $conn->prepare("INSERT INTO transactions (user_id, fee_type, amount, status, transaction_date, reference_number) VALUES (?, ?, ?, 'user_confirmed', NOW(), ?)");
                        if ($insertStmt === false) {
                            $error = "Database error: " . $conn->error;
                            break;
                        }
                        $insertStmt->bind_param("isds", $userId, $feeCode, $itemAmount, $referenceNumber);
                        if (!$insertStmt->execute()) {
                            $error = "Failed to save transaction: " . $insertStmt->error;
                            $insertStmt->close();
                            break;
                        }
                        $insertStmt->close();
                    }
                }

                // Process authentication documents if selected
                if (empty($error) && isset($transactionData['documents'])) {
                    foreach ($transactionData['documents'] as $docType => $pages) {
                        if (intval($pages) > 0) {
                            $docAmount = intval($pages) * 10; // ₱10 per page
                            $totalAmount += $docAmount;
                            
                            // Insert document transaction with reference number
                            $insertStmt = $conn->prepare("INSERT INTO transactions (user_id, fee_type, document_type, page_count, amount, status, transaction_date, reference_number) VALUES (?, 'AUTHENTICATION', ?, ?, ?, 'user_confirmed', NOW(), ?)");
                            if ($insertStmt === false) {
                                $error = "Database error: " . $conn->error;
                                break;
                            }
                            $insertStmt->bind_param("isids", $userId, $docType, $pages, $docAmount, $referenceNumber);
                            if (!$insertStmt->execute()) {
                                $error = "Failed to save transaction: " . $insertStmt->error;
                                $insertStmt->close();
                                break;
                            }
                            $insertStmt->close();
                        }
                    }
                }
            } else {
                $error = "User not found in database";
            }
        }
        $stmt->close();
    }

    if (empty($error)) {
        $confirmationMessage = "Transaction confirmed successfully!<br>Reference Number: " . $referenceNumber . "<br>Total Amount: ₱" . number_format($totalAmount, 2);
        // Clear transaction data from session after confirmation
        unset($_SESSION['transaction_data']);
    }
    
    $conn->close();
}

// Calculate current total for display
$currentTotal = isset($transactionData['total_amount']) ? $transactionData['total_amount'] : 0;

// Process fees for display
if (isset($transactionData['fees']) && is_array($transactionData['fees'])) {
    foreach ($transactionData['fees'] as $feeCode) {
        if (array_key_exists($feeCode, $feeDetails)) {
            $selectedFees[] = [
                'code' => $feeCode,
                'name' => $feeDetails[$feeCode]['name'],
                'amount' => $feeDetails[$feeCode]['amount']
            ];
        }
    }
}

// Process documents for display
if (isset($transactionData['documents']) && is_array($transactionData['documents'])) {
    foreach ($transactionData['documents'] as $docType => $pages) {
        if (intval($pages) > 0) {
            $docAmount = intval($pages) * 10;
            $selectedDocs[] = [
                'type' => $docType,
                'pages' => intval($pages),
                'amount' => $docAmount
            ];
        }
    }
}

// Debug information
error_log('Transaction Data: ' . print_r($transactionData, true));
error_log('Selected Fees: ' . print_r($selectedFees, true));
error_log('Selected Docs: ' . print_r($selectedDocs, true));
error_log('Current Total: ' . $currentTotal);

function getFeeName($feeCode) {
    $feeNames = [
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
    return $feeNames[$feeCode] ?? $feeCode;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Confirm Transaction | Bicol University Polangui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image1.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            color: white;
        }
        .overlay {
            position: fixed;
            top:0; left:0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.6);
            z-index: 0;
        }
        .container {
            position: relative;
            max-width: 700px;
            margin: 60px auto;
            background-color: rgba(0,0,0,0.75);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.9);
            z-index: 1;
        }
        h1 {
            color: #478fe2;
            margin-bottom: 20px;
            text-align: center;
        }
        h2 {
            color: #ff9100;
            margin-bottom: 10px;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        ul li {
            padding: 8px 0;
            border-bottom: 1px solid #555;
        }
        .total {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 20px;
            text-align: right;
            color: #4CAF50;
        }
        .buttons {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .button {
            background-color: #ff9100;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            color: #121212;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
            line-height: 1;
        }
        .button:hover {
            background-color: #e68200;
        }
        .button-cancel {
            background-color: transparent;
            border: 2px solid #ff9100;
            color: white;
        }
        .button-cancel:hover {
            background-color: #ff9100;
            color: #121212;
        }
        .message {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: bold;
        }
        .error {
            background-color: #d9534f;
            color: white;
            padding: 12px 20px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: bold;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 25px;
            background-color: rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 2;
            color: white;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            height: 45px;
            margin-right: 12px;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-info a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        .user-info a:hover {
            text-decoration: underline;
        }
        @media(max-width: 600px) {
            .container {
                margin: 20px 15px;
                padding: 20px;
            }
            .buttons {
                flex-direction: column;
                gap: 15px;
            }
            .button {
                width: 100%;
                font-size: 1rem;
                padding: 12px;
            }
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .item-details:last-child {
            border-bottom: none;
        }
        .item-name {
            flex-grow: 1;
        }
        .item-amount {
            font-weight: bold;
            color: #4CAF50;
        }
        .document-details {
            margin-left: 20px;
            font-size: 0.9em;
            color: #ccc;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="r.png" alt="BU Logo" />
        <span><strong>BICOL UNIVERSITY</strong><br/>POLANGUI</span>
    </div>
    <nav>
        <ul>
            <li><a href="user_homepage.php">About Us</a></li>
            <li><a href="user_homepage.php">Mission & Vision</a></li>
            <li><a href="transactionpage.php">Transact Now</a></li>
            <li><a href="transactionhistory.html">Transaction History</a></li>
        </ul>
    </nav>
    <div class="user-info">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
        <a href="logout.php">Log Out</a>
    </div>
</header>

<div class="overlay"></div>

<div class="container">
    <h1>Confirm Your Transaction</h1>

    <?php if (!empty($confirmationMessage)) : ?>
        <div class="message"><?php echo $confirmationMessage; ?></div>
        <div style="text-align:center;">
            <a href="user_homepage.php" class="button" style="max-width: 250px;">Go to Home Page</a>
        </div>
    <?php else: ?>

        <?php if (!empty($error)) : ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <h2>Selected Items</h2>
        <?php if (empty($selectedFees) && empty($selectedDocs)): ?>
            <p>No items selected.</p>
        <?php else: ?>
            <div class="selected-items">
                <?php foreach ($selectedFees as $fee): ?>
                    <div class="item-details">
                        <span class="item-name"><?php echo htmlspecialchars($fee['name']); ?></span>
                        <span class="item-amount">₱<?php echo number_format($fee['amount'], 2); ?></span>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($selectedDocs as $doc): ?>
                    <div class="item-details">
                        <div class="item-name">
                            Authentication - <?php echo htmlspecialchars($doc['type']); ?>
                            <div class="document-details">
                                <?php echo $doc['pages']; ?> pages
                            </div>
                        </div>
                        <span class="item-amount">₱<?php echo number_format($doc['amount'], 2); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="total">
            Total Amount: ₱<?php echo number_format($currentTotal, 2); ?>
        </div>

        <form method="POST" action="">
            <div class="buttons">
                <a href="transactionpage.php" class="button button-cancel">Back to Transaction</a>
                <button type="submit" class="button">Confirm Transaction</button>
            </div>
        </form>

    <?php endif; ?>
</div>

</body>
</html>


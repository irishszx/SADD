<?php
session_start();
include 'db_connection.php'; // Include your database connection file

// Check if user is logged in and role is user
if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'user') {
    header("Location: signin.php");
    exit();
}

// Check if transaction data exists in session
if (!isset($_SESSION['transaction_data'])) {
    // No transaction data, redirect back to transaction page
    header("Location: transactionpage.php");
    exit();
}

// Retrieve transaction data from session
$transactionData = $_SESSION['transaction_data'];
$feesSelected = $transactionData['fees'] ?? [];
$documentsSelected = $transactionData['documents'] ?? [];

// Process form submission for confirmation
$confirmationMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: Insert transaction to the database (example placeholder)
    // Assuming there is a transactions table with user_id, details, total_amount, status, created_at

    $userName = $_SESSION['user_name']; // or fetch user_id from session/database

    // Calculate total amount again on server side for security
    $feesList = [
        'COG' => 20,
        'GOOD_MORAL' => 20,
        'BONAFIDE' => 20,
        'ENROLLMENT' => 20,
        'PAYMENT' => 20,
        'COMPLETION' => 20,
        'AUTHENTICATION' => 0, // amount depends on documents
        'DISMISSAL' => 75,
        'TRANSCRIPT' => 30,
        'ID' => 75,
        'CHANGE_SUBJECT' => 20,
        'THESIS' => 1200,
        'OJT' => 200,
        'TEACHING' => 1000
    ];

    // Sum fees amount
    $totalAmount = 0;
    foreach ($feesSelected as $fee) {
        if (array_key_exists($fee, $feesList)) {
            $totalAmount += $feesList[$fee];
        }
    }

    // Calculate authentication documents fees (₱10 per page)
   foreach ($transactionData['fees'] as $feeCode) {
    if (array_key_exists($feeCode, $feeDetails)) {
        $itemAmount = $feeDetails[$feeCode]['amount'];
        $totalAmount += $itemAmount;
        
        $selectedItems[] = [
            'name' => $feeDetails[$feeCode]['name'],
            'amount' => $itemAmount,
            'type' => 'fee'
        ];
    }
}

    // Prepare transaction details summary
    $details = json_encode([
        'fees' => $feesSelected,
        'documents' => $documentsSelected
    ]);

    // Placeholder user_id as username, replace with actual user_id if you have it
    $user_id = $userName;

    // Insert transaction into database (adjust query and columns as per your schema)
    $conn = OpenCon();
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, details, total_amount, status, created_at) VALUES (?, ?, ?, 'Pending', NOW())");
    if ($stmt === false) {
        $error = "Database error: " . $conn->error;
    } else {
        $stmt->bind_param("ssd", $user_id, $details, $totalAmount);
        if ($stmt->execute()) {
            $confirmationMessage = "Transaction confirmed successfully! Total Amount: ₱" . number_format($totalAmount, 2);
            // Clear transaction data from session after confirmation
            unset($_SESSION['transaction_data']);
            $feesSelected = [];
            $documentsSelected = [];
        } else {
            $error = "Failed to save transaction: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
}

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

        <h2>Fees Selected</h2>
        <?php if (empty($feesSelected)): ?>
            <p>No fees selected.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($feesSelected as $fee): ?>
                    <li><?php echo htmlspecialchars(getFeeName($fee)); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (in_array('AUTHENTICATION', $feesSelected)) : ?>
            <h2>Authentication Document Pages</h2>
            <?php if (empty($documentsSelected)) : ?>
                <p>No documents selected.</p>
            <?php else : ?>
                <ul>
                    <?php foreach ($documentsSelected as $docType => $pages): ?>
                        <?php if (intval($pages) > 0): ?>
                            <li><?php echo htmlspecialchars($docType); ?>: <?php echo intval($pages); ?> pages (₱<?php echo intval($pages) * 10; ?>)</li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

        <div class="total">
            <?php
                $totalAmount = 0;
                $feesList = [
                    'COG' => 20,
                    'GOOD_MORAL' => 20,
                    'BONAFIDE' => 20,
                    'ENROLLMENT' => 20,
                    'PAYMENT' => 20,
                    'COMPLETION' => 20,
                    'AUTHENTICATION' => 0,
                    'DISMISSAL' => 75,
                    'TRANSCRIPT' => 30,
                    'ID' => 75,
                    'CHANGE_SUBJECT' => 20,
                    'THESIS' => 1200,
                    'OJT' => 200,
                    'TEACHING' => 1000
                ];
                foreach ($feesSelected as $fee) {
                    if (array_key_exists($fee, $feesList)) {
                        $totalAmount += $feesList[$fee];
                    }
                }
                if (in_array('AUTHENTICATION', $feesSelected)) {
                    foreach ($documentsSelected as $pages) {
                        $pagesInt = intval($pages);
                        if ($pagesInt > 0) {
                            $totalAmount += 10 * $pagesInt;
                        }
                    }
                }
                echo "Total Amount: ₱" . number_format($totalAmount, 2);
            ?>
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


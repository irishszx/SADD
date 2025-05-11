<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_name'])) {
    header("Location: signin.php");
    exit();
}

$user_id = $_SESSION['usersID'];
$query = "SELECT * FROM transactions WHERE user_id = ? ORDER BY transaction_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Transaction History</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .status-pending { color: orange; }
        .status-confirmed { color: green; }
        .status-cancelled { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Transaction History</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fee Type</th>
                    <th>Document</th>
                    <th>Pages</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($transaction = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $transaction['id']; ?></td>
                    <td><?php echo htmlspecialchars($transaction['fee_type']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['document_type'] ?? 'N/A'); ?></td>
                    <td><?php echo $transaction['page_count'] ?? '0'; ?></td>
                    <td>₱<?php echo number_format($transaction['amount'], 2); ?></td>
                    <td><?php echo date('M j, Y g:i a', strtotime($transaction['transaction_date'])); ?></td>
                    <td class="status-<?php echo strtolower($transaction['status']); ?>">
                        <?php echo ucfirst($transaction['status']); ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
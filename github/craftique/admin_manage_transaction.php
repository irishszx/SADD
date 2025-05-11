<?php
session_start();
include '../db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_name']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../signin.php");
    exit();
}

// Handle admin actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve'])) {
        $transaction_id = $_POST['transaction_id'];
        $notes = $_POST['admin_notes'] ?? '';
        
        $stmt = $conn->prepare("UPDATE transactions SET admin_confirmed = TRUE, status = 'admin_confirmed', admin_notes = ? WHERE id = ?");
        $stmt->bind_param("si", $notes, $transaction_id);
        $stmt->execute();
        
    } elseif (isset($_POST['reject'])) {
        $transaction_id = $_POST['transaction_id'];
        $notes = $_POST['admin_notes'] ?? '';
        
        $stmt = $conn->prepare("UPDATE transactions SET status = 'cancelled', admin_notes = ? WHERE id = ?");
        $stmt->bind_param("si", $notes, $transaction_id);
        $stmt->execute();
    }
}

// Get all pending transactions with user information
$query = "SELECT t.*, u.user_name, u.email 
          FROM transactions t 
          JOIN users u ON t.user_id = u.usersID 
          WHERE t.status = 'user_confirmed' 
          ORDER BY t.transaction_date DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Transaction Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 60px;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .approve-btn {
            background-color: #2ecc71;
            color: white;
        }
        .approve-btn:hover {
            background-color: #27ae60;
        }
        .reject-btn {
            background-color: #e74c3c;
            color: white;
        }
        .reject-btn:hover {
            background-color: #c0392b;
        }
        .status-pending {
            color: #f39c12;
            font-weight: 600;
        }
        .status-confirmed {
            color: #2ecc71;
            font-weight: 600;
        }
        .status-cancelled {
            color: #e74c3c;
            font-weight: 600;
        }
        .user-info {
            display: flex;
            flex-direction: column;
        }
        .user-name {
            font-weight: 600;
        }
        .user-email {
            font-size: 0.9em;
            color: #7f8c8d;
        }
        .no-transactions {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Transaction Management</h1>
        
        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>User</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($transaction = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $transaction['id']; ?></td>
                    <td>
                        <div class="user-info">
                            <span class="user-name"><?php echo htmlspecialchars($transaction['user_name']); ?></span>
                            <span class="user-email"><?php echo htmlspecialchars($transaction['email']); ?></span>
                        </div>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($transaction['fee_type']); ?>
                        <?php if ($transaction['document_type']): ?>
                            <br><small>Document: <?php echo htmlspecialchars($transaction['document_type']); ?></small>
                        <?php endif; ?>
                    </td>
                    <td>₱<?php echo number_format($transaction['amount'], 2); ?></td>
                    <td><?php echo date('M j, Y g:i a', strtotime($transaction['transaction_date'])); ?></td>
                    <td class="status-<?php echo str_replace('_', '-', strtolower($transaction['status'])); ?>">
                        <?php echo ucwords(str_replace('_', ' ', $transaction['status'])); ?>
                    </td>
                    <td>
                        <form method="post" class="action-form">
                            <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                            <textarea name="admin_notes" placeholder="Add admin notes..."><?php echo htmlspecialchars($transaction['admin_notes'] ?? ''); ?></textarea>
                            <div class="action-buttons">
                                <button type="submit" name="approve" class="approve-btn">Approve</button>
                                <button type="submit" name="reject" class="reject-btn">Reject</button>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="no-transactions">
            <p>No pending transactions requiring approval.</p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
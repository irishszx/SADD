<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bicol University - Transaction History</title>
    <style>
        :root {
            --primary-color: #478fe2; /* Blue */
            --secondary-color: #ff9100; /* Orange */
            --nav-bg: #4326aa3a;
            --dark-bg: #121212;
            --light-text: #ffffff;
            --muted-text: #bbbbbb;
        }
        
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), 
                        url('.vscode/bu-torch-of-wisdom_1_orig.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--light-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            min-height: 100vh;
        }
        
        /* Navigation Bar */
        .nav-bar {
            background-color: var(--nav-bg);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .nav-logo {
            height: 50px;
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        
        .bu-text {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .polangui-text {
            color: var(--secondary-color);
            font-weight: bold;
            font-size: 1rem;
        }
        
        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        .nav-link {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--secondary-color);
            background-color: rgba(255, 215, 0, 0.1);
        }
        
        /* User Dropdown Styles */
        .user-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            margin-left: 10px;
            cursor: pointer;
        }
        
        .user-info-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-name-display {
            font-weight: 600;
            color: var(--light-text);
        }
        
        .user-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
        }
        
        .user-circle:hover {
            background-color: var(--secondary-color);
            color: var(--dark-bg);
            transform: scale(1.1);
        }
        
        .user-circle i {
            font-size: 1.2rem;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--nav-bg);
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            border-radius: 5px;
            z-index: 1;
            overflow: hidden;
            margin-top: 10px;
        }
        
        .dropdown-content a {
            color: var(--light-text);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }
        
        .dropdown-content a:hover {
            background-color: rgba(255, 215, 0, 0.1);
            color: var(--secondary-color);
        }
        
        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 0;
        }
        
        .user-dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown-user-info {
            padding: 12px 16px;
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dropdown-user-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .dropdown-user-email {
            font-size: 0.8rem;
            color: var(--muted-text);
        }
        
        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .header {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .sub-header {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 20px;
            color: var(--secondary-color);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        
        .divider {
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin: 20px 0;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .transaction-container {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 30px;
            margin-top: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .transaction-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--primary-color);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }
        
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .transaction-table th {
            background-color: rgba(71, 143, 226, 0.2);
            color: var(--primary-color);
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .transaction-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .transaction-table tr:last-child td {
            border-bottom: none;
        }
        
        .transaction-table tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .amount {
            text-align: right;
            font-weight: 500;
        }
        
        .no-transactions {
            text-align: center;
            padding: 40px;
            color: var(--muted-text);
            font-style: italic;
        }
        
        .footer {
            margin-top: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted-text);
        }
        
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .header {
                font-size: 2rem;
            }
            
            .sub-header {
                font-size: 1.2rem;
            }
            
            .dropdown-content {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }
            
            .user-name-display {
                display: none;
            }
            
            .transaction-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="nav-bar">
    <div class="nav-container">
        <div class="logo-container">
            <img src=".vscode/R.png" alt="Bicol University Logo" class="nav-logo">
            <div class="logo-text">
                <span class="bu-text">Bicol University</span>
                <span class="polangui-text">Polangui</span>
            </div>
        </div>
        <div class="nav-links">
            <a href="homeuser.php" class="nav-link">Home</a>
            <a href="aboutus.php" class="nav-link">About Us</a>
            <a href="#" class="nav-link active">Transaction History</a>
            <a href="fees.php" class="nav-link">Fees</a>
            <a href="help.php" class="nav-link">Help</a>
            <div class="user-dropdown" id="userDropdown">
                <div class="user-info-container">
                    <div class="user-circle">
                    <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="dropdown-content">
                    <div class="dropdown-user-info">
                        <div class="dropdown-user-name" id="dropdownUserName">Loading...</div>
                        <div class="dropdown-user-email" id="dropdownUserEmail">Loading...</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <h2 class="sub-header">CASHIER'S ONLINE PAYMENT TRANSACTION</h2>
    <div class="divider"></div>

    <div class="transaction-container">
        <h3 class="transaction-title">TRANSACTION HISTORY</h3>
        
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>TYPES OF FEE</th>
                    <th>QUANTITY</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody id="transactionHistory">
                <!-- Transaction data will be loaded dynamically -->
            </tbody>
        </table>
        <div id="noTransactionsMessage" class="no-transactions" style="display: none;">
            No transactions found. Your payment history will appear here once you make a payment.
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2023 Bicol University Polangui. All Rights Reserved.</p>
</div>

<script>
    // This will fetch the actual user data and transaction history from your backend
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch user data
        fetchUserData();
        
        // Fetch transaction history
        fetchTransactionHistory();
    });

    async function fetchUserData() {
        try {
            // In a real application, this would call your backend API
            // Example:
            // const response = await fetch('/api/user', {
            //     headers: {
            //         'Authorization': `Bearer ${localStorage.getItem('token')}`
            //     }
            // });
            // const userData = await response.json();
            
            // For now, we'll simulate an empty response
            const userData = await new Promise(resolve => {
                setTimeout(() => {
                    resolve({
                        firstName: "",
                        fullName: "",
                        email: ""
                    });
                }, 500);
            });
            
            // Update UI with user data
            document.getElementById('userNameDisplay').textContent = userData.fullName || "User";
            document.getElementById('dropdownUserName').textContent = userData.fullName || "User";
            document.getElementById('dropdownUserEmail').textContent = userData.email || "";
            
        } catch (error) {
            console.error('Error fetching user data:', error);
        }
    }

    async function fetchTransactionHistory() {
        try {
            // In a real application, this would call your backend API
            // Example:
            // const response = await fetch('/api/transactions', {
            //     headers: {
            //         'Authorization': `Bearer ${localStorage.getItem('token')}`
            //     }
            // });
            // const transactions = await response.json();
            
            // For now, we'll simulate an empty response
            const transactions = await new Promise(resolve => {
                setTimeout(() => {
                    resolve([]); // Empty array means no transactions
                }, 800);
            });
            
            renderTransactionHistory(transactions);
            
        } catch (error) {
            console.error('Error fetching transaction history:', error);
            document.getElementById('noTransactionsMessage').style.display = 'block';
            document.getElementById('noTransactionsMessage').textContent = 
                'Error loading transaction history. Please try again later.';
        }
    }

    function renderTransactionHistory(transactions) {
        const tbody = document.getElementById('transactionHistory');
        const noTransactionsMessage = document.getElementById('noTransactionsMessage');
        
        // Clear existing rows
        tbody.innerHTML = '';
        
        if (transactions.length === 0) {
            noTransactionsMessage.style.display = 'block';
            return;
        }
        
        noTransactionsMessage.style.display = 'none';
        
        // Add each transaction to the table
        transactions.forEach(transaction => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${formatDate(transaction.date)}</td>
                <td>${transaction.type}</td>
                <td>${transaction.quantity}</td>
                <td class="amount">₱${transaction.amount.toFixed(2)}</td>
            `;
            tbody.appendChild(row);
        });
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        });
    }
    
    // Logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to logout?')) {
            // In a real application, this would call your logout API
            // Then redirect to login page
            alert('Logging out...');
            window.location.href = 'login.html';
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        if (!dropdown.contains(e.target)) {
            const dropdownContent = dropdown.querySelector('.dropdown-content');
            dropdownContent.style.display = 'none';
        }
    });
</script>

</body>
</html>
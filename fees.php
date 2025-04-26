<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fees Payment | Bicol University Polangui</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #478fe2; /* Blue */
            --secondary-color: #ff9100; /* Orange */
            --nav-bg: #4326aa3a;
            --dark-bg: #121212;
            --light-text: #ffffff;
            --muted-text: #bbbbbb;
            --success-color: #4CAF50;
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
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
        
        /* Fees Table */
        .fees-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .fees-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        .fees-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .fees-table tr:last-child td {
            border-bottom: none;
        }
        
        .fees-table tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        .total-row {
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.3);
        }
        
        .total-row td {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        
        /* Checkbox Styling */
        .checkbox-container {
            display: flex;
            align-items: center;
        }
        
        .checkbox-custom {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            accent-color: var(--secondary-color);
            cursor: pointer;
        }
        
        /* Buttons */
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .button {
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            cursor: pointer;
        }
        
        .button-back {
            background-color: transparent;
            color: var(--light-text);
            border-color: var(--light-text);
        }
        
        .button-back:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
        }
        
        .button-transact {
            background-color: var(--secondary-color);
            color: var(--dark-bg);
        }
        
        .button-transact:hover {
            background-color: #e68200;
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(255, 145, 0, 0.4);
        }
        
        .button i {
            margin-right: 8px;
        }
        
        /* Footer */
        .footer {
            margin-top: 50px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            text-align: center;
            font-size: 0.9rem;
            color: var(--muted-text);
        }
        
        /* Fee Category Sections */
        .fee-category {
            margin-bottom: 30px;
        }
        
        .category-title {
            color: var(--secondary-color);
            font-size: 1.3rem;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid rgba(255, 145, 0, 0.3);
        }
        
        /* Document Type Selection */
        .document-types {
            margin-top: 10px;
            padding-left: 20px;
        }
        
        .document-type {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .document-checkbox {
            margin-right: 10px;
            accent-color: var(--secondary-color);
        }
        
        .page-count {
            margin-left: 10px;
            width: 40px;
            padding: 3px;
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid var(--muted-text);
            border-radius: 3px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .main-content {
                padding: 20px;
                margin: 20px;
            }
            
            .button-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .button {
                width: 100%;
            }
            
            .dropdown-content {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }
            
            .document-types {
                padding-left: 10px;
            }
            
            .document-type {
                flex-wrap: wrap;
            }
            
            .page-count {
                margin-left: 5px;
            }
        }
    </style>
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
            <a href="homeuser.php" class="nav-link"></i> Home</a>
            <a href="aboutus.php" class="nav-link"></i> About Us</a>
            <a href="transactionhistory.php" class="nav-link"></i> Transaction History</a>
            <a href="fees.php" class="nav-link"></i> Fees</a>
            <a href="help.php" class="nav-link"></i> Help</a>
            <div class="user-dropdown" id="userDropdown">
                <div class="user-info-container">
                    <div class="user-circle">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="dropdown-content">
    <div class="dropdown-user-info">
        <div class="dropdown-user-name" id="dropdownUserName">Juan Dela Cruz</div>
        <div class="dropdown-user-email" id="dropdownUserEmail">juandelacruz@bicol-u.edu.ph</div>
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
    <div class="page-header">
        <h1 class="page-title">UNIVERSITY FEES PAYMENT</h1>
        <p class="page-subtitle">Cashier's Online Payment Transaction</p>
        <div class="divider"></div>
    </div>
    
    <!-- Certification Fees Section -->
    <div class="fee-category">
        <h3 class="category-title"><i class="fas fa-certificate"></i> CERTIFICATION FEES</h3>
        <table class="fees-table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Fees to be Paid</th>
                    <th>Amount (₱)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="COG"></div></td>
                    <td>CERTIFICATE OF GRADES (COG)</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="GOOD_MORAL"></div></td>
                    <td>GOOD MORAL CERTIFICATE</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="BONAFIDE"></div></td>
                    <td>BONAFIDE STUDENT CERTIFICATE</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="ENROLLMENT"></div></td>
                    <td>CERTIFICATE OF ENROLLMENT (COE)</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="PAYMENT"></div></td>
                    <td>CERTIFICATION OF PAYMENT (O.R.)</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="COMPLETION"></div></td>
                    <td>COMPLETION FORM</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="0" data-fee="AUTHENTICATION" id="auth-checkbox"></div></td>
                    <td>
                        AUTHENTICATION OF DOCUMENTS (₱10 per page)
                        <div class="document-types">
                            <div class="document-type">
                                <input type="checkbox" class="document-checkbox" data-doctype="COE">
                                <span>Certificate of Enrollment (COE)</span>
                                <input type="number" min="1" value="1" class="page-count" data-doctype="COE">
                            </div>
                            <div class="document-type">
                                <input type="checkbox" class="document-checkbox" data-doctype="COR">
                                <span>Certificate of Registration (COR)</span>
                                <input type="number" min="1" value="1" class="page-count" data-doctype="COR">
                            </div>
                            <div class="document-type">
                                <input type="checkbox" class="document-checkbox" data-doctype="OR">
                                <span>Official Receipt (OR)</span>
                                <input type="number" min="1" value="1" class="page-count" data-doctype="OR">
                            </div>
                            <div class="document-type">
                                <input type="checkbox" class="document-checkbox" data-doctype="ID">
                                <span>ID</span>
                                <input type="number" min="1" value="1" class="page-count" data-doctype="ID">
                            </div>
                        </div>
                    </td>
                    <td id="auth-amount">0.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="75" data-fee="DISMISSAL"></div></td>
                    <td>HONORABLE DISMISSAL</td>
                    <td>75.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="30" data-fee="TRANSCRIPT"></div></td>
                    <td>TRANSCRIPT OF RECORD (PER PAGE)</td>
                    <td>30.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Other Fees Section -->
    <div class="fee-category">
        <h3 class="category-title"><i class="fas fa-id-card"></i> OTHER FEES</h3>
        <table class="fees-table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Fees to be Paid</th>
                    <th>Amount (₱)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="75" data-fee="ID"></div></td>
                    <td>IDENTIFICATION CARD</td>
                    <td>75.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="20" data-fee="CHANGE_SUBJECT"></div></td>
                    <td>ADDING/CHANGING/DROPPING OF SUBJECTS</td>
                    <td>20.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="1200" data-fee="THESIS"></div></td>
                    <td>THESIS FEE</td>
                    <td>1,200.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="200" data-fee="OJT"></div></td>
                    <td>ON THE JOB TRAINING FEE</td>
                    <td>200.00</td>
                </tr>
                <tr>
                    <td><div class="checkbox-container"><input type="checkbox" class="checkbox-custom fee-checkbox" data-amount="1000" data-fee="TEACHING"></div></td>
                    <td>PRACTICE TEACHING FEE</td>
                    <td>1,000.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Total Row -->
    <table class="fees-table">
        <tbody>
            <tr class="total-row">
                <td colspan="2">TOTAL AMOUNT</td>
                <td id="total-amount">0.00</td>
            </tr>
        </tbody>
    </table>
    
    <div class="button-container">
        <a href="homeuser.php" class="button button-back"><i class="fas fa-arrow-left"></i> Back to Home</a>
        <a href="#" class="button button-transact" id="transact-button"><i class="fas fa-money-bill-wave"></i> Transact Now</a>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2023 Bicol University Polangui. All Rights Reserved.</p>
</div>

<script>
    // Calculate total when checkboxes are clicked
    const checkboxes = document.querySelectorAll('.fee-checkbox');
    const totalAmountElement = document.getElementById('total-amount');
    const transactButton = document.getElementById('transact-button');
    
    // Set up event listeners for fee checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotal);
    });
    
    // Calculate total amount
    function calculateTotal() {
        let total = 0;
        
        // Calculate authentication fee first
        const authCheckbox = document.getElementById('auth-checkbox');
        let authAmount = 0;
        
        if (authCheckbox.checked) {
            document.querySelectorAll('.document-checkbox:checked').forEach(checkbox => {
                const docType = checkbox.dataset.doctype;
                const pageCount = parseInt(document.querySelector(`.page-count[data-doctype="${docType}"]`).value) || 1;
                authAmount += pageCount * 10; // ₱10 per page
            });
            
            // Update the displayed authentication amount
            document.getElementById('auth-amount').textContent = authAmount.toFixed(2);
            authCheckbox.dataset.amount = authAmount;
        } else {
            document.getElementById('auth-amount').textContent = '0.00';
            authCheckbox.dataset.amount = '0';
        }
        
        // Calculate other fees
        checkboxes.forEach(checkbox => {
            if (checkbox.checked && checkbox !== authCheckbox) {
                total += parseFloat(checkbox.dataset.amount);
            }
        });
        
        // Add authentication fee if checked
        if (authCheckbox.checked) {
            total += authAmount;
        }
        
        totalAmountElement.textContent = total.toFixed(2);
        
        // Disable transact button if no items selected
        transactButton.style.opacity = total > 0 ? '1' : '0.5';
        transactButton.style.pointerEvents = total > 0 ? 'auto' : 'none';
    }
    
    // Add event listeners for document checkboxes and page counts
    document.querySelectorAll('.document-checkbox, .page-count').forEach(element => {
        element.addEventListener('change', function() {
            const authCheckbox = document.getElementById('auth-checkbox');
            if (document.querySelector('.document-checkbox:checked')) {
                authCheckbox.checked = true;
            }
            calculateTotal();
        });
    });
    
    // Handle auth checkbox change
    document.getElementById('auth-checkbox').addEventListener('change', function() {
        if (!this.checked) {
            // Uncheck all document checkboxes when main auth is unchecked
            document.querySelectorAll('.document-checkbox').forEach(cb => cb.checked = false);
        }
        calculateTotal();
    });
    
    // Handle transact button click
    transactButton.addEventListener('click', function(e) {
        const selectedFees = [];
        
        // Add regular fees
        checkboxes.forEach(checkbox => {
            if (checkbox.checked && checkbox !== document.getElementById('auth-checkbox')) {
                selectedFees.push({
                    type: checkbox.dataset.fee,
                    name: checkbox.closest('tr').querySelector('td:nth-child(2)').textContent,
                    amount: parseFloat(checkbox.dataset.amount)
                });
            }
        });
        
        // Add authentication fees if selected
        const authCheckbox = document.getElementById('auth-checkbox');
        if (authCheckbox.checked) {
            const authItems = [];
            document.querySelectorAll('.document-checkbox:checked').forEach(checkbox => {
                const docType = checkbox.dataset.doctype;
                const pageCount = parseInt(document.querySelector(`.page-count[data-doctype="${docType}"]`).value) || 1;
                const docName = checkbox.parentElement.querySelector('span').textContent;
                
                authItems.push({
                    document: docName,
                    pages: pageCount,
                    amount: pageCount * 10
                });
            });
            
            if (authItems.length > 0) {
                selectedFees.push({
                    type: "AUTHENTICATION",
                    name: "Authentication of Documents",
                    amount: parseFloat(authCheckbox.dataset.amount),
                    items: authItems
                });
            }
        }
        
        if (selectedFees.length === 0) {
            e.preventDefault();
            return;
        }
        
        // Store selected fees in sessionStorage to pass to payment page
        sessionStorage.setItem('selectedFees', JSON.stringify(selectedFees));
        sessionStorage.setItem('totalAmount', totalAmountElement.textContent);
        
        // Redirect to payment page
        window.location.href = 'payment.html';
    });
    
    // Simulate user data - in a real app, this would come from your authentication system
    document.addEventListener('DOMContentLoaded', function() {
        // These values would normally come from your login system
        const userName = "Juan Dela Cruz"; // Replace with actual user name
        const userEmail = "juan.delacruz@bicol-u.edu.ph"; // Replace with actual user email
        
        document.getElementById('displayUserName').textContent = userName;
        document.getElementById('displayUserEmail').textContent = userEmail;
        
        // Initialize total calculation
        calculateTotal();
    });
</script>

</body>
</html>
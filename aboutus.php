<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bicol University Cashier's Online Payment</title>
    <style>
        :root {
            --primary-color: #478fe2; /* Blue */
            --secondary-color: #ff9100; /* Orange */
            --nav-bg: #4326aa3a;
            --dark-bg: #121212;
            --light-text: #ffffff;
            --muted-text: #bbbbbb;
            --card-bg: rgba(0, 0, 0, 0.6);
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
        
        .nav-link.active {
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }
        
        .divider {
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin: 20px auto;
        }
        
        /* About Sections */
        .about-section {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            font-size: 1.5rem;
        }
        
        .section-content {
            color: var(--muted-text);
            line-height: 1.8;
        }
        
        .team-members {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .team-card {
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .team-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        
        .team-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .team-name {
            color: var(--light-text);
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        /* Features Section */
        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .feature-card {
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            padding: 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        
        .feature-icon {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .feature-title {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        /* Footer */
        .footer {
            margin-top: 60px;
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
            
            .page-title {
                font-size: 2rem;
            }
            
            .team-members, .features-container {
                grid-template-columns: 1fr;
            }
            
            .user-name-display {
                display: none;
            }
            
            .dropdown-content {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
                min-width: 200px;
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
            <a href="about.php" class="nav-link active">About Us</a>
            <a href="transactionhistory.php" class="nav-link">Transaction History</a>
            <a href="fees.php" class="nav-link"></i> Fees</a>
            <a href="help.php" class="nav-link">Help</a>
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
        <h1 class="page-title">About Our Online Payment System</h1>
        <p class="page-subtitle">Modernizing financial transactions at Bicol University Polangui</p>
        <div class="divider"></div>
    </div>
    
    <div class="about-section">
        <h2 class="section-title"><i class="fas fa-university"></i> Our Mission</h2>
        <div class="section-content">
            <p>With the rapid growth of technology, schools are now embracing digital means to make their operations more efficient and effective in delivering services. Bicol University Polangui is upgrading its financial transaction process to better suit the needs of students, teachers, and employees.</p>
            
            <p>Our online payment system makes payment processes more streamlined, providing a more convenient and accessible experience for everyone. We developed this system after observing numerous students struggling during payments at the cashier due to delays, shortened business hours, and inefficient procedures.</p>
        </div>
    </div>
    
    <div class="about-section">
        <h2 class="section-title"><i class="fas fa-bullseye"></i> Objectives</h2>
        <div class="section-content">
            <p>This advanced system is designed to streamline the payment process, enhancing the experience for both students and cashier staff:</p>
            
            <ul>
                <li>Enable students to manage their time more effectively by paying from anywhere with internet access</li>
                <li>Provide secure GCash payment option</li>
                <li>Offer real-time reporting for staff to track payments and ensure transparency</li>
                <li>Reduce workload on cashier staff, leading to a more organized work environment</li>
                <li>Minimize errors and enhance transaction accuracy in financial management</li>
            </ul>
        </div>
    </div>
    
    <div class="about-section">
        <h2 class="section-title"><i class="fas fa-cogs"></i> Key Features</h2>
        <div class="features-container">
            <div class="feature-card">
                <i class="fas fa-mobile-alt feature-icon"></i>
                <h3 class="feature-title">24/7 Accessibility</h3>
                <p>Make payments anytime, anywhere using any device with internet access, eliminating the need to wait in long lines.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-shield-alt feature-icon"></i>
                <h3 class="feature-title">Secure Transactions</h3>
                <p>Industry-standard encryption and security protocols to protect all financial transactions and personal data.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-file-invoice-dollar feature-icon"></i>
                <h3 class="feature-title">Digital Receipts</h3>
                <p>Instant generation and delivery of digital receipts to your registered email address for all transactions.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-chart-line feature-icon"></i>
                <h3 class="feature-title">Real-time Reporting</h3>
                <p>Administrators gain immediate access to payment data for better financial tracking and decision making.</p>
            </div>
            
            <div class="feature-card">
                <i class="fab fa-gg feature-icon"></i>
                <h3 class="feature-title">GCash Payments</h3>
                <p>Secure and convenient payments through GCash.</p>
            </div>
            
            <div class="feature-card">
                <i class="fas fa-history feature-icon"></i>
                <h3 class="feature-title">Transaction History</h3>
                <p>Easy access to complete payment history with search and filtering capabilities.</p>
            </div>
        </div>
    </div>
    
    <div class="about-section">
        <h2 class="section-title"><i class="fas fa-users"></i> Development Team</h2>
        <div class="section-content">
            <p>This system was developed by a dedicated team of Bicol University students committed to improving the university's financial processes:</p>
            
            <div class="team-members">
                <div class="team-card">
                    <img src=".vscode/Screenshot 2024-12-12 132627.png" alt="Circular Image" style="width:200px; height:200px; border-radius:50%; object-fit:cover; border:3px solid #333;">
                    <h4 class="team-name">Chariz Abanel</h4>
                    <p>Lead Developer</p>
                </div>
                
                <div class="team-card">
                    <img src=".vscode/Screenshot 2025-04-24 103024.png" alt="Circular Image" style="width:200px; height:200px; border-radius:50%; object-fit:cover; border:3px solid #333;">
                    <h4 class="team-name">May Abano</h4>
                    <p>QA Tester</p>
                </div>
                
                <div class="team-card">
                    <img src=".vscode/462566177_1519759712076386_1643602191657820817_n.jpg" alt="Circular Image" style="width:200px; height:200px; border-radius:50%; object-fit:cover; border:3px solid #333;">
                    <h4 class="team-name">Lovely Irish Benoyo</h4>
                    <p>Project Manager</p>
                </div>
                
                <div class="team-card">
                    <img src=".vscode/86eaf876-6a10-4b38-a494-f0ac6ca7b22e (1).jpg" alt="Circular Image" style="width:200px; height:200px; border-radius:50%; object-fit:cover; border:3px solid #333;">
                    <h4 class="team-name">Otelo Nobleza</h4>
                    <p>Backend Developer</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2023 Bicol University Polangui. All Rights Reserved.</p>
    <p>Online Payment System v2.1.5</p>
</div>

<script>
    // Enhanced User Dropdown Functionality
    const userDropdown = document.getElementById('userDropdown');
    const dropdownContent = userDropdown.querySelector('.dropdown-content');
    
    // Toggle dropdown on click
    userDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = dropdownContent.style.display === 'block';
        dropdownContent.style.display = isOpen ? 'none' : 'block';
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!userDropdown.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
    
    // Close dropdown when pressing Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            dropdownContent.style.display = 'none';
        }
    });
    
    // Set user information
    const userData = {
        firstName: "Juan",
        fullName: "Juan Dela Cruz",
        email: "juandelacruz@bicol-u.edu.ph",
        avatar: "" // Add URL to user's avatar image if available
    };
    
    document.getElementById('dropdownUserName').textContent = userData.fullName;
    document.getElementById('dropdownUserEmail').textContent = userData.email;
    
    // Logout functionality
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to logout?')) {
            alert('Logging out...');
            window.location.href = 'login.html';
        }
    });
</script>

</body>	
</html>

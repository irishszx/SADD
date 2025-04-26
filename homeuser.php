<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bicol University - Cashier's Online Payment Transaction</title>
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 40px 20px;
            text-align: center;
        }
        
        .header {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .sub-header {
            font-size: 1.8rem;
            font-weight: 400;
            margin-bottom: 20px;
            color: var(--secondary-color);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        
        .divider {
            width: 150px;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin: 20px auto;
        }
        
        .description {
            font-size: 1.2rem;
            color: var(--light-text);
            max-width: 700px;
            margin: 30px auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
        
        .button {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 30px;
            font-size: 1.2rem;
            font-weight: 600;
            display: inline-block;
            margin: 20px 0;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        
        .button:hover {
            background-color: transparent;
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(128, 0, 128, 0.4);
        }
        
        .payment-options {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }
        
        .payment-card {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 25px;
            width: 250px;
            transition: transform 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .payment-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        
        .payment-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .payment-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        .payment-desc {
            font-size: 0.9rem;
            color: var(--muted-text);
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
                font-size: 1.4rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .dropdown-content {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }
            
            .payment-options {
                flex-direction: column;
            }
            
            .user-name-display {
                display: none;
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
            <a href="#" class="nav-link">Transaction History</a>
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
    <h1 class="header">Welcome, <span id="welcomeUserName">Juan</span>!</h1>
    <h2 class="sub-header">CASHIER'S ONLINE PAYMENT TRANSACTION</h2>
    <div class="divider"></div>
  
    <a href="fees.html" class="button">Transact Now</a>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2023 Bicol University Polangui. All Rights Reserved.</p>
</div>

<script>
    // This would normally come from your authentication system
    // For demonstration, we're using placeholder values
    
    // Get user data (in a real app, this would come from your backend)
    const userData = {
        firstName: "Juan",
        fullName: "Juan Dela Cruz",
        email: "juandelacruz@bicol-u.edu.ph"
    };
    
    // Set user information in all locations
    document.getElementById('userNameDisplay').textContent = userData.fullName;
    document.getElementById('dropdownUserName').textContent = userData.fullName;
    document.getElementById('dropdownUserEmail').textContent = userData.email;
    document.getElementById('welcomeUserName').textContent = userData.firstName;
    
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


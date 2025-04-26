<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bicol University - Admin Dashboard</title>
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
        
        /* Admin Dropdown Styles */
        .admin-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            margin-left: 10px;
            cursor: pointer;
        }
        
        .admin-info-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-name-display {
            font-weight: 600;
            color: var(--light-text);
        }
        
        .admin-circle {
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
        
        .admin-circle:hover {
            background-color: var(--secondary-color);
            color: var(--dark-bg);
            transform: scale(1.1);
        }
        
        .admin-circle i {
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
        
        .admin-dropdown:hover .dropdown-content {
            display: block;
        }
        
        .dropdown-admin-info {
            padding: 12px 16px;
            background-color: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dropdown-admin-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .dropdown-admin-email {
            font-size: 0.8rem;
            color: var(--muted-text);
        }
        
        .dropdown-admin-role {
            font-size: 0.8rem;
            color: var(--secondary-color);
            font-weight: bold;
        }
        
        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 40px 20px;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .admin-subtitle {
            font-size: 1.2rem;
            font-weight: 400;
            color: var(--secondary-color);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        
        .current-date {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            color: var(--light-text);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Admin Cards */
        .admin-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .admin-card {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-title {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .card-icon {
            color: var(--secondary-color);
            font-size: 1.8rem;
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        
        .stat-card {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--light-text);
            margin-bottom: 0.3rem;
        }
        
        .stat-label {
            color: var(--muted-text);
            font-size: 0.9rem;
        }
        
        /* Footer */
        .footer {
            margin-top: 3rem;
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
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .admin-subtitle {
                font-size: 1rem;
            }
            
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .dropdown-content {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }
        }
        
        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .admin-name-display {
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
            <a href="#" class="nav-link">Manage Fees</a>
            <a href="#" class="nav-link">Transaction History</a>
            <a href="#" class="nav-link">Report</a>
            <a href="#" class="nav-link">Help</a>
            <div class="admin-dropdown" id="adminDropdown">
                <div class="admin-info-container">
                    <span class="admin-name-display" id="adminNameDisplay">Admin User</span>
                    <div class="admin-circle">
                    <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="dropdown-content">
                    <div class="dropdown-admin-info">
                        <div class="dropdown-admin-name" id="dropdownAdminName">Admin User</div>
                        <div class="dropdown-admin-email" id="dropdownAdminEmail">admin@bicol-u.edu.ph</div>
                        <div class="dropdown-admin-role">Administrator</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="#"><i class="fas fa-cog"></i> Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" id="adminLogoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="main-content">
    <div class="admin-header">
        <div>
            <h1 class="welcome-title">Welcome, <span id="welcomeAdminName">Admin</span></h1>
            <p class="admin-subtitle">Cashier's Office Management Dashboard</p>
        </div>
        <div class="current-date">
            <span id="currentDate">Loading date...</span>
        </div>
    </div>

    <div class="admin-cards">
        <div class="admin-card">
            <div class="card-header">
                <h2 class="card-title">Quick Stats</h2>
                <i class="fas fa-chart-line card-icon"></i>
            </div>
            <div class="card-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-wallet"></i>
                        <div class="stat-value">₱0.00</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Transactions</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-check-circle"></i>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Completed</div>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-exclamation-circle"></i>
                        <div class="stat-value">0</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2023 Bicol University Polangui. All Rights Reserved.</p>
</div>

<!-- JavaScript Section -->
<script>
    // Admin information simulation
    const adminData = {
        firstName: "Admin",
        fullName: "Admin User",
        email: "admin@bicol-u.edu.ph",
        role: "Administrator"
    };

    // Initialize empty stats
    const dashboardStats = {
        totalRevenue: 0,
        totalTransactions: 0,
        completedTransactions: 0,
        pendingTransactions: 0
    };

    // Populate data on load
    document.addEventListener("DOMContentLoaded", () => {
        // Set admin information
        document.getElementById("adminNameDisplay").textContent = adminData.fullName;
        document.getElementById("dropdownAdminName").textContent = adminData.fullName;
        document.getElementById("dropdownAdminEmail").textContent = adminData.email;
        document.getElementById("welcomeAdminName").textContent = adminData.firstName;

        // Set current date
        const now = new Date();
        const formattedDate = now.toLocaleDateString("en-PH", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric"
        });
        document.getElementById("currentDate").textContent = formattedDate;

        // Initialize with zeros as requested
        updateDashboardStats();
    });

    // Function to update dashboard stats
    function updateDashboardStats() {
        document.querySelector('.stat-value:nth-of-type(1)').textContent = `₱${dashboardStats.totalRevenue.toFixed(2)}`;
        document.querySelector('.stat-value:nth-of-type(2)').textContent = dashboardStats.totalTransactions;
        document.querySelector('.stat-value:nth-of-type(3)').textContent = dashboardStats.completedTransactions;
        document.querySelector('.stat-value:nth-of-type(4)').textContent = dashboardStats.pendingTransactions;
    }

    // Logout functionality
    document.getElementById('adminLogoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to logout?')) {
            // In a real application, this would call your logout API
            alert('Logging out...');
            window.location.href = 'login.html';
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('adminDropdown');
        if (!dropdown.contains(e.target)) {
            const dropdownContent = dropdown.querySelector('.dropdown-content');
            dropdownContent.style.display = 'none';
        }
    });
</script>

</body>
</html>
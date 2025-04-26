<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - Bicol University Cashier's Online Payment</title>
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
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8));
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
        
        /* Navigation Bar - Updated to match homepage */
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
        
        /* User Dropdown - Updated to match homepage */
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
        
        /* FAQ Section */
        .faq-section {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-title {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .faq-item {
            margin-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 15px;
        }
        
        .faq-question {
            font-weight: 600;
            color: var(--light-text);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }
        
        .faq-question:hover {
            color: var(--secondary-color);
        }
        
        .faq-answer {
            display: none;
            padding: 10px 0;
            color: var(--muted-text);
        }
        
        .faq-item.active .faq-answer {
            display: block;
        }
        
        .faq-question i {
            transition: transform 0.3s ease;
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        /* Contact Form */
        .contact-section {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--light-text);
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            color: var(--light-text);
            font-family: inherit;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        /* Emergency Contact */
        .emergency-contact {
            background-color: rgba(255, 145, 0, 0.1);
            border-left: 4px solid var(--secondary-color);
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }
        
        .emergency-contact h4 {
            color: var(--secondary-color);
            margin-top: 0;
        }
        
        /* Footer - Same as your existing */
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
            
            .user-name-display {
                display: none;
            }
            
            .dropdown-content {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<!-- Navigation Bar with updated user dropdown -->
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
            <a href="transactionhistory.php" class="nav-link">Transaction History</a>
            <a href="fees.php" class="nav-link"></i> Fees</a>
            <a href="help.php" class="nav-link active">Help</a>
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
        <h1 class="page-title">Help Center</h1>
        <p class="page-subtitle">Find answers to common questions about the Bicol University Online Payment System</p>
        <div class="divider"></div>
    </div>
    
    <div class="faq-section">
        <h2 class="section-title"><i class="fas fa-question-circle"></i> Frequently Asked Questions</h2>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>How do I make a payment?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <ol>
                    <li>Log in to your Bicol University student account</li>
                    <li>Navigate to the Payments section</li>
                    <li>Select the type of document or service you need to pay for (e.g., Authentication, Certificate of Enrollment (COE), Certificate of Registration (COR), etc.)</li>
                    <li>Choose GCash as your payment method.</li>
                    <li>Review your payment details and confirm the transaction.</li>
                    <li>After successful payment, you will receive a confirmation email with your official receipt.</li>
                </ol>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>What payment methods are accepted?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                
                    <li>Currently, the system only accepts GCash for all transactions. This ensures a fast, secure, and convenient payment experience.

                    </li>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>What should I do if my payment fails?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
                <p>If your payment fails:</p>
                <ol>
                    <li>Double-check that your GCash account details are correct.</li>
                    <li>Ensure you have a stable internet connection.</li>
                    <li>Try again after a few minutes.</li>
                    <li>If money was deducted but payment failed, contact support with:
                        <ul>
                            <li>Screenshot of error</li>
                            <li>Transaction reference number</li>
                            <li>Proof of payment from your bank/e-wallet</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>How can I get a receipt for my payment?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
        
                    <li>A confirmation email with your official receipt will be sent to your registered email.</li>
                    <li>You can also view and download your transaction history from the payment section of your student account.</li>
                </ol>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>Is my payment information secure?</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer">
        
                    <li>Yes. All payment transactions are securely encrypted. The university’s system is designed to protect your personal and financial information throughout the entire payment process.</li>
                    
                </ul>
            </div>
        </div>
    </div>
    
    <div class="contact-section">
        <h2 class="section-title"><i class="fas fa-envelope"></i> Contact Support</h2>
        <p>Can't find what you're looking for? Send us a message and we'll respond within 24 hours.</p>
        
        <form id="supportForm">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="studentId">Student ID Number</label>
                <input type="text" id="studentId" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="subject">Subject</label>
                <select id="subject" class="form-control" required>
                    <option value="">Select a topic</option>
                    <option value="payment">Payment Issue</option>
                    <option value="receipt">Receipt Request</option>
                    <option value="account">Account Problem</option>
                    <option value="other">Other Inquiry</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea id="message" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="attachment">Attach Screenshot (if applicable)</label>
                <input type="file" id="attachment" class="form-control">
            </div>
            
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
        
        <div class="emergency-contact">
            <h4><i class="fas fa-phone-alt"></i> Need Immediate Assistance?</h4>
            <p>Call our support hotline: <strong>(052) 123-4567</strong> (Monday-Friday, 8AM-5PM)</p>
            <p>For after-hours emergencies, email: <strong>emergency-support@bicoluniversity.edu.ph</strong></p>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2023 Bicol University Polangui. All Rights Reserved.</p>
    <p>Online Payment System v2.1.5</p>
</div>

<script>
    // FAQ toggle functionality
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const faqItem = question.parentElement;
            faqItem.classList.toggle('active');
        });
    });
    
    // Form submission handling
    document.getElementById('supportForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your message! Our support team will contact you shortly.');
        this.reset();
    });
    
    // User dropdown functionality (updated to match homepage)
    const userDropdown = document.getElementById('userDropdown');
    const dropdownContent = userDropdown.querySelector('.dropdown-content');
    
    userDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
    
    document.addEventListener('click', (e) => {
        if (!userDropdown.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
    
    // Set user information
    const userData = {
        fullName: "Juan Dela Cruz",
        email: "juandelacruz@bicol-u.edu.ph"
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
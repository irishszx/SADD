<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bicol University Polangui - Student Portal Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
    <style>
        :root {
            --bu-maroon: #000000;
            --bu-gold: #ffd200;
            --bu-light: #f8f9fa;
            --bu-dark: #343a40;
        }
        
        body {
            background: linear-gradient(135deg, rgba(252, 152, 70, 0.973) 0%, rgba(0, 15, 218, 0.7) 100%), 
                        url('.vscode/bupc2_orig.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            color: var(--bu-light);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .login-container {
            animation: gradientBG 15s ease infinite;
            background: linear-gradient(-45deg, rgba(122, 0, 60, 0.8), rgba(0, 51, 102, 0.8), rgba(255, 140, 0, 0.8), rgba(255, 210, 0, 0.8));
            background-size: 400% 400%;
            backdrop-filter: blur(10px);
            padding: 3rem 3rem 2rem;
            border-radius: 12px;
            width: 700px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
            margin: 20px 0;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            gap: 5px;
        }

        .university-logo {
            width: 80px;
            height: auto;
        }

        .title-container {
            display: flex;
            flex-direction: column;
        }

        .login-container h2 {
            margin: 0;
            color: white;
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .login-container h3 {
            margin: 0.5rem 0 0;
            color: var(--bu-gold);
            font-weight: 400;
            font-size: 1rem;
        }

        .form-container {
            width: 80%;
            margin: 0 auto;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--bu-gold);
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 15px 12px 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--bu-gold);
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 2px rgba(255, 210, 0, 0.2);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            width: 100%;
        }

        .remember {
            display: flex;
            align-items: center;
        }

        .remember input {
            margin-right: 8px;
            accent-color: var(--bu-gold);
        }

        .forgot-password {
            color: var(--bu-gold);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: white;
            text-decoration: underline;
        }

        button {
            padding: 12px;
            background-color: var(--bu-gold);
            color: var(--bu-maroon);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        button:hover {
            background-color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 210, 0, 0.3);
        }

        .back-link {
            display: block;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: white;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 1.5rem;
            }
            
            .header-container {
                flex-direction: column;
            }
            
            .university-logo {
                width: 60px;
            }
            
            .form-container {
                width: 95%;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="header-container">
            <!-- First Logo -->
            <img src=".vscode/BU Logo.png" alt="Bicol University Logo" class="university-logo">
            
            <!-- Title Container -->
            <div class="title-container">
                <h1>BICOL UNIVERSITY POLANGUI</h1>
                <h3>WELCOME PLEASE LOGIN.</h3>
            </div>
            
            <!-- Second Logo -->
            <img src=".vscode/R.png" alt="Bicol University Secondary Logo" class="university-logo">
        </div>
        
        <div class="form-container">
            <div class="input-group">
                <input type="email" placeholder="BU Email Address" required>
            </div>
            
            <div class="input-group">
                <input type="password" placeholder="Password" required>
            </div>
            
            <div class="options">
                <div class="remember">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            
            <button type="submit">SIGN IN</button>
        </div>
      
        <a class="back-link" href="homeuser.php">← Return to Home Page</a>
       
        <div class="footer">
            © 2023 Bicol University Polangui. All rights reserved.
        </div>
    </div>

</body>
</html>

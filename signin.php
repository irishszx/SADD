<?php
session_start();

$login_error = "";


$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "craftique"; 

$conn = new mysqli($host, $dbuser, $dbpass, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE buemail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        
        if ($password === $user['password']) {

            
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $user['buemail'];
            $_SESSION["authority"] = $user['authority'];

            
            if ($user['authority'] === 'admin') {
                header("Location: adminhomepage.html");
            } else {
                header("Location: user'shomepage.php");
            }
            exit();
        } else {
            $login_error = "Incorrect password.";
        }
    } else {
        $login_error = "Email not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bicol University Polangui - Student Portal Login</title>
    
    <style>
        :root {
            --bu-maroon: #000000;
            --bu-gold: #ffd200;
            --bu-light: #f8f9fa;
            --bu-dark: #343a40;
        }
        
        body {
            background-image: url("bupc.jpg");
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
            
            background:rgba(0, 51, 102, 0.8);
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
            .error {
    background-color: rgba(255, 0, 0, 0.1);
    border: 1px solid red;
    color: #ff4d4d;
    padding: 10px;
    margin-bottom: 1rem;
    border-radius: 5px;
    font-weight: 500;
    font-size: 0.95rem;
}
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="header-container">
            
            <img src="BU Logo.png" alt="Bicol University Logo" class="university-logo">
            
            
            <div class="title-container">
                <h1>BICOL UNIVERSITY POLANGUI</h1>
                <h3>WELCOME PLEASE LOGIN.</h3>
            </div>
            
            
            <img src="R.png" alt="Bicol University Secondary Logo" class="university-logo">
        </div>
        

        <form method="POST" action="">
    <div class="form-container">

    <?php if ($login_error): ?>
    <div class="error"><?php echo $login_error; ?></div>
<?php endif; ?>

        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="BU Email Address" required />
        </div>

        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
        </div>

        <button type="submit">SIGN IN</button>
    </div>
</form>
<a href="visitor'shomepage.html"><- Back to home</a>
<div class="footer">
            © 2025 Bicol University Polangui. All rights reserved.
        </div>
    </div>
    
        </div>
        
    </div>
   
</body>
</html>

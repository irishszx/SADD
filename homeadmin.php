<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cashier's Online Payment</title>
  

  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body, html {
  height: 100%;
}

body {
  background-image: url('image1.jpeg'); 
  background-size: cover;
  background-position: center;
  position: relative;
  color: white;
}




header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: rgba(0, 0, 0, 0.6);
  position: relative;
  z-index: 1;
}

.logo {
  display: flex;
  align-items: center;
  color: white;
}

.logo img {
  height: 50px;
  margin-right: 10px;
}

nav ul {
  list-style: none;
  display: flex;
  gap: 20px;
}

nav ul li a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}




main {
  height: 100vh;
  display: flex;
  align-items: center;
  padding-left: 50px;
  position: relative;
  z-index: 1;
}

.content {
  max-width: 500px;
}

.content h1 {
  font-size: 2.5rem;
  margin-bottom: 20px;
}

.content p {
  font-size: 1.1rem;
  margin-bottom: 15px;
}

.btn {
  display: inline-block;
  background-color: #2c0eee;
  color: white;
  padding: 12px 20px;
  border-radius: 25px;
  text-decoration: none;
  font-weight: bold;
  margin-top: 10px;
  transition: background 0.3s;
}

.btn:hover {
  background-color: #472ccf;
}

.content {
  max-width: 800px;
  margin-top: 200px; /* Optional: additional spacing */
}
.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 110%;
  background-color: rgba(0, 0, 0, 0.5); /* Black with 50% opacity */
  z-index: 0;
}


  </style>
</head>
<body>
  <header>
    <div class="logo">
      <img src="r.png" alt="BU Logo">
      <span>
        <strong>BICOL UNIVERSITY</strong><br>
        POLANGUI
      </span>
    </div>
    <nav>
      <ul>
        <li><a href="#ABOUTUS">ABOUT US</a></li>
        <li><a href="#mission">MISSION & VISION</a></li>
        <li><a href="signin.html">TRANSACT NOW </a></li>
       
        
      </ul>
    </nav>
    <a href="signin.html" style="color: white; text-decoration: none;">SIGN IN</a>
  </header>

  <main>
    <div class="overlay"></div>
    <div class="content" id="ABOUTUS">
      <h1>Cashier's Online Payment Transaction</h1>
      <p>With the rapid growth of technology, schools are now embracing digital means to make their operations more efficient and effective in delivering services. Bicol University Polangui is upgrading its financial transaction process to better suit the needs of students, teachers, and employees.</p>
      <p>Our online payment system makes payment processes more streamlined, providing a more convenient and accessible experience for everyone. We developed this system after observing numerous students struggling during payments at the cashier due to delays, shortened business hours, and inefficient procedures.</p>
      <p>This advanced system is designed to streamline the payment process, enhancing the experience for both students and cashier staff</p>
    
    <div class="mission" id="mission">
      <h1>Vision</h1>
    <p>A University for Humanity characterized by productive scholarship, transformative leadership, collaborative service, and distinctive character for sustainable societies.
    </p>
    <h1>Mission</h1>
    <p>The Bicol University shall give professional and technical training, and provide advanced and specialized instructions in literature, philosophy, the sciences and arts, besides providing for the promotion of scientific and technological researches (RA 5521, Sec. 3.0).</p>
      
    </div>
    <a href="#" class="btn">Transact Now</a>
</div>

  </main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Zain Store</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Lato', sans-serif;
      background-color: #f4f4f4;
      color: #333;
      padding-top: 70px;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .navbar img {
      height: 50px;
    }

    .navbar .menu {
      display: flex;
      list-style: none;
      gap: 25px;
    }

    .navbar .menu li a {
      text-decoration: none;
      color: #333;
      transition: 0.3s;
      font-weight: 500;
    }

    .navbar .menu li a:hover {
      color: #007bff;
    }

    /* Hero Section */
    .hero {
      background-image: url("img/about-banner.jpg");
      background-size: cover;
      background-position: center;
      color: white;
      text-align: center;
      padding: 100px 20px;
      position: relative;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }

    .hero h1 {
      position: relative;
      z-index: 1;
      font-size: 48px;
      font-weight: 900;
      margin-bottom: 10px;
    }

    .hero p {
      position: relative;
      z-index: 1;
      font-size: 18px;
      max-width: 700px;
      margin: auto;
    }

    /* About Section */
    .about {
      max-width: 1200px;
      margin: 50px auto;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 40px;
      align-items: center;
    }

    .about img {
      width: 50%;
      border-radius: 10px;
    }

    .about-text {
      flex: 1;
    }

    .about-text h2 {
      font-size: 32px;
      margin-bottom: 15px;
      color: #007bff;
    }

    .about-text p {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 10px;
    }

    /* Mission & Vision */
    .mission-section {
      max-width: 1200px;
      margin: 50px auto;
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
    }

    .mission-box {
      background-color: white;
      flex: 1 1 45%;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
      padding: 30px;
      transition: transform 0.3s;
    }

    .mission-box:hover {
      transform: translateY(-5px);
    }

    .mission-box h3 {
      color: #007bff;
      margin-bottom: 10px;
      font-size: 24px;
    }

    .mission-box p {
      font-size: 16px;
      line-height: 1.6;
    }

    /* Team Section */
    .team {
      background-color: #fff;
      padding: 50px 20px;
      text-align: center;
    }

    .team h2 {
      color: #007bff;
      font-size: 32px;
      margin-bottom: 20px;
    }

    .team-members {
      display: flex;
      justify-content: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .member {
      background-color: #f8f8f8;
      border-radius: 10px;
      width: 250px;
      padding: 20px;
      text-align: center;
      transition: transform 0.3s;
    }

    .member:hover {
      transform: translateY(-5px);
    }

    .member img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin-bottom: 15px;
    }

    .member h4 {
      margin-bottom: 5px;
      font-size: 18px;
    }

    .member p {
      font-size: 14px;
      color: gray;
    }

    /* Footer */
    footer {
      background-color: #333;
      color: white;
      padding: 40px 0;
      margin-top: 60px;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      padding: 0 20px;
    }

    .footer-section h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .footer-section ul {
      list-style: none;
      padding: 0;
    }

    .footer-section ul li {
      margin: 8px 0;
    }

    .footer-section ul li a {
      color: white;
      text-decoration: none;
    }

    .footer-section .social a {
      margin-right: 10px;
      color: white;
      font-size: 20px;
    }

    .footer-section .social a:hover {
      color: #007bff;
    }

    @media (max-width: 768px) {
      .about {
        flex-direction: column;
      }

      .about img {
        width: 100%;
      }

      .mission-box {
        flex: 1 1 100%;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <header class="navbar">
    <a href="index.html"><img src="img/zain07.png" alt="Logo"></a>
    <ul class="menu">
      <li><a href="index.html">Home</a></li>
      <li><a href="productpages/product.html">Products</a></li>
      <li><a href="about.html" style="color:#007bff;">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <h1>About Zain Store</h1>
    <p>Delivering quality, innovation, and style to elevate your everyday lifestyle.</p>
  </section>

  <!-- About Section -->
  <section class="about">
    <img src="img/about-us.jpg" alt="About Us">
    <div class="about-text">
      <h2>Who We Are</h2>
      <p>Welcome to Zain Store! We are passionate about bringing you the best in fashion, electronics, and lifestyle products. Our journey began with a mission — to make premium quality accessible to everyone.</p>
      <p>We value our customers’ trust and constantly work to provide top-notch service and innovative designs that meet your everyday needs.</p>
    </div>
  </section>

  <!-- Mission & Vision -->
  <section class="mission-section">
    <div class="mission-box">
      <h3>Our Mission</h3>
      <p>To provide premium, stylish, and affordable products that empower our customers to express themselves with confidence.</p>
    </div>
    <div class="mission-box">
      <h3>Our Vision</h3>
      <p>To become a global lifestyle brand recognized for quality, trust, and innovation in every product we deliver.</p>
    </div>
  </section>

  <!-- Team Section -->
  <section class="team">
    <h2>Meet Our Team</h2>
    <div class="team-members">
      <div class="member">
        <img src="img/team1.jpg" alt="Team Member 1">
        <h4>Zain Ali</h4>
        <p>Founder & CEO</p>
      </div>
      <div class="member">
        <img src="img/team2.jpg" alt="Team Member 2">
        <h4>Sarah Khan</h4>
        <p>Marketing Head</p>
      </div>
      <div class="member">
        <img src="img/team3.jpg" alt="Team Member 3">
        <h4>Ahmed Raza</h4>
        <p>Product Designer</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div class="footer-section about">
        <h2>About Us</h2>
        <p>We are a leading company providing high-quality products and exceptional customer service.</p>
      </div>
      <div class="footer-section links">
        <h2>Quick Links</h2>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="productpages/product.html">Products</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="footer-section social">
        <h2>Follow Us</h2>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
      </div>
    </div>
  </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="css/aboutus.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
<?php
      session_start();
    ?>
    
        <main>
          <section class="hero">
          <header>
              <h1><img src="image/logo.png" class="icon">HOMESERVED SERVICES</h1>
              <ul class="nav">
                  <li class="scroll-to-section"><a href="index.php" class="active">HOME</a></li>
                  <li class="scroll-to-section"><a href="services.php">SERVICES</a></li>
                  <li class="scroll-to-section"><a href="contacts.php">CONTACT</a></li>
                  <li class="scroll-to-section"><a style="color: #ff9800" href="aboutus.php">ABOUT US</a></li>
              </ul>

              <ul class="nav">
                          <?php if (isset($_SESSION['name'])): ?>
                              
                              <li class="scroll-to-section"><a href="#">HELLO, <?php echo htmlspecialchars($_SESSION['name']); ?></a></li>
                              <li class="scroll-to-section"><a href="api/logout.php">LOGOUT</a></li>
                          <?php else: ?>

                              <li class="scroll-to-section"><a href="signup.php">SIGN-UP</a></li>
                              <li class="scroll-to-section"><a href="login.php">LOGIN</a></li>
                          <?php endif; ?>
                      </ul>
              </ul>
          </header>
            <div class="hero-content main-content">
                <h2>Making home services simple</h2>
                <p>We make every house a home</p>
            </div>
        </section>
        <script src="./js/effects.js"></script>                    
        <section class="main-content">
          <h2>About Us</h2>
          <ul class="mem-list">
            <div class="image-containers">
              <li><img class="members" src="image/Aquino.png"></li>
              <h3>Head developer</h3>
            </div>
            <div class="image-containers">
              <li><img class="members" src="image/Amir.jpg"></li>
              <h3>Frontend Developer</h3>
            </div>
            <div class="image-containers">
              <li><img class="members" src="image/Cacnio.jpg"></li>
              <h3>Social Media Manager</h3>
            </div>               
            <div class="image-containers">
              <li><img class="members" src="image/Dela.jpg"></li>
              <h3>QA Tester/Quality Analyst</h3>
            </div>
          </ul>
          <br><br><br><br>
          <h3 style="font-size:1.5rem; text-align:center;">
            "We are a group of 4 IT students, with an idea to turn useful home improvement skills into a profitable way of making a living by creating a website where home owners and home improvement professionals meet.
            Homeserved services is a middleman web application to make contacting and hiring professionals in home improvement field, easier and faster. We aim to make homeservice accessible to everyone."               
          </h3>
          <br><br>
        </section>
        


        </main>

        <footer class="footer">
        <div class="footer-content">
          <div class="footer-section about">
            <h3>About Us</h3>
            <p>All your home chores, repairs and fixes at the click of a button. We serve your home service needs!</p>
          </div>
          <div class="footer-section links">
            <h3>Quick Links</h3>
            <ul class="h-link">
              <li><a href="index.php">Home</a></li>
              <li><a href="services.php">Services</a></li>
              <li><a href="aboutus.php">About</a></li>
              <li><a href="contacts.php">Contact</a></li>
            </ul>
          </div>
          <div class="footer-section social">
            <h3>Follow Us</h3>
            <a href="https://www.facebook.com/profile.php?id=61570736364399"><img src="image/facebook.png"></a>
            <a href="https://x.com/HomeServedOffcl"><img class="twitter" src="image/twitter.png"></a>
            <a href="https://www.instagram.com/homeserved67/"><img src="image/instagram.png"></i></a>
            <a href="https://www.youtube.com/@HomeServed"><img src="image/youtube.png"></i></a>
          </div>
        </div>
      
        <div class="footer-bottom">
          <p>&copy; 2024 HomeServed Services. All rights reserved.</p>
        </div>
      </footer>
</body>
</html>

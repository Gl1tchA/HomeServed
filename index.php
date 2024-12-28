<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeserved Services</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/indexstyle.css">
</head>
<body>
    <?php
      session_start();
    ?>
    <div class="wrapper">
        <div class="head-bg">
            <video autoplay muted loop id="bg-video">
                <source src="image/bgvid.mp4" type="video/mp4" />
            </video>
        </div>
        <header>
          <h1><img src="image/logo.png" class="icon">HOMESERVED SERVICES</h1>
          <ul class="nav">
              <li class="scroll-to-section"><a style="color: #ff9800" href="index.php" class="active">HOME</a></li>
              <li class="scroll-to-section"><a href="services.php">SERVICES</a></li>
              <li class="scroll-to-section"><a href="contacts.php">CONTACT</a></li>
              <li class="scroll-to-section"><a href="aboutus.php">ABOUT US</a></li>
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

        <div class="intro">
        <script src="./js/gen-effects.js"></script>               
              <?php if (isset($_SESSION['name'])): ?>
                <h1 class="caption main-content">
                  Welcome back, <?php echo htmlspecialchars($_SESSION['name']);?>!
                </h1>
                <p class="desc main-content">We missed you</p>
                <button class="join main-content" onclick="window.location.href='orders.php'">Your orders</button>
              <?php else: ?>
                <div class="cap">
                  <h1 class="caption main-content">
                    Cleaning, Gardening, Plumbing and Electronics Services
                  </h1>  
                  <p class="desc main-content">All your home fixer-upper solved by others!</p>
                  <button style=" cursor: pointer; " class="join main-content" onclick="window.location.href='signup.php'">JOIN US NOW!</button>
                </div>
              <?php endif; ?>
        </div>
    </div>
    <main>
            
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
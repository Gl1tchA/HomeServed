<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/servicesstyle.css">

    <style>
  #submit-button {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    font-size: 16px; /* Font size */
    padding: 10px 20px; /* Padding around the text */
    border: none; /* Remove the border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
  }

  #submit-button:hover {
    background-color: white; /* Slightly darker green on hover */
    color: #ff9800;
  }


</style>
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
                  <li class="scroll-to-section"><a style="color: #ff9800" href="services.php">SERVICES</a></li>
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
            <script src="./js/gen-effects.js"></script>
            <div style="width:750px; height:250px;" class="hero-content main-content">
            <form action="/your-server-endpoint" method="POST" id="payment-form">
                <div class="form-row">
                    <label for="card-element"></label>
                    <br>
                    <div id="card-element">
                    <!-- Stripe Elements will inject the card input here -->
                    </div>
                    <!-- Display error message if the card information is invalid -->
                    <div id="card-errors" role="alert"></div>
                </div>
                <br><br>            
                <button id="submit-button" type="submit">Submit Payment</button>
            </form>              
            </div>
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
<script src="js/pay.js"></script>
</html>

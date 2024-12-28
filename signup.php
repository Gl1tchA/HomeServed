<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/loginandsignupstyle.css">
    <link rel="stylesheet" href="css/general.css">
</head>
<body>
<?php
      session_start();
    ?>
      <header>
          <h1><img src="image/logo.png" class="icon">HOMESERVED SERVICES</h1>
          <ul class="nav">
              <li class="scroll-to-section"><a href="index.php" class="active">HOME</a></li>
              <li class="scroll-to-section"><a href="services.php">SERVICES</a></li>
              <li class="scroll-to-section"><a href="contacts.php">CONTACT</a></li>
              <li class="scroll-to-section"><a href="aboutus.php">ABOUT US</a></li>
          </ul>

          <ul class="nav">
                      <?php if (isset($_SESSION['name'])): ?>
                          
                          <li class="scroll-to-section"><a href="#">HELLO, <?php echo htmlspecialchars($_SESSION['name']); ?></a></li>
                          <li class="scroll-to-section"><a href="api/logout.php">LOGOUT</a></li>
                      <?php else: ?>

                          <li class="scroll-to-section"><a style="color: #ff9800" href="signup.php">SIGN-UP</a></li>
                          <li class="scroll-to-section"><a href="login.php">LOGIN</a></li>
                      <?php endif; ?>
                  </ul>
          </ul>
      </header>

        <main>
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>         
        <div class="center">
            <h1>Sign Up</h1>
            <script>
                // Show alert if the query parameter `alert=1` exists
                if (window.location.search.includes('alert=1')) {
                    alert('Email already in use!');
                }
            </script>
            <form id="registration-form" method="post" action="api/submit.php">
                <div class="txt_field">
                    <input type="text" name="name" required  />
                    <span></span>
                    <label>Name</label>
                </div>
                <div class="txt_field">
                    <input type="email" id="email" name="email" required onblur="validateEmail()"/>
                    <span></span>
                    <label>Email</label>
                    
                </div>
                <div id="email-error" class="error-message"></div>
                <div class="txt_field">
                        
                    <input type="date" name="bday" required />
                    <span></span>
                    <label class="bday">Birthday</label>
                </div>
                <div class="txt_field">
                    <input id="password" type="password" name="password" required onblur="validatePassword()"/>
                    <span></span>
                    <label>Password</label>
                    
                </div>
                <div id="password-error"></div>
                <div class="txt_field">
                    <input id="confirm-password" type="password" name="confirm-password" required />
                    <span></span>
                    <label>Confirm Password</label>
                    <span id="error-message" style="color: red; display: none;">Passwords do not match!</span>
                </div>
                <div id="v2_recaptcha">
                    <div class="g-recaptcha" data-sitekey="6Lf8I58qAAAAAH7dOFFpIVbEA7falJbRvXXJ4Yv5"></div>
                </div>       
                <br><br>        
                <div class="pass"><a href="forgot_password.php" style="text-decoration:none; color:gray;">Forgot password?</a></div>
                <input type="submit" value="Sign Up" />
                <div class="signup_link">Already a member? <a href="login.php">Login</a></div>
            </form>
        </div>
        <script>
          document.getElementById("registration-form").addEventListener("submit", function(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;

            console.log("Password: " + password);  // Check password value
            console.log("Confirm Password: " + confirmPassword);  // Check confirm password value

            if (password !== confirmPassword) {
              document.getElementById("error-message").style.display = "inline";  // Show error message
              event.preventDefault();  // Prevent form submission
            } else {
              document.getElementById("error-message").style.display = "none";  // Hide error message
            }
          });
        </script>
            
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
  
      <script src="js/validator.js"></script>
</body>
</html>

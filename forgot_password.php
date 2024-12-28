<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'api/config.php';


    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the email and birthday from the form
    $email = $conn->real_escape_string($_POST['email']);
    $birthday = $conn->real_escape_string($_POST['birthday']);

    // Query to check for matching email and birthday in the database
    $query = "SELECT email, bday FROM credentials WHERE email = '$email' AND bday = '$birthday'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Match found: Create a session variable
        $_SESSION['email'] = $email;

        // Redirect to reset password page
        header("Location: reset_password.php");
        exit();
    } else {
        // No match found: Display an error
        $error_message = "No matching email and birthday found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/loginandsignupstyle.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="fp.css">
</head>
<body>

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

                          <li class="scroll-to-section"><a href="signup.php">SIGN-UP</a></li>
                          <li class="scroll-to-section"><a style="color: #ff9800" href="login.php">LOGIN</a></li>
                      <?php endif; ?>
                  </ul>
          </ul>
    </header>
    <main>
        <div class="center">
            <h1>Forgot password?</h1>
            <?php
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <br>
            <form method="post">
              <div class="txt_field">
                <input type="text" name="email" required />
                <span></span>
                <label>Enter Email</label>
              </div>
              <div class="txt_field">
                <input type="date" name="birthday" required />
                <span></span>
                <label></label>
              </div>

              <div class="pass"><a href="login.php" style="text-decoration: none; color: gray;">Already have an account?</a>></div>
              <input type="submit" value="Login" />
              <div class="signup_link">Not a member? <a href="signup.php">Signup</a></div>
            </form>
          </div>
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

<?php
session_start();

// Check if the session email exists
if (!isset($_SESSION['email'])) {
    // Redirect to login or forgot password page if the session is not set
    header("Location: forgot_password.php");
    exit();
}

// Retrieve the email from the session
$email = $_SESSION['email'];

// Initialize variables for error messages
$error_message = "";
$success_message = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    require_once 'api/config.php';

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize inputs
    $password = $conn->real_escape_string($_POST['password']);
    $re_password = $conn->real_escape_string($_POST['re-password']);

    // Check if passwords match
    if ($password !== $re_password) {
        $error_message = "Passwords do not match. Please try again.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Update the password in the database
        $query = "UPDATE credentials SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            $success_message = "Password reset successfully. You can now <a href='login.php'>login</a>.";
            header("Location: login.php");
            // Clear the session after password reset
            session_destroy();
        } else {
            $error_message = "An error occurred while resetting the password. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/loginandsignupstyle.css">
    <link rel="stylesheet" href="css/general.css">
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
      <h1>Reset Password</h1>
      <?php
      if (!empty($error_message)) {
          echo "<p style='color: red;'>$error_message</p>";
      }
      if (!empty($success_message)) {
          echo "<p style='color: green;'>$success_message</p>";
      }
      ?>
      <form method="post">
        <div class="txt_field">
          <input type="password" name="password" required />
          <span></span>
          <label>Enter New Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="re-password" required />
          <span></span>
          <label>Re-enter Password</label>
        </div>
        <input type="submit" value="Reset Password" />
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

<?php
session_start();


$error = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'api/config.php';


    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, password,admin FROM credentials WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {

        echo "Error preparing SQL statement: " . $conn->error;
    } else {

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();


        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $name, $hashed_password,$admin);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['name'] = $name;
                $_SESSION['user_id'] = $id;
                $_SESSION['admin'] =(bool)$admin;
                header("Location: index.php");
                exit();
            } else {

                $_SESSION['error'] = "Invalid password. Please try again.";
            }
        } else {
         
            $_SESSION['error'] = "No user found with that email.";
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
    <title>Login</title>
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
            <h1>Welcome back</h1>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<div class='error' style='color:red;'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']); 
            }
            ?>
            <form method="post">
              <div class="txt_field">
                <input id="email" type="email" name="email" required />
                <span></span>
                <label>Email</label>
              </div>
              
              <div class="txt_field">
                <input type="password" name="password" required/>
                <span></span>
                <label>Password</label>
              </div>
              <div class="pass"><a href="forgot_password.php" style="text-decoration:none; color:gray;">Forgot password?</a></div>
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

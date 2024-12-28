<?php

require_once 'config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get email from user input (e.g., from a POST request)
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Sanitize email input to prevent SQL injection
$email = $conn->real_escape_string($email);

// Query to search for the email
$sql = "SELECT email FROM credentials WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Email found, redirect to an HTML page
    echo "<script>alert('Similar email found'); window.location.href='../signup.php';</script>";
    header("Location: ../signup.php?alert=1");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $secret = '6Lf8I58qAAAAANcISygMi6Eq79mGgZCkXxkKb28K';
  $response = $_POST['g-recaptcha-response'] ?? $_POST['recaptcha_token'];
  $remoteIP = $_SERVER['REMOTE_ADDR'];

  $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteIP");
  $responseData = json_decode($verifyResponse);

  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $birthday = $conn->real_escape_string($_POST['bday']);
  $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

  $sql = "INSERT INTO credentials (name, email, bday, password) VALUES ('$name', '$email', '$birthday', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: ../login.php");
    exit();  
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  $conn->close();
}

?>
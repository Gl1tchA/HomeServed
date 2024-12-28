<?php
session_start(); // Start the session

require_once 'config.php';

// Connect to the database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input safely
    $name = isset($_POST['session_name']) ? trim($_POST['session_name']) : '';
    $service = isset($_POST['service']) ? trim($_POST['service']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $contact_num = isset($_POST['contact_num']) ? trim($_POST['contact_num']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mode = isset($_POST['mode']) ? trim($_POST['mode']) : '';
    $acq_date = isset($_POST['date']) ? trim($_POST['date']) : '';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO receipts (name, service,price, address, contact_num, email,mode,acq_date) VALUES (?, ?,?, ?, ?,?, ?,?)");
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssssssss", $name, $service,$price, $address, $contact_num, $email,$mode,$acq_date);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect on success
            header("Location: ../index.php");
            exit();
        } else {
            // Handle query errors
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
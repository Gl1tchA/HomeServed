<?php
session_start();
require_once 'config.php';

// Connect to the database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'], $_POST['email'], $_POST['bday'])) {
    // Get the updated data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bday = $_POST['bday'];
    $recordID = $_POST['recordID'];


    // Update the record in the database
    $stmt = $conn->prepare("UPDATE credentials SET name = ?, email = ?, bday = ? WHERE id = ?");
    if ($stmt) {
        // Assuming 'id' is the unique identifier of the record
        $stmt->bind_param("sssi", $name, $email, $bday, $recordID);

        if ($stmt->execute()) {
            echo "<p>Record updated successfully!</p>";
        } else {
            echo "<p>Error updating record: " . $conn->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Error preparing update statement: " . $conn->error . "</p>";
    }
}

    $stmt2 = $conn->prepare("UPDATE receipts SET name = ? WHERE name = ?");
    if ($stmt2) {
        $stmt2->bind_param("ss", $name, $sessionName); // Bind only two parameters for updating the 'name'
        
        if ($stmt2->execute()) {
            echo "<p>Another table updated successfully!</p>";
        } else {
            echo "<p>Error updating another table: " . $conn->error . "</p>";
        }

        $stmt2->close();
    } else {
        echo "<p>Error preparing update statement for another table: " . $conn->error . "</p>";
    }
}

?>
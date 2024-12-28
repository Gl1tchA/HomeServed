<?php
session_start(); // Start the session

require_once 'api/config.php';

// Connect to the database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/orderstyle.css">
    

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

    <div class="order-list">
    <?php
    // Check if the delete action was triggered
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_service'])) {
        $serviceToDelete = $_POST['delete_service'];
        $name = $_SESSION['name'];

        // Prepare the SQL query to delete the service
        $stmt = $conn->prepare("DELETE FROM receipts WHERE name = ? AND service = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $name, $serviceToDelete);

            if ($stmt->execute()) {
                echo "<p>Service '$serviceToDelete' deleted successfully!</p>";
            } else {
                echo "<p>Error deleting service: " . $conn->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Error preparing delete statement: " . $conn->error . "</p>";
        }
    }

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Limit to 5 records per page
    $offset = ($page - 1) * $limit;
    // Display services for the user
    if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
        $name = $_SESSION['name'];

        // Prepare the SQL query to fetch services and dates
        $stmt = $conn->prepare("SELECT service, price, mode, acq_date FROM receipts WHERE name = ? LIMIT ? OFFSET ?");
        if ($stmt) {
            // Bind the session name to the query
            $stmt->bind_param("sii", $name, $limit, $offset);

            // Execute the query
            $stmt->execute();

            // Fetch the results
            $result = $stmt->get_result();

            // Check if there are results
            if ($result->num_rows > 0) {
            
                echo "<h3>Services hired for " . htmlspecialchars($name) . ":</h3>";
                echo '<div class="wrapper">';
                echo "<table cellpadding='5' cellspacing='0'>"; // Start the table
                echo "<thead><tr><th>Service</th><th>Price</th><th>Mode</th><th>Date of Request</th><th>Date of Arrival</th><th>Action</th></tr></thead>";
                echo "<tbody>"; // Start table body
                
                while ($row = $result->fetch_assoc()) {
                    $service = htmlspecialchars($row['service']);
                    $price = htmlspecialchars($row['price']);
                    $mode = htmlspecialchars($row['mode']);
                    $date = htmlspecialchars($row['acq_date']); // Fetch the date
                    echo "<tr>
                        <td>$service</td>
                        <td>$price</td>
                        <td>$mode</td>
                        <td>$date</td>
                        <td>TBA</td>
                        <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_service' value='$service'>
                                <button type='submit'>Cancel</button>
                            </form>
                        </td>
                    </tr>";
                }

                echo "</tbody>"; // End table body
                echo "</table>"; // End the table
                echo '</div>';
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            $prev_page = $page > 1 ? $page - 1 : 1;
            // Check if there's a next page (based on number of rows, assuming a total of 100 records)
            $next_page = $page + 1;
        
            echo "
                <br><br>
                <a href='?page=$prev_page' class='action-btn'><img class='btn' src='image/return.png'></a> 
                <a href='?page=$next_page' class='action-btn'><img class='btn' src='image/forward.PNG'></a>
";
        
            // Close the connection
            $stmt->close();
        } else {
            echo "<p>Error preparing statement: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>User not logged in or session name not set.</p>";
    }

    $conn->close();
?>

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
              <li><a href="index.html">Home</a></li>
              <li><a href="#menu">Menu</a></li>
              <li><a href="aboutus.html">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>
          <div class="footer-section social">
            <h3>Follow Us</h3>
            <a href="#"><img src="image/facebook.png"></a>
            <a href="#"><img class="twitter" src="image/twitter.png"></a>
            <a href="#"><img src="image/instagram.png"></i></a>
            <a href="#"><img src="image/gmail.png"></i></a>
          </div>
        </div>
      
        <div class="footer-bottom">
          <p>&copy; 2024 HomeServed Services. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
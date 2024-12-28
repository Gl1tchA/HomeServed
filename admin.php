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
    <title>Admin Pane</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <header>
        
    </header>
    <main>
        <div class="table-wrapper">
            <h1>Database Records</h1>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Birthday</th>
                        <th>Admin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Assuming server-side script like PHP populates this data -->
                    <?php

                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $limit = 5; // Limit to 5 records per page
                        $offset = ($page - 1) * $limit;
                        

                        $sql = "SELECT name, email, bday, admin FROM credentials LIMIT $limit OFFSET $offset";
                        $result = $conn->query($sql);
                    
                        // Check if any records were found
                        if ($result->num_rows > 0) {
                            // Output data for each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['bday']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['admin']) . "</td>";
                                echo "<td><button onclick=\"toggleAndFocus(event)\" class='edit-btn' data-id='" . htmlspecialchars($row['name']) ."'>Edit</button><button class='del-btn'>Delete</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No records found</td></tr>";
                        }
                        $prev_page = $page > 1 ? $page - 1 : 1;
                        // Check if there's a next page (based on number of rows, assuming a total of 100 records)
                        $next_page = $page + 1;
                    
                        echo "<tr><td colspan='5'>
                            <a href='?page=$prev_page' class='action-btn'>Back</a> 
                            <a href='?page=$next_page' class='action-btn'>Next</a>
                        </td></tr>";
                    
                        // Close the connection
                        $conn->close();
                    ?>
                </tbody>
            </table>
            <br>
            <div class="collapsible" id="hiddenSection">
            <img src="image/return.png" onclick="toggleAndFocus(event)" class="back-button" style="cursor: pointer"> 
                        <form method="post" action="api/edit.php">
                            <label>Name</label>
                            <input type="text" id="name" name="name" ><br>
                            <label>Email</label>
                            <input type="email" id="email" name="email" ><br>
                            <label>Birthday</label>
                            <input type="date" id="bday" name="bday" ><br>
                            <input id="submit-button" type="submit" value="Submit"/>
                            <input type="hidden" value="" name="recordID">
                        </form>
            </div>
        </div>
    </main>
    <script>
    // Output the session value as a JavaScript variable
    const userLoggedIn = <?php echo isset($_SESSION['name']) && !empty($_SESSION['name']) ? 'true' : 'false'; ?>;

    function toggleAndFocus(event) {
        event.preventDefault(); // Prevent default anchor behavior
        const recordId = event.target.getAttribute('data-id');

        // Pre-fill the form fields with the current values for this record
        // You will need to fetch the existing data (via AJAX or in a hidden form)
        document.getElementById('name').value = recordId; // For example, the name
        document.getElementById('email').value = ""; // Set the current email (via AJAX or pre-filled)
        document.getElementById('bday').value = "";
        document.getElementById('recordID').value = recordId;
        // Check if user is logged in
        if (userLoggedIn) {
        // Proceed with the normal toggle behavior if the user is logged in
        const section = document.getElementById('hiddenSection');
        const isHidden = section.style.display === 'none' || section.style.display === '';
        section.style.display = isHidden ? 'block' : 'none';

        // Focus on the section if it is being shown
        if (isHidden) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
        } else {
        // Redirect to login.php if the user is not logged in
        window.location.href = 'login.php';
        }
    }
    </script>

</body>
</html>
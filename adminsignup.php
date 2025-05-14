<?php
include 'connection.php'; // Ensure this file contains your database connection code

if (isset($_POST['UN']) && isset($_POST['PASS'])) {
    $username = $_POST['UN'];
    $password = $_POST['PASS']; // Store the password as plain text (not recommended for security reasons)

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "lamp_innovative");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if username already exists
    $checkQuery = $conn->prepare("SELECT * FROM admin WHERE name = ?");
    $checkQuery->bind_param("s", $username);
    $checkQuery->execute();
    $checkQuery->store_result();
    if ($checkQuery->num_rows > 0) {
        echo "<script>alert('Username already exists.'); window.location.href='index.php';</script>";
        $checkQuery->close();
        $conn->close();
        exit();
    }
    $checkQuery->close();

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO admin (name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New admin added successfully'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Please fill in both fields.";
}
?>

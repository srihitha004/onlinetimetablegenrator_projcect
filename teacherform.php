<?php
session_start();
include 'connection.php';

if (isset($_POST['FN']) && isset($_POST['TN'])) {
    $fac = $_POST['FN'];
    $name = $_POST['TN'];
} else {
    die("Invalid input.");
}

// Create a connection to the database
$conn = mysqli_connect("localhost", "root", "", "lamp_innovative");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and execute the query
$stmt = $conn->prepare("SELECT name FROM teachers WHERE faculty_number = ? AND name = ?");
$stmt->bind_param("ss", $fac, $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // Fetch teacher name and set session variables
    $row = $result->fetch_assoc();
    $_SESSION['loggedin_name'] = $row['name'];
    $_SESSION['loggedin_id'] = $fac;
    header("Location: teacherpage.php");
    exit();
} else {
    // Display error message if login fails
    $message = "Invalid Teacher ID or Name.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message'); window.location.href = 'index.php';</script>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

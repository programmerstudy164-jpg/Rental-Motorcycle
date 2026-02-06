<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the user ID from session
$user_id = $_SESSION['user_id'];

// Get form data
$message = $_POST['message'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone']; // Use the correct variable for phone

// Prepare the SQL query using prepared statements to prevent SQL injection
$sql = "INSERT INTO contact (fname, lname, email, phone, message, user_id) 
        VALUES (?, ?, ?, ?, ?, ?)";

// Use prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters to the statement
$stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $message, $user_id);

// Execute the query
if ($stmt->execute()) {
    echo "Message submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

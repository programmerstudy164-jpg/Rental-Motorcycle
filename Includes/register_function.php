<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = "customer";

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // Check if username or email already exists
    $checkSql = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username or email already exists!'); window.history.back();</script>";
        exit();
    }

    // Insert without password hashing (NOT recommended for production)
    $insertSql = "INSERT INTO user (fname, lname, username, email, password, role) 
                  VALUES ('$firstName', '$lastName', '$username', '$email', '$password', '$role')";

    if ($conn->query($insertSql) === TRUE) {
        echo "<script>alert('Registration successful! You can now log in.'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again later.'); window.history.back();</script>";
    }
}

$conn->close();
?>

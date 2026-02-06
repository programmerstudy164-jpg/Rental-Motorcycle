<?php
include 'Includes/db.php';
session_start();

if (isset($_GET['redirect_to'])) {
    $_SESSION['redirect_to'] = $_GET['redirect_to'];
}

if (isset($_SESSION['email'])) {
    $redirect = $_SESSION['redirect_to'] ?? 'index.php';
    unset($_SESSION['redirect_to']);
    header("Location: $redirect");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

       
        if ($password == $row['password']) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role']; 
            $_SESSION['username'] = $row['username'];
            $_SESSION['fname'] = $row['fname'];

            $redirect_url = $_SESSION['redirect_to'] ?? 'index.php';
            unset($_SESSION['redirect_to']);
            echo "<script>alert('Login successful!'); window.location.href='$redirect_url';</script>";
            exit;
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "Includes/header.php"; ?>

<div class="login-container">
    <div class="auth-header">
        <h2>Welcome Back!</h2>
        <p>Enter your details to login to your account</p>
    </div>

    <form class="auth-form" method="POST">
        <div class="input-group">
            <input type="email" name="email" placeholder="Email Address" required>
            <i class="fas fa-envelope"></i>
        </div>
        <div class="input-group">
            <input type="password" name="password" id="loginPassword" placeholder="Password" required>
            <i class="fas fa-lock"></i>
            <span class="password-toggle" onclick="togglePassword('loginPassword', this)">
                <i class="fas fa-eye"></i>
            </span>
        </div>
        <button type="submit" name="login" class="auth-btn">Login</button>
    </form>
    <div class="auth-footer">
        Don't have an account? <a href="register.php" class="switch-to-register">Register Here</a>
    </div>
</div>

<script>
    function togglePassword(id, element) {
        const passwordInput = document.getElementById(id);
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            element.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = "password";
            element.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
</script>

</body>
</html>

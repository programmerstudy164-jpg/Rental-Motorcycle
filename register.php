<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
 include "Includes/header.php";?>
    <div class="register-container">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Join us today and get started</p>
        </div>
        
       
        
        <form class="auth-form" method="POST" action="Includes\register_function.php">
    <div class="input-group">
        <input type="text" name="first_name" placeholder="First Name" required>
        <i class="fas fa-user"></i>
    </div>
    <div class="input-group">
        <input type="text" name="last_name" placeholder="Last Name" required>
        <i class="fas fa-user"></i>
    </div>
    <div class="input-group">
        <input type="text" name="name" placeholder="Guest Name" required>
        <i class="fas fa-user"></i>
    </div>
    <div class="input-group">
        <input type="email" name="email" placeholder="Email Address" required>
        <i class="fas fa-envelope"></i>
    </div>
    <div class="input-group">
        <input type="password" name="password" id="regPassword" placeholder="Password" required>
        <i class="fas fa-lock"></i>
        <span class="password-toggle" onclick="togglePassword('regPassword', this)">
            <i class="fas fa-eye"></i>
        </span>
    </div>
    <div class="input-group">
        <input type="password" name="confirm_password" id="regConfirmPassword" placeholder="Confirm Password" required>
        <i class="fas fa-lock"></i>
        <span class="password-toggle" onclick="togglePassword('regConfirmPassword', this)">
            <i class="fas fa-eye"></i>
        </span>
    </div>
    <button type="submit" name="Register" class="auth-btn">Register</button>
</form>

        <div class="auth-footer">
            Already have an account? <a href="login.php" class="switch-to-login">Login Here</a>
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
       <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
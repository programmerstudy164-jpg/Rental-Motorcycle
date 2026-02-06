 
 <div id="registerModal" class="auth-modal">
        <div class="auth-modal-content">
            <span class="auth-close">&times;</span>
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Join us today and get started</p>
            </div>
            <form class="auth-form" action="Includes/register_function.php" method="POST">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Full Name" required>
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
                Already have an account? <a href="#" class="switch-to-login">Login Here</a>
            </div>
        </div>
    </div>

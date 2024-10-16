<link rel="stylesheet" href="assets/css/registerlogin.css">

<div class="container" id="container">
    <div class="form-container sign-in-container">
        <form method="POST">
            <h1>Sign in</h1>
            <input type="text" name="username" placeholder="Username" required />
            <div class="password_field">
                <input type="password" name="password" placeholder="Password" id="password" required />
                <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
            </div>
            <button type="submit">Sign In</button>
            <span class="ghost-text">Already have account?<a class="ghost" id="signUp" href="register"> Sign Up</a></span>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Welcome Back!</h1>
                <p>
                    We're excited to have you with us again. Explore, connect, and continue your journey with us today!
                </p>
            </div>
        </div>
    </div>
</div>

<?php

unset($_SESSION['error_message']);

$loginUser = new authController();
$loginUser->login();
?>

<script>
    const passwordField = document.getElementById("password");
    const togglePassword = document.querySelector(".password-toggle-icon i");

    togglePassword.addEventListener("click", function() {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        }
    });
</script>
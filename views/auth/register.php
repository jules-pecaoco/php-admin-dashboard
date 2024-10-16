<link rel="stylesheet" href="assets/css/registerlogin.css">

<div class="container right-panel-active" id="container">
    <div class="form-container sign-up-container ">
        <form method="POST">

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <p>Personal Information</p>
            <div class="user__name">
                <input type="text" name="firstName" placeholder="First Name" required />
                <input type="text" name="lastName" placeholder="Last Name" required />
            </div>
            <input type="email" name="email" placeholder="Email" required />
            <p>Account Information</p>
            <input type="text" name="username" placeholder="Username" required />
            <div class="password_field">
                <input type="password" name="password" placeholder="Password" id="password" required />
                <span class="password-toggle-icon"><i class="fas fa-eye"></i></span>
            </div>
            <button type="submit">Sign Up</button>
            <span class="ghost-text">Already have account?<a class="ghost" id="signIn" href="/<?php echo $root ?>/"> Sign In</a></span>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Create Account</h1>

                <p>
                    We're thrilled to have you join our community. Start your journey with us and discover all we have to offer!"
                </p>
            </div>
        </div>
    </div>
</div>

<?php
$registerUser = new authController();
$registerUser->register();
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
<?php
session_start();
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Function to check if the user has exceeded the maximum login attempts
function hasExceededLoginAttempts() {
    return $_SESSION['login_attempts'] >= 3;
}

// Function to set a timeout for subsequent login attempts after 3 failed attempts
function setLoginAttemptTimeout() {
    $_SESSION['login_timeout'] = time() + 30; // Set timeout for 30 seconds
}

// Function to check if the login attempt is within the timeout period
function isLoginAttemptAllowed() {
    return !isset($_SESSION['login_timeout']) || $_SESSION['login_timeout'] <= time();
}

// Function to reset login attempt counter
function resetLoginAttempts() {
    $_SESSION['login_attempts'] = 0;
    unset($_SESSION['login_timeout']);
}
// Function to check if the password is at least 8 characters long
function isPasswordValid($password) {
    return strlen($password) >= 8;
}
// Increment login attempt counter
$_SESSION['login_attempts']++;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>
 
<style type="text/css">
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", san-serif;
    }
    body{
        background: #ffebcd;
    }
    .wrapper{
        width: 330px;
        padding: 2rem 1rem;
        margin: 160px auto;
        background-color: #fff;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }
    h1{
        font-size: 1.3rem;
        color: #07001f;
        margin-bottom: 1.5rem;
    }
    form input{
        width: 92%;
        outline: none;
        border: 1px solid #fff;
        padding: 12px 20px;
        margin-bottom: 0px;
        border-radius: 20px;
        background: #e4e4e4;
    }
    .password-container {
        position: relative;
    }
    .password-container input {
        width: 92%;
        outline: none;
        border: 1px solid #fff;
        padding: 12px 20px;
        margin-bottom: 10px;
        border-radius: 20px;
        background: #e4e4e4;
    }
    .password-container i {
        position: absolute;
        right: 20px;
        top: 40%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    button{
        font-size: 1rem;
        margin-top: 1.8rem;
        padding: 10px 0;
        border-radius: 20px;
        outline: none;
        border: none;
        width: 90%;
        color: #333;
        font-weight:bold;
        cursor: pointer;
        background: #ffebcd;
    }
    button:hover{
        background: #A9A9A9;
    }
    input:focus{
        border: 1px solid rgb(192, 192, 192)
    }
    .member{
        font-size: 0.8rem;
        margin-top: 1.4rem;
        color: #636363;
    }
    .member a{
        color: #385b4f;
        text-decoration: none;
    }
    .member .fa{
        color: #6F4E37;
    }
    .back-button {
        font-size: 1rem;
        margin-top: 1rem;
        padding: 10px 0;
        border-radius: 20px;
        outline: none;
        border: none;
        width: 90%;
        color: #333;
        font-weight:bold;
        cursor: pointer;
        background: #ffebcd;
    }
    .back-button:hover {
        background: #A9A9A9;
    }
</style>
 
<div class="wrapper">
    <h1>Reset password</h1>

    <form class="form-sign-up" action="includes/reset.inc.php" method="post">
        <div class="password-container">
            <input id="email" type="text" name="email" placeholder="Email">
        </div>
        <div class="password-container">
            <input id="password" type="password" name="password" placeholder="New password">
            <i class="fa fa-eye" id="togglePassword"></i>
        </div>
        <div class="password-container">
            <input id="confirmPassword" type="password" name="confirmPassword" placeholder="Confirm password">
            <i class="fa fa-eye" id="toggleConfirmPassword"></i>
            <?php 
        if (isset($_GET['error']) && $_GET['error'] === 'invalidpassword'): ?>
            <p style="color: red; font-size: 10px"><br>Password must be at least 8 characters long.</p>
        <?php endif; ?>
        </div>
        <button type="submit" id="button" name="resetPassword">Update</button><br>

        <?php 
        if (hasExceededLoginAttempts() && !isLoginAttemptAllowed()): ?>
            <p>Login attempts exceeded. Please wait for <?php echo ($_SESSION['login_timeout'] - time()); ?> seconds before trying again.</p>
        <?php endif; ?>
    </form>

    <button class="back-button" onclick="goBack()">Cancel</button>

    <script>
        function goBack() {
            window.history.back();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

            // Initially, set the password input to 'text' and the eye to 'fa-eye-slash'
            passwordInput.type = 'password';
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');

            confirmPasswordInput.type = 'password';
            toggleConfirmPassword.classList.remove('fa-eye');
            toggleConfirmPassword.classList.add('fa-eye-slash');

            togglePassword.addEventListener('click', function () {
                togglePasswordVisibility(passwordInput, togglePassword);
            });

            toggleConfirmPassword.addEventListener('click', function () {
                togglePasswordVisibility(confirmPasswordInput, toggleConfirmPassword);
            });

            function togglePasswordVisibility(inputField, toggleIcon) {
                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                } else {
                    inputField.type = 'password';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            }
        });
    </script>
</div>
</body>
      </Html>
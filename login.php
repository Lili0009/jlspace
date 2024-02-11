<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
</head>
<body>
 
<style type="text/css">
    /* Your CSS Styles */
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", san-serif;
    }

    body{
        background: linear-gradient(90deg, #ecffdc, #749f8d);
    }

    .wrapper{
        width: 330px;
        padding: 2rem 1rem;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }

    h1{
        font-size: 2rem;
        color: #07001f;
        margin-bottom: 1.2rem;
    }

    form input{
        width: 92%;
        outline: none;
        border: 1px solid #fff;
        padding: 12px 20px;
        margin-bottom: 10px;
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
        position: relative;
        left: 120px;
        top: 90%;
        transform: translateY(-270%);
        cursor: pointer;
    }

    button{
        font-size: 1rem;
        margin-top: 1.0rem;
        padding: 10px 0;
        border-radius: 20px;
        outline: none;
        border: none;
        width: 90%;
        color: #fff;
        cursor: pointer;
        background: #385b4f;
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
    .forgot-password {
        text-decoration: none;
        color: #385b4f;
        font-size: 0.7rem;
        left: 7.0em;
        top: 90%;
        transform: translateY(-200%);
        margin-top: 5px;
        display: block;
        position: relative;
    }
    #error-message {
            color: red;
            font-size: 10px;
            margin-top: 5px;
    }
    #password-updated-message {
            color: green;
            font-size: 10px;
            margin-top: 5px;
        }
    .popup-wrapper {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .popup-content {
        background-color: white;
        width: 300px;
        padding: 20px;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<div class="wrapper">
    <h1>LOG IN</h1>

    <form class="form-sign-up" action="includes/login.inc.php" method="post">
        <input id="text" type="text" name="mailuid" placeholder="Username" required><br><br>
        <input id="password" type="password" name="password" placeholder="Password" required><br>
        <div class="password-container">
            <i class="fa fa-eye" id="togglePassword"></i>
            <a href="#" class="forgot-password" onclick="showResetPasswordPopup()">Forgot Password?</a>
        </div>
       <?php
       // Display the success message if the password has been successfully updated
       if (isset($_GET['reset']) && $_GET['reset'] === 'success') {
        echo '<div id="password-updated-message">Password updated! You can now log in.</div>';
    }

    // Display error messages
         if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'wrongpwd') {
                echo '<div id="error-message">Password incorrect. Please try again.</div>';
            } elseif ($error == 'nouser') {
                echo '<div id="error-message">Username not found. Please check your username.</div>';
            }
        }
         ?>
        <button type="submit" id="button" name="Login">LOG IN</button><br>
        <div class="member">
            <div class="member">
                <br> Not a member? <a href="signup.php"><strong>REGISTER NOW</a></strong><br><br>
            </div>
    </form>
</div>

<div id="popupWrapper" class="popup-wrapper">
    <div class="popup-content">
        <p>Do you want to reset your password?</p>
        <button onclick="proceedToForgotPassword()">OK</button>
        <button onclick="closePopup()">Cancel</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        // Initially, set the password input to 'password' and the eye to 'fa-eye-slash'
        passwordInput.type = 'password';
        togglePassword.classList.remove('fa-eye');
        togglePassword.classList.add('fa-eye-slash');

        togglePassword.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            }
        });
    });

    function showResetPasswordPopup() {
        document.getElementById('popupWrapper').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popupWrapper').style.display = 'none';
    }

    function proceedToForgotPassword() {
        // Redirect the user to forgot_password.php
        window.location.href = 'forgot_password.php';
    }
</script>
</body>
</html>

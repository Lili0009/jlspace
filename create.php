<?php
session_start();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your existing login validation code goes here

    // Assuming your login validation is something like this:
    $username = $_POST['mailuid'];
    $password = $_POST['password'];

    // Replace this with your actual login validation logic
    if ($username == 'correct_username' && $password == 'correct_password') {
        // Successful login
        // Reset login attempts counter
        $_SESSION['login_attempts'] = 0;
    } else {
        // Failed login
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 1;
        } else {
            $_SESSION['login_attempts']++;
        }

        // Check if the maximum login attempts are reached
        $max_attempts = 3;
        if ($_SESSION['login_attempts'] >= $max_attempts) {
            // Redirect to the password reset page
            header("Location: forgot_password.php");
            exit();
        } else {
            // Incorrect password message
            header("Location: login.php?error=wrongpwd");
            exit();
        }
    }
}
?>
<div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="#">
			<h1>LOG IN</h1>
			<form class="form-sign-up" action="includes/login.inc.php" method="post">
			<input id="text" type="text" name="mailuid" placeholder="Username" required />
			<input id="password" type="password" name="password" placeholder="Password"required />
			<a href="#" class="forgot-password" onclick="showResetPasswordPopup()">Forgot Password?</a>
			<button type="submit" id="button" name="Login">LOG IN</button><br>
            <div class="member">
                    <br> Not a member? <a href="signup.php"><strong>REGISTER NOW</a></strong><br><br>
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
		</form>
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
        var confirmReset = confirm("Do you want to reset your password?");
        if (confirmReset) {
            // Redirect to the password reset page or perform other actions
            window.location.href = "forgot_password.php";
        }
    }
</script>
	<div class="overlay-container">
		<div class="overlay" style="background-image: url('prod/log.png')">
			<div class="overlay-panel overlay-right">
				<h1>Welcome to JL’s SPACE</h1>
				<p class = "text-signin">Indulge in Handcrafted Delights: Our Homemade Pastries are Love at First Bite!</p>
			</div>
		</div>
	</div>
</div>

<footer>

    <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>

</head>
<body>
 
<style type="text/css">
    * {
	box-sizing: border-box;
    font-family: "Poppins", san-serif;
}
.container{
        width: 330px;
        padding: 2rem 1rem;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
    }
    

body {
	background: #A67051;
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
}

h1 {
	font-weight: bold;
	margin: 0;
}

h2 {
	text-align: center;
}

p {
	font-size: 14px;
	font-weight: 100;
	line-height: 20px;
	letter-spacing: 0.5px;
	margin: 20px 0 30px;
}

span {
	font-size: 12px;
}

a {
	color: #333;
	font-size: 14px;
	text-decoration: none;
	margin: 15px 0;
}

button {
	border-radius: 20px;
	border: 1px solid #A67051;
	background-color: #A67051;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}
button:hover{
        background: #A9A9A9;
		border: 1px solid #A9A9A9;
    }

button:active {
	transform: scale(0.95);
}

button:focus {
	outline: none;
}

form {
	background-color: #FFFFFF;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 50px;
	height: 100%;
	text-align: center;
}

input {
	background-color: #eee;
	border: none;
	padding: 12px 15px;
	margin: 8px 0;
	width: 100%;
}

.container {
	background-color: #fff;
	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	overflow: hidden;
	width: 768px;
	max-width: 100%;
	min-height: 480px;
}
.form-container {
	position: absolute;
	top: 0;
	height: 100%;
	transition: all 0.6s ease-in-out;
}

.sign-in-container {
	left: 0;
	width: 50%;
	z-index: 2;
}
.member{
        font-size: 0.8rem;
        margin-top: 1.4rem;
        color: #636363;
}
.container.right-panel-active .sign-in-container {
	transform: translateX(100%);
}

.sign-up-container {
	left: 0;
	width: 50%;
	opacity: 0;
	z-index: 1;
}

.container.right-panel-active .sign-up-container {
	transform: translateX(100%);
	opacity: 1;
	z-index: 5;
	animation: show 0.6s;
}

@keyframes show {
	0%, 49.99% {
		opacity: 0;
		z-index: 1;
	}
	
	50%, 100% {
		opacity: 1;
		z-index: 5;
	}
}

.overlay-container {
	position: absolute;
	top: 0;
	left: 50%;
	width: 50%;
	height: 100%;
	overflow: hidden;
	transition: transform 0.6s ease-in-out;
	z-index: 100;

}

.container.right-panel-active .overlay-container{
	transform: translateX(-100%);
}

.overlay {
	background: #C2B280;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: 0 0;
	color: #FFFFFF;
	position: relative;
	left: -100%;
	height: 100%;
	width: 200%;
  	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}
.overlay-container .overlay .text-signin{
	margin-bottom: 0%;
    color:black;
    font-weight: bold;
}
.overlay-container .overlay h1{
    color:black;
}

.container.right-panel-active .overlay {
  	transform: translateX(50%);
}

.overlay-panel {
	position: absolute;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	padding: 0 40px;
	text-align: center;
	top: 0;
	height: 100%;
	width: 50%;
	transform: translateX(0);
	transition: transform 0.6s ease-in-out;
}

.overlay-left {
	transform: translateX(-20%);
}

.container.right-panel-active .overlay-left {
	transform: translateX(0);
}

.overlay-right {
	right: 0;
	transform: translateX(0);
}

.container.right-panel-active .overlay-right {
	transform: translateX(20%);
}

footer {
    background-color: #222;
    color: #fff;
    font-size: 14px;
    bottom: 0;
    position: fixed;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 999;
}

footer p {
    margin: 10px 0;
}

footer i {
    color: red;
}

footer a {
    color: #3c97bf;
    text-decoration: none;
}


 
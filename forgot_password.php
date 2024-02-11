<!DOCTYPE html>
<html>
<head>
    <title>Reset password</title>
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
        font-family: "Poppins", sans-serif;
    }
    body{
        background: linear-gradient(90deg, #ecffdc, #749f8d);
    }
    .wrapper{
        width: 330px;
        padding: 2rem 1rem;
        margin: 160px auto;
        background-color: #fff;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        position: relative; /* Add position relative */
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
    button{
        font-size: 1rem;
        margin-top: 1.8rem;
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

    /* Modal styles */
    .modal-wrapper {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .modal-content {
        background-color: white;
        width: 300px;
        padding: 20px;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .modal-button:hover {
        background-color: #A9A9A9;
    }

    .error-message {
        color: red;
        font-size: 0.6rem;
        margin-top: 5px;
        display: none;
    }
</style>
 
<div class="wrapper">
    <h1>Reset password</h1>

    <form class="form-sign-up" id="resetForm" action="email_verification.php" method="post">
        <div class="otp-container">
            <input id="email" type="email" name="email" placeholder="Email" required>
            <p class="error-message" id="emailErrorMessage">Please enter your email.</p>
            <button type="button" id="generateOTP">Get OTP</button>
        </div>
        <input type="hidden" id="otp" name="otp"> <!-- Hidden field to store OTP -->
        <div class="otp-timer" id="otpTimer"></div>
        
        <p id="loginAttemptsError" style="display: none;">Login attempts exceeded. Please wait for <span id="timeoutRemaining"></span> seconds before trying again.</p>
    </form>

    <button class="back-button" id="cancelButton">Cancel</button>

    <!-- Modal wrapper -->
    <div id="customModal" class="modal-wrapper">
        <div class="modal-content">
            <p>Are you sure you want to cancel?</p>
            <button class="modal-button" id="confirmYesButton">Yes</button>
            <button class="modal-button" id="confirmNoButton">No</button>
        </div>
    </div>

<script>
    document.getElementById('cancelButton').addEventListener('click', function() {
        openModal();
    });

    document.getElementById('confirmYesButton').addEventListener('click', function() {
        closeModal();
        window.location.href = "login.php"; // User confirmed, go back to the login page
    });

    document.getElementById('confirmNoButton').addEventListener('click', function() {
        closeModal();
    });

    document.getElementById('generateOTP').addEventListener('click', function() {
        var emailInput = document.getElementById('email');
        var errorMessage = document.getElementById('emailErrorMessage');
        if (emailInput.value.trim() !== '') { // Check if email field is not empty
            document.getElementById('resetForm').submit(); // Submit the form
        } else {
            errorMessage.style.display = 'block'; // Show error message
        }
    });

    function openModal() {
        document.getElementById('customModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('customModal').style.display = 'none';
    }
</script>
</div>
</body>
</html>

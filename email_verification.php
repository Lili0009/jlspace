<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the OTP entered by the user matches the generated OTP
    if ($_POST['otp'] == $_SESSION['otp']) {
        // If OTP matches, proceed with password reset process
        // Redirect to a password reset page or perform necessary actions
        header("Location: reset_password.php");
        exit();
    } else {
        // If OTP does not match, display error message
        $error_message = "Invalid OTP. Please try again.";
    }
}

// Generate a new OTP and store it in session
$_SESSION['otp'] = generateOTP();

// Function to generate OTP
function generateOTP() {
    return mt_rand(100000, 999999); // Generate a random 6-digit OTP
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <!-- Add your CSS links and styles here -->
</head>
<body>
    <h1>Email Verification</h1>
    
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <p>An OTP has been sent to your email. Please enter the OTP below to verify your email address.</p>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>

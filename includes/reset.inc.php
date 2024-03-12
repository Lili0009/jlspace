<?php
if (isset($_POST['resetPassword'])) {
    require 'dbh.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if any of the fields is empty
    if (empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=invalidemail");
        exit();
    }

    // Check if the password and confirm password match
    if ($password !== $confirmPassword) {
        header("Location: ../reset_password.php?error=passwordnomatch");
        exit();
    }

    // Check if the password meets the required criteria
    if (!isPasswordValid($password)) {
        header("Location: ../reset_password.php?error=invalidpassword");
        exit();
    }

    // Check if the email corresponds to a user in your database
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = mysqli_stmt_init($con);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Update the password
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $updateSql = "UPDATE customers SET pwd =? WHERE email =?";
            $updateStmt = mysqli_stmt_init($con);
        

            if (!mysqli_stmt_prepare($updateStmt, $updateSql)) {
                header("Location: ../login.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($updateStmt, "ss", $hashedPwd, $email);
                mysqli_stmt_execute($updateStmt);
                header("Location: ../login.php?reset=success");
                exit();
            }
        } else {
            // Handle the case where the email doesn't exist in the database
            header("Location: ../login.php?error=invalidemail");
            exit();
        }
    }
} else {
    // Redirect to the login page if the form wasn't submitted
    header("Location: ../login.php");
    exit();
}

// Close database connection
mysqli_stmt_close($stmt);
mysqli_stmt_close($updateStmt);
mysqli_close($con);

// Function to check if the password meets the required criteria
function isPasswordValid($password) {
    // Password must be at least 8 characters long
    return strlen($password) >= 8;
}
?>
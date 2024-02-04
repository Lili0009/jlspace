<?php
if(isset($_POST['Signup'])){
    require 'dbh.inc.php';

    $username = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $rpass = $_POST['repassword'];
    $un_length = strlen($username);

    if ($un_length < 5 || $un_length > 30) {
        header("Location: ../signup.php?error=username_short&mail=" . $email);
        exit();
    }

     if(empty($username) || empty($email) || empty($pass) || empty($rpass)){
        header("Location: ../signup.php?error=emptyfields&uname=".$username."&mail=".$email);
        exit();
     }
     else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invalidmailuname&uname");
        exit();
     }
     else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&uname=".$username);
        exit();
     }
     else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=invaliduname&mail=".$email);
        exit();
     }
     else if($pass !== $rpass){
        header("Location: ../signup.php?error=passwordcheck&uname=".$username."&mail=".$email);
        exit();
     } 
     else if (!isValidPassword($pass)) {
        header("Location: ../signup.php?error=invalidpassword&uname=" . $username . "&mail=" . $email);
        exit();
    }
     else{
        $sql = "SELECT cidCustomer FROM customers WHERE cidCustomer =?";
        $sql_email = "SELECT email FROM customers WHERE email =?";
        $stmt = mysqli_stmt_init($con);
        $stmt_email = mysqli_stmt_init($con);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        if(!mysqli_stmt_prepare($stmt_email, $sql_email)){
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            mysqli_stmt_bind_param($stmt_email, "s", $email);
            mysqli_stmt_execute($stmt_email);
            mysqli_stmt_store_result($stmt_email);

            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../signup.php?error=usertaken&mail=".$email);
            exit();
            }
            $resultCheck_email = mysqli_stmt_num_rows($stmt_email);
            if($resultCheck_email > 0){
                header("Location: ../signup.php?error=emailtaken&mail=".$email);
            exit();
            }

            else{
                $sql = "INSERT INTO customers(cidCustomer, email, pwd) VALUES(?, ?, ?)";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    
                }
            }
        }
     }
     mysqli_stmt_close($stmt);
     mysqli_close($con);
} 
else{
    header("Location: ../signup.php?signup");
    exit(); 
}

function isValidPassword($password)
{
    // Add your password requirements here
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/";
    return preg_match($pattern, $password);
}
?>
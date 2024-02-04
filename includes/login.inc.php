<?php
if(isset($_POST['Login'])){
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['password'];

    if(empty($mailuid) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit(); 
    }
    else{
        $sql = "SELECT * FROM customers WHERE cidCustomer = ? OR email = ?";
        $stmt = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerrors");
            exit(); 
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwd']);

                if($pwdCheck == false){
                    header("Location: ../login.php?error=wrongpwd");
                    exit(); 
                }
                else if($pwdCheck == true){
                    if($row['cidCustomer'] == 'admin'){
                        session_start();
                        $_SESSION['userId'] = $row['customer_id'];
                        $_SESSION['userUId'] = $row['cidCustomer'];

                        header("Location: ../index_admin.php?login=success");
                        exit();
                    }
                    else{
                        session_start();
                        $_SESSION['userId'] = $row['customer_id'];
                        $_SESSION['userUId'] = $row['cidCustomer'];

                        header("Location: ../index_cust.php?login=success");
                        exit();
                    }
                }
                else{
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ../login.php?error=nouser");
                exit(); 
            }
        }

    }
}

if(isset($_POST['delete_product'])){
    require 'dbh.inc.php';

    $password = $_POST['password'];
    $product_id = $_POST['delete_p_id'];
    if(empty($password)){
        header("Location: ../admin.php?error=emptyfields");
        exit(); 
    }
    else{
        $sql = "SELECT * FROM customers WHERE cidCustomer = 'admin'";
        $stmt = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../admin.php?error=sqlerrors");
            exit(); 
        }
        else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwd']);

                if($pwdCheck == false){
                    header("Location: ../admin.php?error=wrongpwd");
                    exit(); 
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['prod_id'] = $product_id;

                    header("Location: ../admin.php?authentication=success");
                    exit();
                }
                else{
                    header("Location: ../admin.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ../admin.php?error=nouser");
                exit(); 
            }
        }

    }
}
if(isset($_POST['update_product'])){
    require 'dbh.inc.php';

    $password = $_POST['password'];
    $product_id = $_POST['update_p_id'];
    if(empty($password)){
        header("Location: ../admin.php?error=emptyfields");
        exit(); 
    }
    else{
        $sql = "SELECT * FROM customers WHERE cidCustomer = 'admin'";
        $stmt = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../admin.php?error=sqlerrors");
            exit(); 
        }
        else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwd']);

                if($pwdCheck == false){
                    header("Location: ../admin.php?error=wrongpwd");
                    exit(); 
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['prod_id'] = $product_id;

                    header("Location: ../admin.php?authentication_update=success");
                    exit();
                }
                else{
                    header("Location: ../admin.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ../admin.php?error=nouser");
                exit(); 
            }
        }

    }
}
else{
    header("Location: ../admin.php?success");
    exit(); 
}

?>

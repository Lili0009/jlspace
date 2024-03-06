<?php
session_start();

include("includes/dbh.inc.php");
if (isset($_SESSION['userId'])) {
        $id = $_SESSION['userId'];
    
        
        $cartct = mysqli_query($con, "SELECT * FROM cart WHERE customer_id = $id");
        $ct = mysqli_num_rows($cartct);
    
        
        if ($_SESSION['userUId'] == 'admin') {
            $orderct = mysqli_query($con, "SELECT * FROM orders where CAST(date AS DATE) = CAST( curdate() AS DATE) AND order_status = 'Pending'");
            $order_count = mysqli_num_rows($orderct);
        } else {
            $order_count = 0; 
        }
    
    } else {
        $ct = ' ';
        $order_count = ' ';
    
        echo "<script>
            location.replace('login.php')
            </script>";
    }
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="design.css">
   <link rel="stylesheet" href="style.css">
</head>
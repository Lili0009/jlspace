<?php
include("includes/dbh.inc.php");

if (isset($_GET['update_order_id'])) {
    $order_id = $_GET['update_order_id'];

    
    $update_order_query = mysqli_query($con, "UPDATE `orders` SET order_status = 'Completed' WHERE order_id = '$order_id'");

    header('location: orders.php');
}

?>
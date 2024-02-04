<?php
include 'header.php';
include("includes/dbh.inc.php");


if(isset($_POST['order_btn'])){

   $userId =  $_SESSION['userId'];
   $query1 = mysqli_query($con, "SELECT * FROM `cart` WHERE customer_id = $userId");
   

   $quantity = 0;
   $price = 0;
   $grand_total = 0;

   if(mysqli_num_rows($query1) > 0){
      while($fetch_cart = mysqli_fetch_assoc($query1)){
         $prod_name = $fetch_cart['name'];
         $price = $fetch_cart['price'];
         $quantity = $fetch_cart['quantity'];
         $image = $fetch_cart['image'];

         $monthdate = date('F');
         $monthdateyear = date('F-Y');
         $order = mysqli_query($con, "INSERT INTO orders(customer_id, image, product_name, price, quantity, month, month_year ) VALUES('$userId', '$image', '$prod_name', '$price', '$quantity', '$monthdate','$monthdateyear')") or die('query failed');
         
          $select_cart = mysqli_query($con, "SELECT * FROM `products` where product_name='$prod_name'");
          while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $stocks = $fetch_cart['total_stocks'];
          }

          $stocksdeduct = $stocks - $quantity;
          $update_query = mysqli_query($con, "UPDATE `products` SET total_stocks = '$stocksdeduct' WHERE product_name = '$prod_name'");


      }
   }
   

   if($query1 && $order){
      
      echo "
      
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for ordering!</h3>
         <a href='customers_order.php' class='btn' name = 'continue_shop_btn'>view order</a>
         </div>
      </div>
      
      ";
      mysqli_query($con, "DELETE FROM `cart` WHERE customer_id = $userId");

   }
}
?>


<title>Check out</title>

<header>
        <nav>
        <?php
          if(isset($_SESSION['userUId'])){
            if($_SESSION['userUId'] == 'admin'){
            echo '<a href="index_admin.php"><img class = "image-logo" src="logo.png"></a>';
            }
            else{
              echo '<a href="index_cust.php"><img class = "image-logo" src="logo.png"></a>';
            }
          }
        ?>
           <ul class="head-ul">
              
   <?php
	if(isset($_SESSION['userUId'])){
		if($_SESSION['userUId'] == 'admin'){
			echo '
         <li><a href="index_admin.php">Home</a></li>
         <li><a href="Products.php">Customer View</a></li>
         <li><a href ="admin.php">ADMIN</a></li>
			<li><a href ="orders.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clipboard-check-fill" viewBox="0 0 16 16">
          <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm6.854 7.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>
          </svg><span class="ordernum"> '.$order_count.'</span></a></li>
			<li><a href="logout.php"">LOG OUT</a></li>';
		}
		else{

            echo '
            <li><a href="index_cust.php">Home</a></li>
              <li><a href="Products.php">Products</a></li>
              <li><a href="about.php">About</a></li>
            <li><a class = "active"  href ="cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
          </svg><span class="cartnum"> '.$ct.'</span></a></li>
          
				<div class="dropdown">
                        <li><a><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                      </svg></button></a></li>
                        <div class = "dropdown-content">
                                <a href="profile.php"><center>MY PROFILE</center></a>
								<a href="customers_order.php"><center>ORDERS</center></a>
                                <a href="logout.php"><center>LOG OUT</center></a>
                        </div>
                    </div>';
		}
	}
    
	else{
		echo '<li><a href ="about.php">ABOUT</a></li>
		<div class="dropdown">
                        <li><a>ACCOUNT</button></a></li>
                        <div class = "dropdown-content">
                                <a href="login.php"><center>LOG IN</center></a>
                                <a href="signup.php"><center>SIGN UP</center></a>
                        </div>
                    </div>';
	}
       
	
	?>
           </ul>
        </nav>
</header>


<body><br>

<div class="container" style="background-color: #F4F3E6;">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $userId =  $_SESSION['userId'];
         $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE customer_id = $userId");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
         }
      ?>
      <span class="grand-total"> grand total : P<?= number_format($grand_total, 2, '.',','); ?> </span>
   </div>
<div class = "flex">
    <?php
        $id = $_SESSION['userId'];
        $query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$id'");
        if(mysqli_num_rows($query) > 0){
            while($fetch_detail = mysqli_fetch_assoc($query)){
    ?>
        
         <div class="inputBox">
            <span>Name</span>
            <input type="text" value = "<?php echo $fetch_detail['first_name'] . ' '. $fetch_detail['last_name'];?>" name="name" readonly>
         </div>
         <div class="inputBox">
            <span>Email</span>
            <input type="text" value = "<?php echo $fetch_detail['email'];?>" readonly>
         </div>
         <div class="inputBox">
            <span>Phone Number</span>
            <input type="text" value = "<?php echo $fetch_detail['phone_num'];?>" readonly>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <input type="text" value = "<?php echo $fetch_detail['payment_method'];?>" readonly>
         </div>
         <div class="inputBox">
            <span>Address 1</span>
            <input type="text" value = "<?php echo $fetch_detail['address1'];?>" readonly>
         </div>
         <div class="inputBox">
            <span>Address 2</span>
            <input type="text" value = "<?php echo $fetch_detail['address2'];?>" readonly>
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" value = "<?php echo $fetch_detail['city'];?>" readonly>
         </div>
         <div class="inputBox">
            <span>Pin Code</span>
            <input type="text" value = "<?php echo $fetch_detail['pin_code'];?>" readonly>
         </div>
         <?php
         $select_details = mysqli_query($con, "SELECT first_name, last_name, phone_num, payment_method, address1, city, pin_code, email FROM `customers` WHERE customer_id = $userId");
         while($fetch_details = mysqli_fetch_assoc($select_details)){
            if($fetch_details['first_name'] == NULL || $fetch_details['last_name'] == NULL || $fetch_details['phone_num'] == 'NULL' || $fetch_details['payment_method'] == NULL || $fetch_details['address1'] == NULL || $fetch_details['city'] == NULL || $fetch_details['pin_code'] == NULL ){
         ?>
         <div class='display-info'>
            <div class='info-message'>
            <h3>Fill fields to continue shopping!
            <a href ="Profile.php" class='btn'>Edit details</a></h3>
            </div>
            </div>
         <?php
            }
         }
         ?>
            </div>
             <input type="submit" value="order now" name="order_btn" class="btn">
   </form>
   <?php
             if(isset($_POST['edit'])){
                header('location:profile.php');
             }
             ?>

<?php
}
}
         }
         ?>
        
        
</div>
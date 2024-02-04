<?php 
	include "header.php";

    if(isset($_POST['save_btn'])){
        $customer_id = $_SESSION['userId'];
        $user_name = $_POST['userName'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $address1 = $_POST['address1'];
        $method = $_POST['method'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $pin_code = $_POST['pin_code'];

        $query = mysqli_query($con, "UPDATE customers SET cidCustomer = '$user_name', first_name = '$fname', last_name = '$lname', phone_num = $number, payment_method = '$method', address1 = '$address1', address2 = '$address2', city = '$city' , pin_code = $pin_code, email = '$email' WHERE customer_id = $customer_id ");
        
        if($query){
            $message[] = 'product updated succesfully';
            header('location:profile.php');
         }else{
            $message[] = 'product could not be updated';
            header('location:profile.php');
         }
    
    }

?>
<title>Profile</title>
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
         <li><a href="index_admin.php">Dashboard</a></li>
              <li><a href="Products.php">Customer View</a></li>
         <li><a href ="admin.php">ADMIN</a></li>
						<li><a href ="orders.php">ORDERS</a></li>
							<li><a href="logout.php"">LOG OUT</a></li>';
		}
		else{

            echo '
            <li><a href="index_cust.php">Home</a></li>
              <li><a href="Products.php">Products</a></li>
              <li><a href="about.php">About</a></li>
            <li><a href ="cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
          </svg><span class="cartnum"> '.$ct.'</span></a></li>
          
				<div class="dropdown">
                        <li><a><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                      </svg></button></a></li>
                        <div class = "dropdown-content">
                                <a  class = "active" href="profile.php"><center>MY PROFILE</center></a>
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

<div class = "container">
<section class="checkout-form">
<form action="" method="post">
<div class = "flex">
    <?php
        $id = $_SESSION['userId'];
        $query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$id'");
        if(mysqli_num_rows($query) > 0){
            while($fetch_detail = mysqli_fetch_assoc($query)){
    ?>
        <h1 class="heading">HELLO <?php echo $fetch_detail['cidCustomer']?>!</h1>
        <div class="flex">
         <div class="inputBox">
            <span>First Name</span>
            <input type="text" value = "<?php echo $fetch_detail['first_name'];?>" name="fname" required>
         </div>
         <div class="inputBox">
            <span>Last Name</span>
            <input type="text" value = "<?php echo $fetch_detail['last_name'];?>" name="lname" required>
         </div>
         <div class="inputBox">
            <span>Username</span>
            <input type="text" value = "<?php echo $fetch_detail['cidCustomer'];?>" name="userName" required>
         </div>
         <div class="inputBox">
            <span>Email</span>
            <input type="text" value = "<?php echo $fetch_detail['email'];?>" name="email" required>
         </div>
         <div class="inputBox">
            <span>Phone Number</span>
            <input type="text" value = "<?php echo $fetch_detail['phone_num'];?>" name="number" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
             <option value="<?php echo $fetch_detail['payment_method'];?>" selected> <?php echo $fetch_detail['payment_method'];?></option>
               <option value="cash on delivery">cash on delivery</option>
               <option value="GCash">GCash</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address 1</span>
            <input type="text" value = "<?php echo $fetch_detail['address1'];?>" name="address1" required>
         </div>
         <div class="inputBox">
            <span>Address 2</span>
            <input type="text" value = "<?php echo $fetch_detail['address2'];?>" name="address2" >
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" value = "<?php echo $fetch_detail['city'];?>" name="city" required>
         </div>
         <div class="inputBox">
            <span>Pin Code</span>
            <input type="text" value = "<?php echo $fetch_detail['pin_code'];?>" name="pin_code" required>
         </div>
            </div>
             <input type="submit" value="SAVE" name="save_btn" class="save_btn">

   </form>


<?php
}
}
?>
</div>
<?php
include 'header.php';
include("includes/dbh.inc.php");
?>


<title>Orders</title>

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
                                <a href="profile.php"><center>MY PROFILE</center></a>
								<a class = "active" href="customers_order.php"><center>ORDERS</center></a>
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


<br>
<div class="container"  style="background-color: #ECFFDC;">



<section class="shopping-cart">

   <h1 class="heading">orders</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total</th>
         <th>order status</th>
         <th>payment status</th>
      </thead>

      <tbody>

         <?php 
          $customer_id = $_SESSION['userId'];
          $select_order = mysqli_query($con, "SELECT * FROM `orders` WHERE customer_id = '$customer_id'");
         $grand_total = 0.00;
         if(mysqli_num_rows($select_order) > 0){
            while($fetch_order = mysqli_fetch_assoc($select_order)){
         ?>

         <tr>
            <td><img src="prod/<?php echo $fetch_order['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_order['product_name']; ?></td>
            <td>P<?php echo number_format($fetch_order['price'], 2, '.',','); ?></td>
            <td><?php echo $fetch_order['quantity']; ?></td>
            <td>P<?php 
                     $total = $fetch_order['price'] * $fetch_order['quantity'];
                     echo number_format($total, 2, '.',',');
                     $sub_total = $fetch_order['price'] * $fetch_order['quantity']; ?></td>
            <td><?php echo $fetch_order['order_status']; ?></td>
            <td><?php echo $fetch_order['payment_status']; ?></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="products.php" class="option-btn" style="margin-top: 0;">shop</a></td>
            <td colspan="3">grand total</td>
            <td>P<?php echo number_format($grand_total, 2, '.',','); ?></td>
            <td></td>
            <td></td>
         </tr>

      </tbody>

   </table>

</section>

</div>

<br><br><br><br>
<?php
include "footer.php";
?>
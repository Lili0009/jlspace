<?php 
	include "header.php";
?>

<style>
   .image{
   transition: .3s ease-in-out;
  }
  .image:hover{
   transform: scale(1.2);
   z-index: 2;
  }
</style>

<title>Home</title>

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
         <li><a class = "active" href="index_admin.php">Dashboard</a></li>
         <li><a href ="admin.php">ADMIN</a></li>
						<li><a href ="orders.php">ORDERS</a></li>
							<li><a href="logout.php"">LOG OUT</a></li>';
		}
		else{
            echo '
            <li><a class = "active" href="index_cust.php">Home</a></li>
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
<div class = "sale">
	<h1 style="color:#555;font-family: 'Poppins' , sans-serif;font-size: 50px;" class = "newArrival">FRESHLY BAKED</h1>
	<p style="padding-left: 200px;padding-bottom: 20px;color:#555;">Celebrate your special day with us</p>
	<a href="Products.php#best-seller" class="explore-btn">Order Now &#8594;</a>
</div>
<br><br><br><br>

<div class="small-container">
<section class="products home-products">
   <h1 class="top-prod-title">Today's Special</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM products WHERE description = 'special' ORDER BY product_name ASC");
      
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <div class = "image">
               <a href="Products.php#specials"><img src="prod/<?php echo $fetch_product['image']; ?>" alt=""></a>
            </div>            
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">₱<?php echo number_format($fetch_product['price'], 2, '.',','); ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         </div>
      </form>
      <?php
         };
      };
      ?>

   </div>
</section>

</div>


<br><br>
<?php
include "footer.php";
?>
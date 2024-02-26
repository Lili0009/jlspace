<?php
include 'header.php';
include("includes/dbh.inc.php");

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $customer_id = $_SESSION['userId'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND customer_id = '$customer_id'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query ($con, "INSERT INTO cart(customer_id, name, price, image, quantity) VALUES($customer_id, '$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }


}
?>



<style>
  .message-container {
    position: fixed;
    top: 0;
    right: 0;
    padding: 15px;
    z-index: 9999;
    width: 300px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }

  .message {
    background-color:  #ECFFDC; 
    color: #fff;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    opacity: 0;
    transform: translateY(-20px);
    animation: fadeInOut 0.5s ease-out forwards;
  }

  .message.error {
    background-color:  #ECFFDC;
  }

  @keyframes fadeInOut {
    0% {
      opacity: 0;
      transform: translateY(-20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .message span {
    flex: 1;
    margin-right: 10px;
  }

  .message i {
    cursor: pointer;
    color:  #639277;
    transition: color 0.3s; 
  }

 
  .message i:hover {
    color: black; 
  }

  .small-font {
    font-size: 10px; 
  }
  .image{
   transition: .3s ease-in-out;
  }
  .image:hover{
   transform: scale(1.2);
   z-index: 2;
  }
  /* popup for image in products */
  .popup {
   display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    z-index: 2;
}
.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black */
    z-index: 1;
}
.show-overlay {
    display: block;
}

.popup-text {
    font-size: 14px;
    color: black;
}

.show {
    display: block;
}
.close {
  position: absolute;
  top: 5px;
  right: 10px;
  cursor: pointer;
  color: black;
}
/* end of popup for image in products */
</style>


<title>Products</title>
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
         <li><a class = "active" href="Products.php">Customer View</a></li>
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
              <li><a class = "active" href="Products.php">Products</a></li>
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
   
<?php
if(isset($message)){
   echo '<div class="message-container">';
   foreach($message as $msg){
      $class = (strpos($msg, 'error') !== false) ? 'error' : '';
      echo '<div class="message ' . $class . ' small-font"><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
   };
   echo '</div>';
}
?>
<br>

<div class="container" class="container">

<section class="products">

   <h1 class="heading">BEST SELLER</h1>

   <div class="box-container">

      <?php

      $select_products = mysqli_query($con, "SELECT * FROM products WHERE description = 'best-seller' ORDER BY product_name ASC");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <div class="image">
               <img src="prod/<?php echo $fetch_product['image']; ?>" alt="Image" onclick="showDescription(<?php echo $fetch_product['product_id']; ?>)">
            </div>
               <div id="popup-<?php echo $fetch_product['product_id']; ?>" class="popup">
                  <span class="close" id="close-popup">&times;</span>
                  <p><?php echo $fetch_product['description_txt']; ?></p>
               </div>
               <div id="overlay" class="overlay" onclick="hideDescription()"></div>
            <h3><?php echo $fetch_product['product_name']; ?></h3> 
            <a href = "description.php"><div class="price">₱<?php echo number_format($fetch_product['price'], 2, '.',','); ?></div></a>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <?php
               if ($fetch_product['total_stocks'] > 0){
                  if(isset($_SESSION['userUId'])){
                     if($_SESSION['userUId'] != 'admin'){
                        echo '<input type="submit" class="add-btn" value="add to cart" name="add_to_cart">';
                     }
                     else if($_SESSION['userUId'] == 'admin'){
                        echo '<input type="text" style="background-color:red;" class="add-btn" value="out of stock">';
                     }
                  }
               }else{
                  echo '<a ><input  disabled type="text" class="add-btn" value="out of stock" style="background-color:red;"></a>';
               }
            ?>
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>
<br><br><br>



<div id = "specials" class="container">

<section class="products">
   <h1 class="heading" id = "cookie-brownie">Today's Special</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM products WHERE description = 'special' ORDER BY product_name ASC");
      
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <div class = "image">
               <img src="prod/<?php echo $fetch_product['image']; ?>" alt="">
            </div>            
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">₱<?php echo number_format($fetch_product['price'], 2, '.',','); ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <?php
               if ($fetch_product['total_stocks'] > 0){
                  if(isset($_SESSION['userUId'])){
                     if($_SESSION['userUId'] != 'admin'){
                        echo '<input type="submit" class="add-btn" value="add to cart" name="add_to_cart">';
                     }
                     else if($_SESSION['userUId'] == 'admin'){
                        echo $fetch_product['total_stocks'];
                     }
                  }
               }else{
                  echo '<a ><input  disabled type="text" class="add-btn" value="out of stock" style="background-color:red;"></a>';
               }
            ?>
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>
</section>

</div>
<br><br><br>




<div class="container">

<section class="products">

   <h1 class="heading" id = "cookie-brownie">COOKIES & BROWNIES</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM products WHERE description = 'cookie-brownie' ORDER BY product_name ASC");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <div class = "image">
               <img src="prod/<?php echo $fetch_product['image']; ?>" alt="">
            </div>            
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">₱<?php echo number_format($fetch_product['price'], 2, '.',','); ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <?php
               if ($fetch_product['total_stocks'] > 0){
                  if(isset($_SESSION['userUId'])){
                     if($_SESSION['userUId'] != 'admin'){
                        echo '<input type="submit" class="add-btn" value="add to cart" name="add_to_cart">';
                     }
                     else if($_SESSION['userUId'] == 'admin'){
                        echo $fetch_product['total_stocks'];                     
                     }
                  }
               }else{
                  echo '<a ><input  disabled type="text" class="add-btn" value="out of stock" style="background-color:red;"></a>';
               }
            ?>
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>
<br><br><br>



<div class="container" class="container">

<section class="products">

   <h1 class="heading">DONUTS & MUFFINS</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM products WHERE description = 'donuts-muffin' ORDER BY product_name ASC");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <div class = "image">
               <img src="prod/<?php echo $fetch_product['image']; ?>" alt="">
            </div>            
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">₱<?php echo number_format($fetch_product['price'], 2, '.',','); ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <?php
               if ($fetch_product['total_stocks'] > 0){
                  if(isset($_SESSION['userUId'])){
                     if($_SESSION['userUId'] != 'admin'){
                        echo '<input type="submit" class="add-btn" value="add to cart" name="add_to_cart">';
                     }
                     else if($_SESSION['userUId'] == 'admin'){
                        echo $fetch_product['total_stocks'];   
                     }
                  }
               }else{
                  echo '<a ><input  disabled type="text" class="add-btn" value="out of stock" style="background-color:red;"></a>';
               }
            ?>
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>
<br><br><br>




<div class="container" >

<section class="products">

   <h1 class="heading">BOX SPECIALS</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM products WHERE description = 'box-specials' ORDER BY product_name ASC");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
         <div class = "image">
               <img src="prod/<?php echo $fetch_product['image']; ?>" alt="">
            </div>
            <h3><?php echo $fetch_product['product_name']; ?></h3>
            <div class="price">₱<?php echo number_format($fetch_product['price'], 2, '.',','); ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <?php
               if ($fetch_product['total_stocks'] > 0){
                  if(isset($_SESSION['userUId'])){
                     if($_SESSION['userUId'] != 'admin'){
                        echo '<input type="submit" class="add-btn" value="add to cart" name="add_to_cart">';
                     }
                     else if($_SESSION['userUId'] == 'admin'){
                        echo $fetch_product['total_stocks'];
                     }
                  }
               }else{
                  echo '<a ><input  disabled type="text" class="add-btn" value="out of stock" style="background-color:red;"></a>';
               }
            ?>
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>
<br><br><br>

<?php
include "footer.php";
?>

<!-- JavaScript to toggle popup display -->
<script>
function showDescription(id) {
    var popup = document.getElementById('popup-' + id);
    var overlay = document.getElementById('overlay');
    popup.classList.toggle('show');
    overlay.classList.toggle('show-overlay');
}
const closePopup = document.getElementById('close-popup');
closePopup.addEventListener('click', () => {
        termsPopup.style.display = 'none';
    });

    function hideDescription() {
    var popup = document.querySelector('.popup.show');
    var overlay = document.getElementById('overlay');
    if (popup) {
        popup.classList.remove('show');
    }
    if (overlay) {
        overlay.classList.remove('show-overlay');
    }
}
</script>
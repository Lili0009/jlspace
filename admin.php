<?php

include('header.php');


if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_description = $_POST['description'];
   $p_stock = $_POST['p_stock'];

   $insert_query = mysqli_query($con, "INSERT INTO `products`(product_name, description, price, image,total_stocks) VALUES('$p_name','$p_description', '$p_price', '$p_image','$p_stock')") or die('query failed');

   if($insert_query){
      $message[] = 'product added succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_POST['update'])){
         $update_p_id = $_POST['update_p_id'];
         $update_p_name = $_POST['update_p_name'];
         $update_p_price = $_POST['update_p_price'];
         $update_descritpion = $_POST['update_description'];
         $update_p_image = $_FILES['update_p_image']['name'];
         $update_stocks = $_POST['update_stocks'];
               if(!empty($update_p_image)){
               $update_query = mysqli_query($con, "UPDATE `products` SET product_name = '$update_p_name', description = '$update_descritpion', price = '$update_p_price', image = '$update_p_image', total_stocks = '$update_stocks' WHERE product_id = '$update_p_id'");
               }else{
               $update_query = mysqli_query($con, "UPDATE `products` SET product_name = '$update_p_name', description = '$update_descritpion', price = '$update_p_price', total_stocks = '$update_stocks' WHERE product_id = '$update_p_id'");
               }
         if($update_query){
            $message[] = 'product updated succesfully';
            header('location:admin.php');
         }else{
            $message[] = 'product could not be updated';
            header('location:admin.php');
         }
      }
 



if(isset($_GET['authentication'])){
   if($_GET['authentication'] == "success"){
      $delete = $_SESSION['prod_id'];
      $delete_query = mysqli_query($con, "DELETE FROM `products` WHERE product_id = $delete") or die('query failed');
      $message[] = 'product has been deleted';
   };

};

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
</style>

<title>ADMIN</title>
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
            <li><a class = "active" href ="admin.php">ADMIN</a></li>
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
								<a  href="customers_order.php"><center>ORDERS</center></a>
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
   
<?php
if(isset($message)){
   echo '<div class="message-container">';
   foreach($message as $msg){
      $class = (strpos($msg, 'error') !== false) ? 'error' : '';
      echo '<div class="message ' . $class . ' small-font"><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
   };
   echo '</div>';
}
if(isset($_POST['cancel'])){
   header("Location: admin.php");
}
?>


<section class = "add-prod">
<?php

if(isset($_GET['authentication_update'])){
   if($_GET['authentication_update'] == "success"){
   $edit_id = $_SESSION['prod_id'];
   $edit_query = mysqli_query($con, "SELECT * FROM `products` WHERE product_id = $edit_id") or die('query failed');
   if(mysqli_num_rows($edit_query) > 0){
      while($fetch_edit = mysqli_fetch_assoc($edit_query)){
?>

   <div class='edit-form-container'>
         <div class='edit-img'>
            <img src="prod/<?php echo $fetch_edit['image']; ?>" alt="" class = "image">
         </div>
      <form method="post" class="edit-product-form" enctype="multipart/form-data">
      <p id = "edit">edit product</p>
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['product_id']; ?>"> 
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['product_name']; ?>">
      <input type="text" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="text" class="box" required name="update_stocks" value="<?php echo $fetch_edit['total_stocks']; ?>">

      <h5>DESCRIPTION </h5>
         <select name="update_description" class = "box">
               <option name = "<?php echo $fetch_edit['description']; ?>" value="<?php echo $fetch_edit['description']; ?>" selected><?php echo $fetch_edit['description']; ?></option>
               <option name = "best-seller" value="best-seller">Best Seller</option>
               <option name = "special" value="special">Today's Special</option>
               <option name = "cookie-brownie" value="cookie-brownie">Cookies & Brownie</option>
               <option name = "donuts-muffin" value="donuts-muffin">Donuts & Muffins</option>
               <option name = "box-specials" value="box-specials">Box Specials</option>
            </select>   
      <input type="file" class="box" name="update_p_image" accept="image/png, image/jpg, image/jpeg" value="<?php echo $fetch_edit['image']; ?>">
      <input type="submit" value="update the prodcut" name="update" class="btn">
      <input type="submit" value="cancel" name="cancel" id="close-edit" class="option-btn">
</form>
</div>
    
<?php
            };
         };
      };
   }





if(isset($_GET['delete'])){
   
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($con, "SELECT * FROM `products` WHERE product_id = $delete_id");
   if(mysqli_num_rows($delete_query) > 0){
      $fetch_delete = mysqli_fetch_assoc($delete_query)
  
?>
      <div class='order-message-container'>
      <form class="add-product-form" action="includes/login.inc.php" method="post">
      <p id = "edit">AUTHENTICATION</p>
      <input type="hidden" name="delete_p_id" value="<?php echo $fetch_delete['product_id']; ?>"> 
      <input type="text" name="mailuid" placeholder="Username" class = "box"> 
      <input id="password" type="password" name="password" placeholder="Password" class = "box"><br>
  
      <input type="submit" value="delete the prodcut" name="delete_product" class="btn">
      <input type="submit" value="cancel" name="cancel" id="close-edit" class="option-btn">

      <?php
      
};

   };


?>
</form>
</div>

<?php
if(isset($_GET['edit'])){
   
   $update_id = $_GET['edit'];
   $update_query = mysqli_query($con, "SELECT * FROM `products` WHERE product_id = $update_id");
   if(mysqli_num_rows($update_query) > 0){
      $fetch_update = mysqli_fetch_assoc($update_query)
  
?>
      <div class='order-message-container'>
      <form class="add-product-form" action="includes/login.inc.php" method="post">
      <p id = "edit">AUTHENTICATION</p>
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['product_id']; ?>"> 
      <input type="text" name="mailuid" placeholder="Username" class = "box"> 
      <input id="password" type="password" name="password" placeholder="Password" class = "box"><br>
  
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
      <input type="submit" value="cancel" name="cancel" id="close-edit" class="option-btn">

      <?php
      
};

   };


?>
</form>
</div>

</section>




<section class="shopping-cart">
   
   <table style="margin-top: -100px;">
      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($con, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="prod/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['product_name']; ?></td>
            <td>P <?php echo number_format($row['price'], 2, '.',','); ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['product_id']; ?>" class="delete-btn" name = "delete"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['product_id']; ?>" name="edit" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>



<section class = "add-prod">
<form method="post" class="add-product-form" enctype="multipart/form-data">
<p id = "edit">add a new product</p>
   <input type="text" name="p_name" placeholder="Product Name" class = "box" required>
   <input type="text" name="p_price" min="0" placeholder="Product Price" class = "box" required>
   <input type="text" name="p_stock" min="0" placeholder="Product Stocks" class = "box" required>
   <textarea name="p_description" min="0" placeholder="Description about the product" class = "box" required></textarea>
            <h5>&nbsp;&nbsp;description of the product</h5>
            <select name="description" class = "box">
               <option name = "best-seller" value="best-seller">Best Seller</option>
               <option name = "special" value="special">Today's Special</option>
               <option name = "cookie-brownie" value="cookie-brownie">Cookies & Brownie</option>
               <option name = "donuts-muffin" value="donuts-muffin">Donuts & Muffins</option>
               <option name = "box-specials" value="box-specials">Box Specials</option>
            </select>   
        
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class = "box" required>
   <input type="submit" value="add product" name="add_product" class="btn">
</form>

</section>
</div>


<?php
include('footer.php');
?>
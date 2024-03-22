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
<div class="container" style="background-color: #ECFFDC;">


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
          $current_transaction_id = null;
          $grand_total = 0.00;


          if (mysqli_num_rows($select_order) > 0) {
              while ($fetch_order = mysqli_fetch_assoc($select_order)) {
                  // Initialize total for each product
                  $total = $fetch_order['price'] * $fetch_order['quantity'];


                  if ($current_transaction_id !== $fetch_order['transaction_id']) {
                      // Display the grand total and receipt for the previous transaction
                      if ($current_transaction_id !== null) {
                          echo "
                          <tr class='table-bottom'>
                              <td></td>
                              <td colspan='3'>grand total</td>
                              <td>P" . number_format($grand_total, 2, '.', ',') . "</td>
                              <td></td>
                              <td><a href='#' class='button'>Receipt</a></td>


                          </tr>";
                      }


                      // Update the current transaction ID and reset the grand total
                      $current_transaction_id = $fetch_order['transaction_id'];
                      $grand_total = 0.00;
                  }


                  // Display order details for each product in the transaction
                  echo "
                  <tr>
                      <td><img src='prod/" . $fetch_order['image'] . "' height='100' alt=''></td>
                      <td>" . $fetch_order['product_name'] . "</td>
                      <td>P" . number_format($fetch_order['price'], 2, '.', ',') . "</td>
                      <td>" . $fetch_order['quantity'] . "</td>
                      <td>P" . number_format($total, 2, '.', ',') . "</td>
                      <td>" . $fetch_order['order_status'] . "</td>
                      <td>" . $fetch_order['payment_status'] . "</td>
                
                  </tr>";


                  // Add the total for the current product to the grand total
                  $grand_total += $total;
              }


              // Display the grand total and receipt for the last transaction
              echo "
              <tr class='table-bottom'>
                  <td></td>
                  <td colspan='3'>grand total</td>
                  <td>P" . number_format($grand_total, 2, '.', ',') . "</td>
                  <td></td>
                  <td><a href='#' class='button'>Receipt</a></td>


              </tr>";
          }
          ?>


      </tbody>


  </table>


</section>
</div>


<div id="myModal" class="modal">
  <div class="modal-content">
      <span class="close">&times;</span>
      <h2 class="name">JL's SPACE</h2>




      <p class="greeting"> Thank you for your order! </p>




      <?php
      // Assuming you have fetched the order information from the database
      if ($current_transaction_id !== null) {
          // Fetching order information
          $select_receipt_info = mysqli_query($con, "SELECT * FROM `orders` WHERE transaction_id = '$current_transaction_id' LIMIT 1");
          $fetch_receipt_info = mysqli_fetch_assoc($select_receipt_info);




          $transactionId = $fetch_receipt_info['transaction_id'];
          $orderDate = $fetch_receipt_info['date'];




          // Fetching customer information including address1
          $customer_id = $fetch_receipt_info['customer_id'];
          $select_customer_info = mysqli_query($con, "SELECT * FROM `customers` WHERE customer_id = '$customer_id' LIMIT 1");
          $fetch_customer_info = mysqli_fetch_assoc($select_customer_info);




          $shippingAddress = $fetch_customer_info['address1'];




          // Compare order date with current date
          $isPreviousTransaction = strtotime($orderDate) < strtotime(date('Y-m-d'));




          // Fetch payment method from customers table
          $select_payment_method = mysqli_query($con, "SELECT payment_method FROM `customers` WHERE customer_id = '$customer_id'");
          $fetch_payment_method = mysqli_fetch_assoc($select_payment_method);
          $paymentMethod = $fetch_payment_method['payment_method'];




          // Fetch total price for the current transaction
          $select_total_price = mysqli_query($con, "SELECT SUM(price * quantity) AS grand_total FROM `orders` WHERE transaction_id = '$current_transaction_id'");
          $fetch_total_price = mysqli_fetch_assoc($select_total_price);
          $grandTotal = $fetch_total_price['grand_total'];
          ?>




          <!-- Order info -->
          <div class="order">
              <p> Transaction ID : <?php echo $transactionId; ?> </p>
              <p> Date : <?php echo $orderDate; ?> </p>
              <p> Shipping Address : <?php echo $shippingAddress; ?> </p>
          </div>




          <hr>




          <!-- Details -->
          <div class="details">
              <!-- Order Details heading -->
              <h3> Details </h3>




              <!-- Order details for each product -->
              <div class="product">
                  <?php
                  $select_products_info = mysqli_query($con, "SELECT * FROM `orders` WHERE transaction_id = '$current_transaction_id'");




                  while ($fetch_product_info = mysqli_fetch_assoc($select_products_info)) {
                      echo "
                      <div class='product-item'>
                          <img src='prod/" . $fetch_product_info['image'] . "' height='100' alt=''>
                          <div class='info'>
                              <h4> " . $fetch_product_info['product_name'] . " </h4>
                              <p> Qty: " . $fetch_product_info['quantity'] . " </p>
                          </div>
                          <p class='price'> P" . number_format($fetch_product_info['price'], 2, '.', ',') . " </p>
                      </div>";
                  }
                  ?>
              </div>
          </div>




          <!-- total price -->
          <div class="totalprice">
              <hr>
              <!-- Display payment method and total price -->
              <p class='pmethod'> Payment Method: <?php echo $paymentMethod; ?> </p>
              <p class='tot'> Total: P<?php echo number_format($grandTotal, 2, '.', ','); ?> </span> </p>




             
            
          </div>




      <?php } ?>




      <!-- Footer -->
      <footer> Lorem ipsum dolor sit amet consectetur adipisicing. </footer>
  </div>
</div>


<style>
/* Add this to your existing CSS or in a separate style tag */
.modal {
display: none;
position: fixed;
z-index: 1;
left: 0;
top: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgb(0, 0, 0);
background-color: rgba(0, 0, 0, 0.4);
padding-top: 60px;
}


.modal-content {
width: 360px;
height: 720px;
background-color: white;
border-radius: 30px;
position: relative;
top: 50%;
left: 50%;
margin-top: -360px; /* -half height and width to center */
margin-left: -180px;
box-shadow: 14px 14px 22px -18px;
padding: 20px
}


.close {
color: #aaa;
float: right;
font-size: 28px;
font-weight: bold;
}


.close:hover,
.close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}


/*receipt*/
/* Heading */
.name {
text-transform: uppercase;
text-align: center;
color: #6c8b8e;
letter-spacing: 10px;
font-size: 1.8em;
margin-top: 10px
}


/* Big thank */
.greeting {
font-size: 21px;
text-transform: capitalize;
text-align: center;
color: #6f8d90;
margin: 35px 0;
letter-spacing: 1.2px
}


/* Order info */
.order p {
font-size: 13px;
color: #aaa;
padding-left: 10px;
letter-spacing: .7px
}


/* Our line */
hr {
border: .7px solid #ddd;
margin: 15px 0;
}


/* Order details */
.details {
padding-left: 10px;
margin-bottom: 35px;
overflow: hidden
}


.details h3 {
font-weight: 400;
color: #6c8b8e;
font-size: 1.5em;
margin-bottom: 15px
}


/* Image and the info of the order */
.product {
float: left;
width: 83%
}


.product img {
width: 65px;
float: left
}


.product .info {
float: left;
margin-left: 15px
}


.product .info h4 {
color: #6f8d90;
font-weight: 400;
text-transform: uppercase;
margin-top: -10px
}


.product .info p {
font-size: 12px;
color: #aaa;
}


/* Net price */
.details > p {
color: #6f8d90;
margin-top: 25px;
font-size: 15px
}


/* Total price */
.totalprice p {
padding-left: 10px
}


.totalprice .sub,
.totalprice .del {
font-size: 13px;
color: #aaa
}


.totalprice span {
float: right;
margin-right: 17px
}


.totalprice .tot {
color: #6f8d90;
font-size: 15px
margin-top: 5px;
margin-left: 200px;
}


.totalprice .pmethod {
font-size: 13px;
color: #aaa;
}


/* Footer */
footer {
font-size: 10px;
text-align: center;
margin-top: 135px; /* You can make it with position try it */
color: #aaa
}


/* Add this to your existing CSS or in a separate style tag */
.product-item {
 display: flex;
 justify-content: space-between;
 margin-bottom: 10px;
 align-items: center;
 color: #6f8d90;
}


.product-item .info {
 flex-grow: 1;
}


.product-item .price {
 margin-bottom: 50px;
 margin-left: 20px; /* Adjust the margin as needed */
}


</style>


<script>
// Add this script in your existing script tag or in a separate script tag
document.addEventListener('DOMContentLoaded', function () {
var modal = document.getElementById('myModal');
var buttons = document.querySelectorAll('.button');
var span = document.getElementsByClassName('close')[0];


buttons.forEach(function (button) {
 button.onclick = function () {
   modal.style.display = 'block';
 }
});


span.onclick = function () {
 modal.style.display = 'none';
}


window.onclick = function (event) {
 if (event.target == modal) {
   modal.style.display = 'none';
 }
}
});
</script>


<br><br><br><br>


<?php
include "footer.php";
?>

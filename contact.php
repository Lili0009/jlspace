<?php 
	include "header.php";
?>
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
        <li><a href="index_admin.php">Dashboard</a></li>
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Quezon City</div>
          <div class="text-two">Philippines</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+639 9999 11110</div>
          <div class="text-two">+639 1430 2220</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">jlscape@gmail.com</div>
          <div class="text-two">mainjlsp@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Connect with us</div>
        <p>We Would Love To Answer All Of Your Queries Regarding Orders For Birthday, Parties and Reservation. Our Team Are Here To Help</p>
      <form action="#">
        <div class="input-box">
          <input type="text" placeholder="Enter Your Name">
        </div>
        <div class="input-box">
          <input type="text" placeholder="Enter Your Email">
        </div>
        <div class="input-box message-box">
        <input type="text" placeholder="Enter Your Message">
         
 
        </div>
        <div class="button">
          <input type="button" value="Send Now" >
        </div>
      </form>
    </div>
    </div>
  </div>
  <?php
include "footer.php";
?>
</body>
</html>
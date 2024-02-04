<?php 
	include "header.php";
	include("includes/dbh.inc.php");
	require_once 'data.php';
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
        <li><a class = "active" href="index_admin.php">Dashboard</a></li>
        <li><a href ="admin.php">ADMIN</a></li>
        <li><a href ="pending-orders.php"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-clipboard-check-fill" viewBox="0 0 16 16">
          <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
          <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm6.854 7.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>
          </svg><span class="ordernum"> '.$order_count.'</span></a></li>
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

<?php
	$totalorders = mysqli_query($con, "SELECT * FROM orders where CAST(date AS DATE) = CAST( curdate() AS DATE) AND order_status = 'Confirmed' AND payment_status = 'Unpaid'");
    $totalorderstoday=mysqli_num_rows($totalorders);

	$revenue = mysqli_query($con, "SELECT SUM(price*quantity) AS rev,date,product_name FROM orders WHERE order_status = 'Confirmed' AND payment_status = 'Paid'");
    if(mysqli_num_rows($revenue) > 0){
         while($fetch_product = mysqli_fetch_assoc($revenue)){
	 
	$revenuetotal = number_format($fetch_product['rev'],0);
         }
      }else{
		 $revenuetotal = 0;
	  }


	  $stocks = mysqli_query($con, "SELECT SUM(total_stocks) AS stocks FROM products");
    if(mysqli_num_rows($stocks) > 0){
         while($fetch_stockst = mysqli_fetch_assoc($stocks)){
	 
	$stockstotal = number_format($fetch_stockst['stocks'],0);
         }
      }else{
		 $stockstotal = 0;
	  }


	  $totalcus = mysqli_query($con, "SELECT * FROM customers WHERE cidCustomer != 'admin'");
	  $totalcustomers=mysqli_num_rows($totalcus);


	  $totalpending = mysqli_query($con, "SELECT * FROM orders where order_status='Pending'");
	  $totalpendings=mysqli_num_rows($totalpending);

	  $totalcompleted = mysqli_query($con, "SELECT * FROM orders where CAST(date AS DATE) = CAST( curdate() AS DATE) AND order_status='Confirmed' AND payment_status = 'Paid'");
	  $totalcompleteds=mysqli_num_rows($totalcompleted)
?>




<div id="page-wrapper" class="newwrapper">
<div class="row">
      <div class="col-lg-4 col-md-6" style="margin-right:20px;">
      <div class="panel panel-primary">
		<a href="pending-orders.php" style="color:#000;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3"><i class="fa regular fa-chart-pie fa-5x"></i></div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?php echo $totalpendings; ?></div>
                <div>Pending Order</div>
              </div>
            </div>
          </div>
		</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" style="margin-right:20px;">
      <div class="panel panel-primary">
			<a href="orders.php" style="color:#000;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3"><i class="fa-solid fa-cart-arrow-down fa-5x"></i></div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?php echo $totalorderstoday; ?></div>
                <div>Total Order</div>
				
              </div>
            </div>
          </div>
			</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
      <div class="panel panel-green">
		<a href="complete-orders.php" style="color:#000;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3"><i class="fa solid fa-check fa-5x"></i></div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?php echo $totalcompleteds; ?></div>
                <div>Complete Order</div>
              </div>
            </div>
          </div>
		</a>
        </div>
      </div>

    </div>

<!-- test -->
<div class="row">
      <div class="col-lg-4 col-md-6" style="margin-right:20px;">
      <div class="panel panel-yellow">
		<a href="customers_list.php" style="color:#000;">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3"><i class="fa solid fa-user fa-5x"></i></div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?php echo $totalcustomers; ?></div>
                <div>Total Users</div>
              </div>
            </div>
          </div>
		</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" style="margin-right:20px;">
      <div class="panel panel-yellow">
		<a href="stocks-list.php" style="color:#000;"> 
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3"><i class="fa solid fa-chart-bar fa-5x"></i></div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?php echo $stockstotal; ?></div>
                <div>Stocks</div>
              </div>
            </div>
          </div>
		</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6" style="margin-right:20px;">
      <div class="panel panel-green">
      <a href="revenue.php" style="color:#000;"> 
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-3"><i class="fa solid fa-coins fa-5x"></i></div>
        <div class="col-xs-9 text-right">
          <div class="huge">PHP <?php echo $revenuetotal; ?></div>
          <div>Revenue</div>
        </div>
      </div>
    </div>
</a>
  </div>
</div>
      
    </div>
	<br>
	<div class="row">
	<div style="width:80%;height:20%;text-align:center;margin:auto;">
            <h2 class="page-header" >Product Sales Reports (<?php echo date('Y') ?>) </h2>
            <p style="align:center;"><canvas  id="chartjs_bar"></canvas></p>
        </div> 
	<div style="width:30%;padding:20px 40px;border: 1px solid #4f7942;margin-left: 100px;">
	<h2 class="page-header" >Best Sellers </h2><br>

		<?php
		$select_products = mysqli_query($con, "SELECT SUM(quantity) AS countqt,price,product_name FROM orders GROUP BY product_name ORDER BY quantity DESC  LIMIT 6 ");
        if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
	
	  <p><b><?php echo $fetch_product['product_name']; ?></b><span style="float:right;color:#000;"><?php echo $fetch_product['countqt']; ?></span></p><br>

<?php

         };
      };
      ?>
	</div>
</div>
</div>
<br><br>

<!-- design -->

<style>
.newwrapper{
	width: 100%;
}

.newwrapper .row{
    margin:auto;
	width: 80%;
}

.newwrapper .panel-heading{
	padding:30px;
	box-shadow: 0 0.125rem 0 rgba(10,10,10,.04);
	border-radius: .5rem;
	border:1px solid #4f7942;
	margin: 20px 0px;
}

.newwrapper .panel-headings{
	padding:30px;
	box-shadow: 0 0.125rem 0 rgba(10,10,10,.04);
	border-radius: .5rem;
	border:1px solid #4f7942;
	margin: 20px 0px;
  background: ;
}

.newwrapper .panel-heading:hover{
	background: #b8d8be;
}

.newwrapper .fa-5x {
    font-size: 3em;
}

.newwrapper i{
  color:#4f7942;
  margin-right:20px;
  
}

.col-lg-4 {
    flex: 0 0 auto;
    width: 33.33%;
}

.huge{
	font-size: 2.0rem;
	font-weight: bold;
}

.customer-image {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}

</style>

<script src="js/jquery.js"></script>
  <script src="js/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#e60049","#0bb4ff","#e6d800","#ffa300","#bd7ebe","#ea5545","#f46a9b","#27aeef","#87bc45","#8bd3c7","#1a53ff",
                            ],
                            data:<?php echo json_encode($sales); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: false,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>

	<!-- Top Sellers-->



<?php
include "footer.php";
?>
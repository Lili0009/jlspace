<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "jlspace_db";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$con)
{
    die("failed to connect!");
 }else{
         $sql ="SELECT SUM(orders.price) AS count,month.name as monthname,month.id as monthid,orders.month,orders.date,month.month_year,orders.month_year FROM month LEFT JOIN orders ON month.month_year = orders.month_year GROUP BY month.name ORDER BY month.id;";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['monthname'] ;
            $sales[] = $row['count'];
        }
 
 }
?>
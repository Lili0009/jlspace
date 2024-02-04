<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "jlspace_db";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$con)
{

	die("failed to connect!");
}

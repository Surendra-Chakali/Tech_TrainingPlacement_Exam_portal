<?php
$client_css="admin";
date_default_timezone_set("Asia/Kolkata");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online1";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//ini_set("display_errors","off");
$con=mysqli_connect($servername,$username,$password);
$selectdb=mysqli_select_db($con,$dbname);

?>
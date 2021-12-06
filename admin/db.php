<?php
date_default_timezone_set("Asia/Kolkata");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jntu_online_exam";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//ini_set("display_errors","off");
$con=mysqli_connect($servername,$username,$password);
$selectdb=mysqli_select_db($con,$dbname);

?>
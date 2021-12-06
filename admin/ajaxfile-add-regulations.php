<?php
ob_start();
session_start();
include('db.php');

if(isset($_POST['regulation_name']) && $_POST['regulation_name']!="")
{
$regulation_name=$_POST['regulation_name'];	
$stmt = $conn->prepare("INSERT INTO regulations(regulation_name) VALUES (?)");
$stmt->bind_param("s", $regulation_name);
	if($stmt->execute())
	{
		mysqli_commit($conn);
        echo "<b style='color:green'>Added successfully</b><br/>";		
	} 
	else 
	{
		echo "<b style='color:red'>Regulation already available</b><br/>";
	}
}
else 
{
	echo "<b style='color:red'>Please enter Regulation Name..!!</b><br/>";
}
?>
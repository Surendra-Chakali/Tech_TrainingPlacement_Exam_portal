<?php
ob_start();
session_start();
include('db.php');

if(isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['dept_name']) && $_POST['dept_name']!="")
{
$dept_id=$_POST['dept_id'];
$dept_name=$_POST['dept_name'];	
$stmt = $conn->prepare("INSERT INTO departments(dept_id,dept_name) VALUES (?,?)");
$stmt->bind_param("ss", $dept_id,$dept_name);
	if($stmt->execute())
	{
		mysqli_commit($conn);
        echo "<b style='color:green'>Added successful</b><br/>";		
	} 
	else 
	{
		echo "<b style='color:red'>Department ID already available</b><br/>";
	}
}
else 
{
	echo "<b style='color:red'>Please enter both Department ID and Name..!!</b><br/>";
}
?>
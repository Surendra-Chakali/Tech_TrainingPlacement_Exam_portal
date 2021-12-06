<?php
ob_start();
session_start();
include('db.php');

if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" &&isset($_POST['years']) && $_POST['years']!="" && isset($_POST['subject_name']) && $_POST['subject_name']!="" && isset($_POST['subject_code']) && $_POST['subject_code']!="")
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];	
$years=$_POST['years'];
$sems=$_POST['sems'];
$subject_code=$_POST['subject_code'];
$subject_name=$_POST['subject_name'];	
$stmt = $conn->prepare("INSERT INTO subjects(regulation_ids,dept_ids,years,sems,subject_code,subject_name) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("isiiss", $regulation_id,$dept_id,$years,$sems,$subject_code,$subject_name);
	if($stmt->execute())
	{
		mysqli_commit($conn);
        echo "<b style='color:green'>Added successfully</b><br/>";		
	} 
	else 
	{
		echo "<b style='color:red'>Subject already available</b><br/>";
	}
}
else 
{
	echo "<b style='color:red'>All fields are mandatory</b><br/>";
}
?>
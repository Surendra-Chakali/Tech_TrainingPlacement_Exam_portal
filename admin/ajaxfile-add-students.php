<?php
ob_start();
session_start();
include('db.php');

if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!="" && isset($_POST['sems']) && $_POST['sems']!="" && isset($_POST['enroll_no']) && $_POST['enroll_no']!="" && isset($_POST['student_name']) && $_POST['student_name']!="")
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];
$years=$_POST['years'];
$sems=$_POST['sems'];
$enroll_no=$_POST['enroll_no'];
$student_name=$_POST['student_name'];	
$stmt = $conn->prepare("INSERT INTO students(regulation_ids,dept_ids,years,sems,enroll_no,student_name) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("isiiss", $regulation_id,$dept_id,$years,$sems,$enroll_no,$student_name);
	if($stmt->execute())
	{
		mysqli_commit($conn);
        echo "<b style='color:green'>Added successfully</b><br/>";		
	} 
	else 
	{
		echo "<b style='color:red'>Student already available</b><br/>";
	}
}
else 
{
	echo "<b style='color:red'>All fields are mandatory</b><br/>";
}
?>
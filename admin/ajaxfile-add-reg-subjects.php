<?php
ob_start();
session_start();
include('db.php');

if(isset($_POST['qno']) && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['regulation_id']) && $_POST['regulation_id']!="")
{
foreach($_POST['qno'] as $val)
{	
	
	$dept_id=$_POST['dept_id'];
	$regulation_id=$_POST['regulation_id'];	
	$stmt = $conn->prepare("INSERT INTO actual_subjects(regulation_ids,dept_ids,subject_codes) VALUES (?,?,?)");
	$stmt->bind_param("iss", $regulation_id,$dept_id,$val);
	if($stmt->execute())
	{
		mysqli_commit($conn);        		
	} 
}	
echo "<b style='color:green'>Assigned successfully</b><br/>";
}
else 
{
	echo "<b style='color:red'>All fields are mandatory</b><br/>";
}
?>
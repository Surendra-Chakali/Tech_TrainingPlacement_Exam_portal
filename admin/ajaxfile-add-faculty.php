<?php
ob_start();
session_start();
include('db.php');

if(isset($_POST['dept_id']) && $_POST['dept_id']!="" &&isset($_POST['faculty_name']) && $_POST['faculty_name']!="" && isset($_POST['faculty_email']) && $_POST['faculty_email']!="")
{
$dept_id=$_POST['dept_id'];
$faculty_name=$_POST['faculty_name'];
$faculty_email=$_POST['faculty_email'];
$faculty_pwd=rand(000000,999999);	
$stmt = $conn->prepare("INSERT INTO faculty(dept_ids,faculty_name,faculty_email,faculty_pwd) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $dept_id,$faculty_name,$faculty_email,$faculty_pwd);
	if($stmt->execute())
	{
		mysqli_commit($conn);
						$bdy3='<br><br> Dear '.$faculty_name.', <br><br> An account is created for you for the purpose of exam cell. Your temporary password is: '.$faculty_pwd.'. 
						Please login with this password <a href="http://onlineexam.vyrsoftwares.com/admin/faculty-login.php">  here  </a>.
						<br><br><br> Regards <br><br> Exam Cell In-Charge,<br>MeRITS,<br>Udayagiri<br><br><br>';
						  $from3="examcell@meritstech.com";			  
						  $headers3 = "From: " . strip_tags($from3) . "\r\n";
						  $headers3 .= "Reply-To: ". strip_tags($from3) . "\r\n";
						  $headers3 .= "MIME-Version: 1.0\r\n";
						  $headers3 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						  $subject3='MeRITS,Exam-Cell: Your account is cteated';			  
										  
						  if(mail($faculty_email, $subject3, $bdy3, $headers3))
						  {
							//echo '<p style="color:green">Mesage sent successfully</p>';
							mail("vyrsoftwares@gmail.com", $subject3, $bdy3, $headers3);
						  }		
        echo "<b style='color:green'>Faculty Uploaded Successfully. A temporary password has been semt to his/her email id</b><br/>";		
	} 
	else 
	{
		echo "<b style='color:red'>Faculty Email already available</b><br/>";
	}
}
else 
{
	echo "<b style='color:red'>All fields are mandatory</b><br/>";
}
?>
<?php
ob_start();
session_start();
include('db.php');

if(isset($_FILES["file"]["type"]) && isset($_POST['dept_id']) && $_POST['dept_id']!="")
{
$temporary =$_FILES["file"]["name"];
$original=strtotime('now').$temporary;
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("uploads/subjects/" . $original)) {
echo $original . " <span id='invalid'><b>already exists. Rename and upload again</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "uploads/subjects/".$original; // Target path where file is to be stored
	if(move_uploaded_file($sourcePath,$targetPath))
	{	// Moving Uploaded file
		require_once('Classes/PHPExcel.php'); 
		$objPHPExcel = new PHPExcel();
		$inputFileName = $targetPath;
		/** Identify the type of $inputFileName **/ 
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName); 
		/** Create a new Reader of the type that has been identified **/ 
		$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
		$objReader->setReadDataOnly(true); 
		/** Load $inputFileName to a PHPExcel Object **/ 
		$objPHPExcel = $objReader->load($inputFileName);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$highestRow = $objWorksheet->getHighestRow();// e.g. 10 
		$highestColumn = $objWorksheet->getHighestColumn();// e.g 'F' 
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);// e.g. 5 
		//$b=array();		
		$stmt = $conn->prepare("INSERT INTO faculty(dept_ids,faculty_name,faculty_email,faculty_pwd) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss", $dept_id,$faculty_name,$faculty_email,$faculty_pwd);		
		$dept_id=$_POST['dept_id'];
		$faculty_pwd=rand(000000,999999);
       // $i=0;		
		for ($row = 2; $row <= $highestRow; ++$row) 
		{		               
		       $faculty_name=trim($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()," ");			  
			   $faculty_email=trim($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()," ");			
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
					}
					else 
					{
						//$i++;
						mysqli_rollback($conn);
						//echo "<b style='color:red'>Row-$row already available in database. Please delete them from file..!</b><br/>";						
					   //continue;
					}
		}
		echo "<b style='color:green'>Faculty Uploaded Successfully. A temporary password has been semt to their email ids</b><br/>";
		
	    $stmt->close();	
		$conn->close();	
        unlink($targetPath);		
	}
	else 
	{
		echo "<b style='color:red'>File Uploaded Failed...!!</b><br/>";
	}
}
}

}
else 
{
	echo "<b style='color:red'>Please select file</b><br/>";
}
?>
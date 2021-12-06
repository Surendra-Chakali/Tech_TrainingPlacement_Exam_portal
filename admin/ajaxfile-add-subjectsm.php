<?php
ob_start();
session_start();
include('db.php');

if(isset($_FILES["file"]["type"]) && isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" &&isset($_POST['years']) && $_POST['years']!="")
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
		$stmt = $conn->prepare("INSERT INTO subjects(regulation_ids,dept_ids,years,sems,subject_code,subject_name) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("isiiss", $regulation_id,$dept_id,$years,$sems,$subject_code,$subject_name);
		$regulation_id=$_POST['regulation_id'];
		$dept_id=$_POST['dept_id'];	
		$years=$_POST['years'];
		$sems=$_POST['sems'];
       // $i=0;		
		for ($row = 2; $row <= $highestRow; ++$row) 
		{		               
		       $subject_code=trim($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()," ");			  
			   $subject_name=trim($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()," ");			
			       if($stmt->execute())
					{
						mysqli_commit($conn);						
					}
					else 
					{
						//$i++;
						mysqli_rollback($conn);
						//echo "<b style='color:red'>Row-$row already available in database. Please delete them from file..!</b><br/>";						
					   //continue;
					}
		}
		echo "<b style='color:green'>Subjects Uploaded Successfully...!!</b><br/>";
		
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
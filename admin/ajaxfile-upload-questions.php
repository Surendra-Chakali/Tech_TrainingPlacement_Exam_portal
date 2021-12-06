<?php
ob_start();
session_start();
include('db.php');

if(isset($_FILES["file"]["type"]) && isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!="" && isset($_POST['subject_code']) && $_POST['subject_code']!="")
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];
$years=$_POST['years'];	
$sems=$_POST['sems'];
$mids=$_POST['mids'];
$subject_code=$_POST['subject_code'];
$temporary =$_FILES["file"]["name"];
$original=strtotime('now').$temporary;
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("uploads/questions/" . $original)) {
echo $original . " <span id='invalid'><b>already exists. Rename and upload again</b></span> ";
}
else
{
$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "uploads/questions/".$original; // Target path where file is to be stored
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
			$stmt = $conn->prepare("INSERT INTO questions(years,sems,mids,regulation_ids,dept_ids,subject_codes,q_correct,q_text,q_ans1,q_ans2,q_ans3,q_ans4) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->bind_param("iiiississsss", $years,$sems,$mids,$regulation_id,$dept_id,$subject_code,$q_correct,$q_text,$q_ans1,$q_ans2,$q_ans3,$q_ans4);
		   $i=0;			
			for ($row = 2; $row <= $highestRow; ++$row) 
			{		               
				   $q_text=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
				   $q_ans1=$objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
					$q_ans2=$objWorksheet->getCellByColumnAndRow(2, $row)->getValue();
					$q_ans3=$objWorksheet->getCellByColumnAndRow(3, $row)->getValue();
					$q_ans4=$objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
					$q_correct=$objWorksheet->getCellByColumnAndRow(5, $row)->getValue();				
					   if($stmt->execute())
						{
							mysqli_commit($conn);
                            $i++;							
						}
						else 
						{
							mysqli_error($con);
							//$i++;
							//mysqli_rollback($conn);
							//echo "<b style='color:red'> Row-$row not uploaded. Please fill all columns correctly and upload seperately</b><br/>";						
						   //continue;
						}
						
			}
			$stmt->close();
						
			echo "<b style='color:green'>$i - Questions Uploaded Successfully...!!</b><br/>";
		
	    	
		$conn->close();	
        		
	}
	else 
	{
		echo "<b style='color:red'>File Uploaded Failed...!!</b><br/>";
	}
	unlink($targetPath);
}
}

}
else 
{
	echo "<b style='color:red'>Please check all fields are entered or not..!!</b><br/>";
}
?>
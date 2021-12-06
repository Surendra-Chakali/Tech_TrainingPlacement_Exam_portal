<?php
error_reporting(E_ALL ^ E_WARNING);
ob_start();
session_start();
include('db.php');


if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['subject_code']) && $_POST['subject_code']!="" && isset($_POST['sno']))
{
$regulation_id=$_POST['regulation_id'];	
$dept_id=$_POST['dept_id'];
$years=$_POST['years'];
$sems=$_POST['sems'];
$mids=$_POST['mids'];
$subject_code=$_POST['subject_code'];

if(count($_POST['sno'])>0)
{
$stmt = $conn->prepare("INSERT INTO questions(years,sems,mids,regulation_ids,dept_ids,subject_codes,q_correct,q_text,q_ans1,q_ans2,q_ans3,q_ans4,q_text_image,q_ans1_image,q_ans2_image,q_ans3_image,q_ans4_image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("iiiississssssssss", $years,$sems,$mids,$regulation_id,$dept_id,$subject_code,$q_correct,$q_text,$q_ans1,$q_ans2,$q_ans3,$q_ans4,$q_texti,$q_ans1i,$q_ans2i,$q_ans3i,$q_ans4i);
$x=0;
	foreach($_POST['sno'] as $val)
	{
        $q_text=' ';
        $q_ans1=' ';
        $q_ans2=' ';
        $q_ans3=' ';
        $q_ans4=' ';
        //Remaining
        $q_correct=$_POST['c_'.$val];
		//Image question
		$images=array();
		for($i=0;$i<=4;$i++)
		{		
			$temporary =$_FILES["q".$i."i_".$val]["name"];
			$original="";
			if($temporary!="")
			{
				 $original=strtotime('now').$temporary;
				 $sourcePath = $_FILES["q".$i."i_".$val]['tmp_name']; // Storing source path of the file in a variable
				 $targetPath = "uploads/images/".$original; // Target path where file is to be stored
				 if(move_uploaded_file($sourcePath,$targetPath))
				 {
					
				 }
				 else 
				 {
					$original="";  
				 }
            }
            if(strlen($original)>2)
            {
                array_push($images,$original);
            }
			
		} 
        if(count($images)==5)
        {
            //Images
            $q_texti=$images[0];
            $q_ans1i=$images[1];
            $q_ans2i=$images[2];
            $q_ans3i=$images[3];
            $q_ans4i=$images[4];
                if($stmt->execute())
                {
                    $x=$x+1;						
                }
                else 
                {
                    
                }
        }
							
	}
		$stmt->close();					    	
		$conn->close();
		if($x>0)
		{
			echo "<b style='color:green'>$x Questions Uploaded Successfully...!!</b><br/>";
		}
		else 
		{
			echo "<b style='color:red'>Please check all fields are entered or not3....!!</b><br/>";
		}        		
}
else 
{
echo "<b style='color:red'>Please check all fields are entered or not2..!!</b><br/>";	
}		
}
else 
{
	echo "<b style='color:red'>Please check all fields are entered or not1..!!</b><br/>";
}
?>
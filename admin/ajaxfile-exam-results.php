<?php
include('db.php');
require('Classes/PHPExcel.php');
if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!=""  && isset($_POST['subject_code']) && $_POST['subject_code']!="")
{	
            $regulation_id=$_POST['regulation_id'];
			$dept_id=$_POST['dept_id'];
			$years=$_POST['years'];
			$sems=$_POST['sems'];
			$mids=$_POST['mids'];
			$subject=$_POST['subject_code'];
			$sql_papers="select * from paper_settings where paper_id=1";
			$res_papers=mysqli_query($con,$sql_papers);
			if($res_papers)
			{
				$cnt_papers=mysqli_num_rows($res_papers);
				if($cnt_papers>0)
				{
					$row_papers=mysqli_fetch_array($res_papers);
					$total_marks=$row_papers['no_of_questions'];
				}				
			}			
			$sql3="select * from exam_results e LEFT JOIN students s ON e.enroll_nos=s.enroll_no where e.regulation_ids=$regulation_id and e.dept_ids='$dept_id' and e.years=$years and s.sems=$sems and e.sems=$sems  and e.subject_code='$subject'  and e.mids='$mids'  ORDER BY s.enroll_no ASC";
			$res3=mysqli_query($con,$sql3);
			if($res3)
			{
				$cnt3=mysqli_num_rows($res3);
				if($cnt3>0)
				{	
                    $objPHPExcel = new PHPExcel;
					$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
					$objSheet = $objPHPExcel->getActiveSheet();
					$objSheet->setTitle('Batches');
					$objSheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(12);
					$objSheet->getCell('A1')->setValue('S.NO');
					$objSheet->getCell('B1')->setValue('Roll Number');
					$objSheet->getCell('C1')->setValue('Student Name');
					$objSheet->getCell('D1')->setValue('Obtained Marks');
                    $line=2;	
                    $i=1;					
					while($row3=mysqli_fetch_array($res3))
					{						
						    $objSheet->getCell('A'.$line)->setValue($i);
							$objSheet->getCell('B'.$line)->setValue($row3['enroll_nos']);
							$objSheet->getCell('C'.$line)->setValue($row3['student_name']);
							 if($row3['correct_qids']=="")
							 {
								 $tmrks=0;
							 }
							 else 
							 {
								$tmrks=count(explode(",",$row3['correct_qids'])); 
							 }
							$objSheet->getCell('D'.$line)->setValue(($tmrks/2));
							$line++;
							$i++;
					}	
			        $objSheet->getColumnDimension('A')->setAutoSize(true);
					$objSheet->getColumnDimension('B')->setAutoSize(true);
					$objSheet->getColumnDimension('C')->setAutoSize(true);
					$objSheet->getColumnDimension('D')->setAutoSize(true);						
                    $file_name="Report-".$dept_id."-".$years."-".$sems.".xlsx";
					$objWriter->save("uploads/results/".$file_name);		
					 echo '<a class="btn btn-success" href="uploads/results/'.$file_name.'">Download Report(Excel)</a>';											
				}
				else 
				{
					echo '<b style="color:red">Can not generate report. Please chech online exam conducted or not</b>';
				}
			}
			else 
			{
				//echo "wrong";
			}



}
else 
{
//	echo 'hi';
}

?>
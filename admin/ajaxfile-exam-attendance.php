<?php
ob_start();
session_start();
include('db.php');
require('Classes/PHPExcel.php');

if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!="" && isset($_POST['no_of_qns']) && $_POST['no_of_qns']!="" && isset($_POST['subject_code']) && $_POST['subject_code']!="")
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
					$objSheet->getCell('D1')->setValue('Status');	
            $regulation_id=$_POST['regulation_id'];
			$dept_id=$_POST['dept_id'];
			$years=$_POST['years'];
			$sems=$_POST['sems'];
			$no_of_qns=$_POST['no_of_qns'];
			$subject=$_POST['subject_code'];
			$total_marks=60;
			if($no_of_qns==1)
			{
$sql3="select * from students where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and enroll_no NOT IN(select enroll_nos from exam_results where subject_code='$subject')";
			$status="Absent";				
			}
			else if($no_of_qns==2) 
			{
 $sql3="select * from exam_results e LEFT JOIN students s ON e.enroll_nos=s.enroll_no where e.regulation_ids=$regulation_id and e.dept_ids='$dept_id' and e.years=$years and e.sems=$sems and  e.subject_code='$subject'";
			$status="Present";
			}
			$res3=mysqli_query($con,$sql3);
			if($res3)
			{
				$cnt3=mysqli_num_rows($res3);
				if($cnt3>0)
				{	

                    $line=2;	
                    $i=1;					
					while($row3=mysqli_fetch_array($res3))
					{						
						    $objSheet->getCell('A'.$line)->setValue($i);
							$objSheet->getCell('B'.$line)->setValue($row3['enroll_nos']);
							$objSheet->getCell('C'.$line)->setValue($row3['student_name']);
							$objSheet->getCell('D'.$line)->setValue($status);
							$line++;
							$i++;
					}	
			        $objSheet->getColumnDimension('A')->setAutoSize(true);
					$objSheet->getColumnDimension('B')->setAutoSize(true);
					$objSheet->getColumnDimension('C')->setAutoSize(true);
					$objSheet->getColumnDimension('D')->setAutoSize(true);					
                    $file_name="Report-".$dept_id."-".$years."-".$sems."-".$status.".xlsx";
					$objWriter->save("uploads/results/".$file_name);		
					 echo '<a class="btn btn-success" href="uploads/results/'.$file_name.'">Download Report(Excel)</a>';											
				}
				else 
				{
					echo '<b style="color:red">Can not generate report.  No student found</b>';
				}
			}
			else 
			{
				
			}



}
else 
{
	//echo 'hghgjjf';
}

?>
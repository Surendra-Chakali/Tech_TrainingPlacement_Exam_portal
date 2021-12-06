<?php
ob_start();
session_start();
include('db.php');
require('Classes/PHPExcel.php');
if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!="")
{
                    $objPHPExcel = new PHPExcel;
					$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
					$objSheet = $objPHPExcel->getActiveSheet();
					$objSheet->setTitle('Batches');
					$objSheet->getStyle('A1:H1')->getFont()->setBold(true)->setSize(12);
					$objSheet->getCell('A1')->setValue('S.NO');
					$objSheet->getCell('B1')->setValue('Question ID');
					$objSheet->getCell('C1')->setValue('Question');
					$objSheet->getCell('D1')->setValue('Answer-1');
					$objSheet->getCell('E1')->setValue('Answer-2');
					$objSheet->getCell('F1')->setValue('Answer-3');
					$objSheet->getCell('G1')->setValue('Answer-4');
					$objSheet->getCell('H1')->setValue('Correct Answer');					
            $regulation_id=$_POST['regulation_id'];
			$dept_id=$_POST['dept_id'];
			$years=$_POST['years'];
			$sems=$_POST['sems'];
			$subject_code=$_POST['subject_code'];
			$total_marks=60;
			if($subject_code=="")
			{
$sql3="select * from questions where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems";
			$status="All Subjects";				
			}
			else
			{
$sql3="select * from questions where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and subject_codes='$subject_code'";
			$status=$subject_code;
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
							$objSheet->getCell('B'.$line)->setValue($row3['q_id']);
							$objSheet->getCell('C'.$line)->setValue($row3['q_text']);
							$objSheet->getCell('D'.$line)->setValue($row3['q_ans1']);
							$objSheet->getCell('E'.$line)->setValue($row3['q_ans2']);
							$objSheet->getCell('F'.$line)->setValue($row3['q_ans3']);
							$objSheet->getCell('G'.$line)->setValue($row3['q_ans4']);
							$objSheet->getCell('H'.$line)->setValue($row3['q_correct']);
							$line++;
							$i++;
					}	
			        $objSheet->getColumnDimension('A')->setAutoSize(true);
					$objSheet->getColumnDimension('B')->setAutoSize(true);
					$objSheet->getColumnDimension('C')->setAutoSize(true);
					$objSheet->getColumnDimension('D')->setAutoSize(true);
					$objSheet->getColumnDimension('E')->setAutoSize(true);
					$objSheet->getColumnDimension('F')->setAutoSize(true);
					$objSheet->getColumnDimension('G')->setAutoSize(true);
					$objSheet->getColumnDimension('H')->setAutoSize(true);					
                    $file_name="Report-".$dept_id."-".$years."-".$sems."-".$status.".xlsx";
					$objWriter->save("uploads/results/".$file_name);		
					 echo '<a class="btn btn-success" href="uploads/results/'.$file_name.'">Download Report(Excel)</a>';											
				}
				else 
				{
					echo '<b style="color:red">Can not generate report.  No questions found</b>';
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
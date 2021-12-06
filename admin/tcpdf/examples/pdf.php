<?php
ob_start();
session_start();
include("db.php");
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 049', PDF_HEADER_STRING);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// set font
$pdf->SetFont('helvetica', '', 10);
// add a page
$pdf->AddPage();
//if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!="")
//{	
            $regulation_id=2;
			$dept_id="05";
			$years=3;
			$sems=1;
			if($years==1)
			{
				$yearst='I';
			}
			if($years==2)
			{
				$yearst='II';
			}
			if($years==3)
			{
				$yearst='III';
			}
			if($years==4)
			{
				$yearst='IV';
			}
			if($sems==1)
			{
				$semst='I';
			}
			if($sems==2)
			{
				$semst='II';
			}
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
			$sql3="select * from exam_results e LEFT JOIN students s ON e.enroll_nos=s.enroll_no LEFT JOIN departments d ON e.dept_ids=d.dept_id LEFT JOIN regulations r ON e.regulation_ids=r.regulation_id where e.regulation_ids=$regulation_id and e.dept_ids='$dept_id' and e.years=$years and e.sems=$sems";
			$res3=mysqli_query($con,$sql3);
			$res4=mysqli_query($con,$sql3);
			if($res3)
			{
				$cnt3=mysqli_num_rows($res3);
				if($cnt3>0)
				{		
			$row4=mysqli_fetch_array($res4);
			$html = '
				<table>
				<tr>
				<td width="10%"><img src="../../images/logo.png" /></td><td width="90%"><h3 style="text-align:center;">MEKAPATI RAJAMOHAN REDDY INSTITUTE OF TECHNOLOGY & SCIENCE <br>
				UDAYAGIRI, SPSR NELLORE DT- 524226.
				</h3> <br><br></td>
				</tr>
				<tr><td colspan="2" align="center">'.$yearst.' B.Tech '.$semst.'-Sem Online Examination – November -2015 <br><br></td></tr>
				<tr><td width="70%">Regulation  : '.$row4['regulation_name'].'</td><td>College Code:L4</td></tr>
				<tr><td colspan="2"><br><br>Department : '.$row4['dept_name'].'   <br><br></td></tr>

				</table>

				';
			$html.='<table border="1" cellpadding="5" cellspacing="0"><tr><th width="7%"><b>S.NO</b></th>
			<th width="18%"><b>Hallticket NO.</b></th><th width="52%"><b>Name of the Student</b></th><th width="23%"><b>No.Of marks obtained</b></th></tr>';
                    $i=1;					
					while($row3=mysqli_fetch_array($res3))
					{
							 if($row3['correct_qids']=="")
							 {
								 $tmrks=0;
							 }
							 else 
							 {
								$tmrks=count(explode(",",$row3['correct_qids'])); 
							 }
							 $html.='<tr><td width="7%">'.$i.'</td><td width="18%">'.$row3['enroll_nos'].'</td>
							 <td width="52%">'.$row3['student_name'].'</td><td width="23%">'.$tmrks.'</td></tr>';
							$i++;
					}
                       $html.='</table>';	
$pdf->writeHTML($html, true, 0, true, 0);					   
								
                  //  $file_name="Report-".$dept_id."-".$years."-".$sems.".xlsx";
					//$objWriter->save("uploads/results/".$file_name);		
					// echo '<a class="btn btn-success" href="uploads/results/'.$file_name.'">Download Report(Excel)</a>';											
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

//}
// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_049.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

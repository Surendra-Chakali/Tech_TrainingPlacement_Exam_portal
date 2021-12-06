<?php
ob_start();
session_start();
include("db.php");
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 049');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 049', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

IMPORTANT:
If you are printing user-generated content, tcpdf tag can be unsafe.
You can disable this tag by setting to false the K_TCPDF_CALLS_IN_HTML
constant on TCPDF configuration file.

For security reasons, the parameters for the 'params' attribute of TCPDF
tag must be prepared as an array and encoded with the
serializeTCPDFtagParameters() method (see the example below).

 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
if(isset($_GET['regulation_id']) && $_GET['regulation_id']!=""&& isset($_GET['dept_id']) && $_GET['dept_id']!="" && isset($_GET['years']) && $_GET['years']!="" && isset($_GET['subject']) && $_GET['subject']!="")
{	
            $regulation_id=$_GET['regulation_id'];
			
			$dept_id=$_GET['dept_id'];
			$years=$_GET['years'];
			$sems=$_GET['sems'];
			$subject=$_GET['subject'];
			$mids=$_GET['mids'];
			$subjectName='';
			$sql_subjects="select subject_name from subjects where regulation_ids=".$regulation_id." and dept_ids='".$dept_id."' and subject_code='$subject' and years=".$years." and sems=".$sems;			  
			$res_subjects=mysqli_query($con,$sql_subjects);
			if($res_subjects)
			{
				$cnt_subjects=mysqli_num_rows($res_subjects);
				if($cnt_subjects>0)
				{
					$row1s=mysqli_fetch_array($res_subjects);
					$subjectName=$row1s['subject_name'];
				}
			}
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
			$midName='';
			if($mids==1)
			{
				$midName='I';
			}
			if($mids==2)
			{
				$midName='II';
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
		$sql3="select * from exam_results e RIGHT JOIN students s ON e.enroll_nos=s.enroll_no LEFT JOIN departments d ON e.dept_ids=d.dept_id LEFT JOIN regulations r ON s.regulation_ids=r.regulation_id where e.regulation_ids=$regulation_id and e.dept_ids='$dept_id' and e.years=$years and e.sems=$sems and e.sems=$sems and e.subject_code='$subject' and e.mids='$mids' ORDER BY s.enroll_no ASC";
			$res3=mysqli_query($con,$sql3);
			$res4=mysqli_query($con,$sql3);
			if($res3)
			{
				$cnt3=mysqli_num_rows($res3);
				if($cnt3>0)
				{		
			$row4=mysqli_fetch_array($res4);
			/**'.$yearst.' B.Tech '.$semst.'-Sem Online Examination – May -2016 */
			$html = '
				<table>
				<tr>
				<td width="10%"><img src="images/logo.png" /></td><td width="90%"><h3 style="text-align:center;">TECH GROUP OF EDUCATIONAL INSTITUTIONS<br>TADIPATRI ENGINEERING COLLGEGE  <br>VEERAPURAM,TADIPATRI, ATP -515411
				</h3> <br><br></td>
				</tr>
				<tr><td colspan="2" align="center">I B.TECH I SEM  R-20  '.$midName.' - MID - ONLINE EXAMS - MARCH -2020 <br><br></td></tr>
				<tr><td width="50%">Regulation  : '.$row4['regulation_name'].'</td><td>College Code:HU</td></tr>
				<tr><td width="50%"><br><br>Department : '.$row4['dept_name'].'   <br><br></td><td> <br><br>Subject Code:'.$subjectName.' <br><br></td></tr>

				</table>

				';
			$html.='<table border="1" cellpadding="5" cellspacing="0"><tr><th width="7%"><b>S.NO</b></th>
			<th width="18%"><b>Hallticket NO.</b></th><th width="52%"><b>Name of the Student</b></th>
			<th width="23%"><b>No.Of marks obtained</b></th></tr>';
                    $i=1;					
					while($row3=mysqli_fetch_array($res3))
					{
							if($row3['enroll_nos']!="")
							{
							 if($row3['correct_qids']=="")
							 {
								 $tmrks=0;
							 }
							 else 
							 {
								$tmrks=count(explode(",",$row3['correct_qids'])); 
							 }
							 if($tmrks>=24)
							 {
								$status="Pass"; 
							 }
							 else 
							 {
								$status="Fail";  
							 }
							}
							else 
							{
								$tmrks="Absent";
								$status=""; 
							}
							 $html.='<tr><td width="7%">'.$i.'</td><td width="18%">'.$row3['enroll_no'].'</td>
							 <td width="52%">'.$row3['student_name'].'</td><td width="23%">'.($tmrks/2).'</td>
							 </tr>';
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

}


$params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
//$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';

$params = $pdf->serializeTCPDFtagParameters(array('CODE 128', 'C128', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
//$html .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';

/*$html .= '<tcpdf method="AddPage" /><h2>Graphic Functions</h2>';

$params = $pdf->serializeTCPDFtagParameters(array(0));
$html .= '<tcpdf method="SetDrawColor" params="'.$params.'" />';

$params = $pdf->serializeTCPDFtagParameters(array(50, 50, 40, 10, 'DF', array(), array(0,128,255)));
$html .= '<tcpdf method="Rect" params="'.$params.'" />';
*/

// output the HTML content


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_049.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

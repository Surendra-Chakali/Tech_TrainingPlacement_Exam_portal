<?php
ob_start();
session_start();
include('db.php');
if(isset($_POST['regulation_id']) && isset($_POST['dept_id']) && isset($_POST['years']) && $_POST['regulation_id']!="" && $_POST['dept_id']!="" && $_POST['years']!="")
{
	$regulation_id=$_POST['regulation_id'];
	$dept_id=$_POST['dept_id'];
	$years=$_POST['years'];
	$sems=$_POST['sems'];
	$sql="select * from subjects  where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and subject_active!=2 order by subject_name";
	$res=mysqli_query($con,$sql);
	echo '<option value="">Select Subject</option>';
	if($res)
	{
			$cnt=mysqli_num_rows($res);			
			if($cnt>0)
			{							
				while($row=mysqli_fetch_array($res))
					{	
						echo '<option value="'.$row['subject_code'].'">'.$row['subject_name'].'</option>';
					}
			}
	}

}

?>
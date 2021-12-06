<?php
ob_start();
session_start();
include('db.php');
$sql1="select * from paper_settings where paper_id=1";

if(isset($_GET['scode']))
{
	$councode=$_GET['scode'];
	$sts=$_GET['sts'];
	$couid=$_GET['couid'];
  $duration=$_GET['duration'];
  $subject=$_GET['subject'];
  $mids=$_GET['mids'];
  
	 $sql="update paper_settings set duration='$duration',no_of_questions=$councode,per_subject=$sts,today_subject='$subject',today_mid=$mids where paper_id=$couid";
	mysqli_query($con,$sql);
	getSectors($sql1);
}

if(isset($_GET['cancels']))
{
	getSectors($sql1);
}
function getSectors($sql)
{
include('db.php');
?>
 <table id="example1" class="table table-bordered table-striped">
                    <thead>
					  <tr>
					 
						 <th>Total No.of Questions</th>
						 <th>No.of Questions per subject</th>
             <th>Exam Duration(HH:MM:SS)</th>						 
             <th>Current Subject</th>						 
             <th>Current MID</th>						 
						 <th></th>
						 <th></th>
                      </tr>
                    </thead>
                    <tbody>
 <?php  
$res1=mysqli_query($con,$sql);
$cnt1=mysqli_num_rows($res1);
if($cnt1>0)
{
while($row1=mysqli_fetch_array($res1))
{	
?>
<tr>
  <td><p style="display:block" id="cout-<?php echo $row1['paper_id'];  ?>"><?php echo $row1['no_of_questions'];  ?></p>
  <input style="display:none" type="text" name="cou-<?php echo $row1['paper_id'];  ?>" id="cou-<?php echo $row1['paper_id'];  ?>" value="<?php echo $row1['no_of_questions'];  ?>" class="form-control">
  </td>
  <td><p style="display:block" id="coutn-<?php echo $row1['paper_id'];  ?>"><?php echo $row1['per_subject'];  ?></p>
  <input style="display:none" type="text" name="coun-<?php echo $row1['paper_id'];  ?>" id="coun-<?php echo $row1['paper_id'];  ?>" value="<?php echo $row1['per_subject'];  ?>" class="form-control">
  </td>
    <td><p style="display:block" id="coutnn-<?php echo $row1['paper_id'];  ?>"><?php echo $row1['duration'];  ?></p>
  <input style="display:none" type="text" name="counn-<?php echo $row1['paper_id'];  ?>" id="counn-<?php echo $row1['paper_id'];  ?>" value="<?php echo $row1['duration'];  ?>" class="form-control">
  </td>

  <td><p style="display:block" id="coutnnn-<?php echo $row1['paper_id'];  ?>"><?php echo $row1['today_subject'];  ?></p>
  <input style="display:none" type="text" name="counnn-<?php echo $row1['paper_id'];  ?>" id="counnn-<?php echo $row1['paper_id'];  ?>" value="<?php echo $row1['today_subject'];  ?>" class="form-control">
  </td>
  <td><p style="display:block" id="coutmid-<?php echo $row1['paper_id'];  ?>"><?php echo $row1['today_mid'];  ?></p>
  <input style="display:none" type="text" name="coumid-<?php echo $row1['paper_id'];  ?>" id="coumid-<?php echo $row1['paper_id'];  ?>" value="<?php echo $row1['today_mid'];  ?>" class="form-control">
  </td>
 <td align="right">
 <button type="button" style="display:block" name="modify-<?php echo $row1['paper_id'];  ?>" id="modify-<?php echo $row1['paper_id'];  ?>" onclick="modify(this.id)" class="btn btn-success btn-sm">Modify</button>
 <button type="button" style="display:none;" name="save-<?php echo $row1['paper_id'];  ?>" id="save-<?php echo $row1['paper_id'];  ?>" onclick="save(this.id)" class="btn btn-success btn-sm">Save</button>
</td>
<td>
<button type="button" style="display:none;" name="cancel-<?php echo $row1['paper_id'];  ?>" id="cancel-<?php echo $row1['paper_id'];  ?>" onclick="cancel(this.id)" class="btn btn-danger btn-sm">Cancel</button> 
</td>
</tr>
<?php 
}
}
?>
                    
                 
                 
                    </tbody>
               
                  </table>         
<?php 	
}

?>
<?php
ob_start();
session_start();
include('db.php');
if(isset($_POST['regulation_id']) && $_POST['regulation_id']!="" && isset($_POST['dept_id']) && $_POST['dept_id']!="" && isset($_POST['years']) && $_POST['years']!="")
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];
$years=$_POST['years'];
$sems=$_POST['sems'];	
$sql1="select * from students where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and student_active!=2 or years=0 order by enroll_no";
getSectors($sql1);
}
if(isset($_POST['change']) && isset($_POST['qno']) )
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];
$years=$_POST['years'];
$sems=$_POST['sems'];	

if(count($_POST['qno'])>0)
{
foreach($_POST['qno'] as $val)
{
$sql2="update students set regulation_ids=$regulation_id,dept_ids='$dept_id',years=$years,sems=$sems where enroll_no='$val'";
mysqli_query($con,$sql2);
}
}
$sql1="select * from students where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and student_active!=2 or years=0 order by enroll_no";
getSectors($sql1);
}
if(isset($_GET['counm']))
{
	
	$counm=$_GET['counm'];
	$councode=$_GET['scode'];
	$sts=$_GET['sts'];
	$couid=$_GET['couid'];
	$sql="update subjects set subject_code='$councode',subject_name='$counm',subject_active=$sts where subject_code='$couid'";
	mysqli_query($con,$sql);
	getSectors($sql1);
}
if(isset($_GET['delcouid']))
{
	$couid=$_GET['delcouid'];
	$sql="delete from students where enroll_no='$couid'";
	mysqli_query($con,$sql);
	//getSectors($sql1);
	echo '<b style="color:green">Delete successful press view button.If it is not deleted,results are available for that student</b>';
}

function getSectors($sql)
{
include('db.php');
?>
 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  <th> <input type="checkbox" value="Check All" onClick="this.value=check(this.form.list)"> </th>                        
						<th>Roll Number</th>
						 <th>Student Name</th>
						  <th>Father/Mother Name</th>
						  <th>Status</th>
						 <th></th>
						 <th></th>
                      </tr>
                    </thead>
                    <tbody>
 <?php  
$res1=mysqli_query($con,$sql);
if($res1)
{
$cnt1=mysqli_num_rows($res1);
if($cnt1>0)
{
while($row1=mysqli_fetch_array($res1))
{	
?>
<tr>
<td><input type="checkbox" name="qno[]" id="list" value="<?php echo $row1['enroll_no'];  ?>"/></td>
  <td><p style="display:block" id="cout-<?php echo $row1['enroll_no'];  ?>"><?php echo $row1['enroll_no'];  ?></p>
  <input style="display:none" type="text" name="cou-<?php echo $row1['enroll_no'];  ?>" id="cou-<?php echo $row1['enroll_no'];  ?>" value="<?php echo $row1['enroll_no'];  ?>" class="form-control">
  </td>
    <td><p style="display:block" id="coutn-<?php echo $row1['enroll_no'];  ?>"><?php echo $row1['student_name'];  ?></p>
  <input style="display:none" type="text" name="coun-<?php echo $row1['enroll_no'];  ?>" id="coun-<?php echo $row1['enroll_no'];  ?>" value="<?php echo $row1['student_name'];  ?>" class="form-control">
  </td>
     <td><p style="display:block" id="coutnn-<?php echo $row1['enroll_no'];  ?>"><?php echo $row1['father_name'];  ?></p>
  <input style="display:none" type="text" name="counn-<?php echo $row1['enroll_no'];  ?>" id="counn-<?php echo $row1['enroll_no'];  ?>" value="<?php echo $row1['father_name'];  ?>" class="form-control">
  </td> 
  <td>

      <select class="form-control" disabled name="sts-<?php echo $row1['enroll_no'];  ?>" id="sts-<?php echo $row1['enroll_no'];  ?>">
	  <?php 
	  if($row1['student_active']==1)
	  {
		 echo '<option selected value="1">Active</option> 
		       <option value="0">Inactive</option>'; 
	  }
	  else 
	  {
		  echo '<option value="1">Active</option> 
		       <option selected value="0">Inactive</option>'; 
	  }
	  ?>
      </select>
  </td>
 <td align="right">
 <button type="button" style="display:block" name="modify-<?php echo $row1['enroll_no'];  ?>" id="modify-<?php echo $row1['enroll_no'];  ?>" onclick="modify(this.id)" class="btn btn-success btn-sm">Modify</button>
 <button type="button" style="display:none;" name="save-<?php echo $row1['enroll_no'];  ?>" id="save-<?php echo $row1['enroll_no'];  ?>" onclick="save(this.id)" class="btn btn-success btn-sm">Save</button>
</td>
<td>
<button type="button" style="display:none;" name="cancel-<?php echo $row1['enroll_no'];  ?>" id="cancel-<?php echo $row1['enroll_no'];  ?>" onclick="cancel(this.id)" class="btn btn-danger btn-sm">Cancel</button> 
<button type="button" style="display:block;" name="deleted-<?php echo $row1['enroll_no'];  ?>" id="deleted-<?php echo $row1['enroll_no'];  ?>" onclick="deleted(this.id)" class="btn btn-danger btn-sm">Delete</button> 
</td>
</tr>
<?php 
}
}
}
?>
                    
                 
                 
                    </tbody>
               
                  </table>         
<?php 	
}

?>
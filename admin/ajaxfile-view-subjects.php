<?php
ob_start();
session_start();
include('db.php');
//$sql1="select * from subjects where subject_active!=2 order by subject_name";
if(isset($_POST['regulation_id']) )
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];	
$years=$_POST['years'];
$sems=$_POST['sems'];
$sql1="select * from subjects where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and subject_active!=2 order by subject_name";
getSectors($sql1);
}
if(isset($_POST['delall']))
{
$regulation_id=$_POST['regulation_id'];
$dept_id=$_POST['dept_id'];	
$years=$_POST['years'];
$sems=$_POST['sems'];
$sql1="select * from subjects where regulation_ids=$regulation_id and dept_ids='$dept_id' and years=$years and sems=$sems and subject_active!=2 order by subject_name";
	if(isset($_POST['qno']))
	{
		if(count($_POST['qno'])>0)
		{
			$i=1;
			foreach($_POST['qno'] as $val)
			{
				$sql2="delete from subjects where subject_code='$val'";
				if(mysqli_query($con,$sql2))
				{
					
				}
				else 
				{
					$i=0;
					
				}
			}
			if($i==1)
			{
				echo '<b style="color:green">Delete Successful</b>';
			}
			else 
			{
				echo '<b style="color:green">Delete Successful</b><br><br>';
				echo '<b style="color:red">Some subjects are not deleted because they are associted with other related data</b>';
			}
		}
		else 
		{
			echo '<b style="color:red">No rows selected</b>';
		}
	}
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
	$sql="delete from subjects where subject_code='$couid'";
	mysqli_query($con,$sql);
	//getSectors($sql1);
	echo '<b style="color:green">Delete successful press view button. If it is not deleted, first delete questions for thst subject</b>';
}

function getSectors($sql)
{
include('db.php');
?>
 <table id="example1" class="table table-bordered table-striped">
                    <thead>
					  <tr>
					 	<th>Subject Code</th>
						 <th>Subject Name</th>
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
  <td><p style="display:block" id="cout-<?php echo $row1['subject_code'];  ?>"><?php echo $row1['subject_code'];  ?></p>
  <input style="display:none" type="text" name="cou-<?php echo $row1['subject_code'];  ?>" id="cou-<?php echo $row1['subject_code'];  ?>" value="<?php echo $row1['subject_code'];  ?>" class="form-control">
  </td>
    <td><p style="display:block" id="coutn-<?php echo $row1['subject_code'];  ?>"><?php echo $row1['subject_name'];  ?></p>
  <input style="display:none" type="text" name="coun-<?php echo $row1['subject_code'];  ?>" id="coun-<?php echo $row1['subject_code'];  ?>" value="<?php echo $row1['subject_name'];  ?>" class="form-control">
  </td>
  <td>

      <select class="form-control" disabled name="sts-<?php echo $row1['subject_code'];  ?>" id="sts-<?php echo $row1['subject_code'];  ?>">
	  <?php 
	  if($row1['subject_active']==1)
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
 <button type="button" style="display:block" name="modify-<?php echo $row1['subject_code'];  ?>" id="modify-<?php echo $row1['subject_code'];  ?>" onclick="modify(this.id)" class="btn btn-success btn-sm">Modify</button>
 <button type="button" style="display:none;" name="save-<?php echo $row1['subject_code'];  ?>" id="save-<?php echo $row1['subject_code'];  ?>" onclick="save(this.id)" class="btn btn-success btn-sm">Save</button>
</td>
<td>
<button type="button" style="display:none;" name="cancel-<?php echo $row1['subject_code'];  ?>" id="cancel-<?php echo $row1['subject_code'];  ?>" onclick="cancel(this.id)" class="btn btn-danger btn-sm">Cancel</button> 
<button type="button" style="display:block;" name="deleted-<?php echo $row1['subject_code'];  ?>" id="deleted-<?php echo $row1['subject_code'];  ?>" onclick="deleted(this.id)" class="btn btn-danger btn-sm">Delete</button> 
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
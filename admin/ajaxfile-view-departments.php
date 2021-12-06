<?php
ob_start();
session_start();
include('db.php');
$sql1="select * from departments where dept_active!=2 order by dept_name";
if(isset($_POST['delall']))
{
	if(isset($_POST['qno']))
	{
		if(count($_POST['qno'])>0)
		{
			$i=1;
			foreach($_POST['qno'] as $val)
			{
				$sql2="delete from departments where dept_id=$val";
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
				echo '<b style="color:red">Some Departments are not deleted because they are associted with other related data</b>';
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
	$sql="update departments set dept_id='$councode',dept_name='$counm',dept_active=$sts where dept_id='$couid'";
	mysqli_query($con,$sql);
	getSectors($sql1);
}
if(isset($_GET['delcouid']))
{
	$couid=$_GET['delcouid'];
	$sql="update sectors set sector_active=2 where sector_code='$couid'";
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
					<tr> <td colspan="5"><button class="btn btn-success" name="delall" id="delall">Delete All</button></td></tr>
                      <tr>
					  <th> <input type="checkbox" value="Check All" onClick="this.value=check(this.form.list)"> </th>
                         <th>Department ID</th>
						 <th>Department Name</th>
						  <th>Status</th>
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
<td><input type="checkbox" name="qno[]" id="list" value="<?php echo $row1['dept_id'];  ?>"/></td>
  <td><p style="display:block" id="cout-<?php echo $row1['dept_id'];  ?>"><?php echo $row1['dept_id'];  ?></p>
  <input style="display:none" type="text" name="cou-<?php echo $row1['dept_id'];  ?>" id="cou-<?php echo $row1['dept_id'];  ?>" value="<?php echo $row1['dept_id'];  ?>" class="form-control">
  </td>
    <td><p style="display:block" id="coutn-<?php echo $row1['dept_id'];  ?>"><?php echo $row1['dept_name'];  ?></p>
  <input style="display:none" type="text" name="coun-<?php echo $row1['dept_id'];  ?>" id="coun-<?php echo $row1['dept_id'];  ?>" value="<?php echo $row1['dept_name'];  ?>" class="form-control">
  </td>
  <td>

      <select class="form-control" disabled name="sts-<?php echo $row1['dept_id'];  ?>" id="sts-<?php echo $row1['dept_id'];  ?>">
	  <?php 
	  if($row1['dept_active']==1)
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
 <button type="button" style="display:block" name="modify-<?php echo $row1['dept_id'];  ?>" id="modify-<?php echo $row1['dept_id'];  ?>" onclick="modify(this.id)" class="btn btn-success btn-sm">Modify</button>
 <button type="button" style="display:none;" name="save-<?php echo $row1['dept_id'];  ?>" id="save-<?php echo $row1['dept_id'];  ?>" onclick="save(this.id)" class="btn btn-success btn-sm">Save</button>
</td>
<td>
<button type="button" style="display:none;" name="cancel-<?php echo $row1['dept_id'];  ?>" id="cancel-<?php echo $row1['dept_id'];  ?>" onclick="cancel(this.id)" class="btn btn-danger btn-sm">Cancel</button> 
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
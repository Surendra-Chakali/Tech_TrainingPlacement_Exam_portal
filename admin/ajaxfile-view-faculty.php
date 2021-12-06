<?php
ob_start();
session_start();
include('db.php');
//$sql1="select * from subjects where subject_active!=2 order by subject_name";
if(isset($_POST['view']) )
{
$dept_id=$_POST['dept_id'];	
$sql1="select * from faculty where dept_ids='$dept_id' and faculty_active!=2 order by faculty_name";
getSectors($sql1);
}
if(isset($_GET['counm']))
{
	
	$counm=$_GET['counm'];
	$councode=$_GET['scode'];
	$sts=$_GET['sts'];
	$couid=$_GET['couid'];
	$dept_id=$_GET['dept_id'];
	$sql="update faculty set faculty_name='$councode',faculty_email='$counm',faculty_active=$sts where faculty_id=$couid";
	mysqli_query($con,$sql);
	$sql1="select * from faculty where dept_ids='$dept_id' and faculty_active!=2 order by faculty_name";
	getSectors($sql1);
}
if(isset($_GET['delcouid']))
{
	$couid=$_GET['delcouid'];
	$sql="update sectors set sector_active=2 where sector_code='$couid'";
	mysqli_query($con,$sql);
	getSectors($sql1);
}
if(isset($_GET['getback']))
{
	$couid=$_GET['getback'];
	$sql="update sectors set sector_active=0 where sector_code='$couid'";
	mysqli_query($con,$sql);
	getDeletedSectors();
}
if(isset($_GET['getback1']))
{
	getDeletedSectors();
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
					  <th> <input type="checkbox" value="Check All" onClick="this.value=check(this.form.list)"> </th>                        
						<th>Faculty Name</th>
						 <th>Faculty Email</th>
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
<td><input type="checkbox" name="qno[]" id="list" value="<?php echo $row1['faculty_id'];  ?>"/></td>
  <td><p style="display:block" id="cout-<?php echo $row1['faculty_id'];  ?>"><?php echo $row1['faculty_name'];  ?></p>
  <input style="display:none" type="text" name="cou-<?php echo $row1['faculty_id'];  ?>" id="cou-<?php echo $row1['faculty_id'];  ?>" value="<?php echo $row1['faculty_name'];  ?>" class="form-control">
  </td>
    <td><p style="display:block" id="coutn-<?php echo $row1['faculty_id'];  ?>"><?php echo $row1['faculty_email'];  ?></p>
  <input style="display:none" type="text" name="coun-<?php echo $row1['faculty_id'];  ?>" id="coun-<?php echo $row1['faculty_id'];  ?>" value="<?php echo $row1['faculty_email'];  ?>" class="form-control">
  </td>
  <td>

      <select class="form-control" disabled name="sts-<?php echo $row1['faculty_id'];  ?>" id="sts-<?php echo $row1['faculty_id'];  ?>">
	  <?php 
	  if($row1['faculty_active']==1)
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
 <button type="button" style="display:block" name="modify-<?php echo $row1['faculty_id'];  ?>" id="modify-<?php echo $row1['faculty_id'];  ?>" onclick="modify(this.id)" class="btn btn-success btn-sm">Modify</button>
 <button type="button" style="display:none;" name="save-<?php echo $row1['faculty_id'];  ?>" id="save-<?php echo $row1['faculty_id'];  ?>" onclick="save(this.id)" class="btn btn-success btn-sm">Save</button>
</td>
<td>
<button type="button" style="display:none;" name="cancel-<?php echo $row1['faculty_id'];  ?>" id="cancel-<?php echo $row1['faculty_id'];  ?>" onclick="cancel(this.id)" class="btn btn-danger btn-sm">Cancel</button> 
<button type="button" style="display:block;" name="deleted-<?php echo $row1['faculty_id'];  ?>" id="deleted-<?php echo $row1['faculty_id'];  ?>" onclick="deleted(this.id)" class="btn btn-danger btn-sm">Delete</button> 
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
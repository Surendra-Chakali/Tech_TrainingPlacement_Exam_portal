<?php 
ob_start();
session_start();
include("db.php");
if(isset($_POST['regulation_id']) || isset($_POST['delall']))
{
$b=$_POST['regulation_id'];
$c=$_POST['dept_id'];
$years=$_POST['years'];
$sems=$_POST['sems'];
$mids=$_POST['mids'];
$d=$_POST['subject_code'];
if(isset($_POST['qno']))
{
	if(count($_POST['qno'])>0)
	{
		foreach($_POST['qno'] as $val)
		{
			$sql4="delete from questions where q_id=$val";
			if(mysqli_query($con,$sql4))
			{
				
			}
		}
	}
}
$y="select * from questions where q_active!=2 and regulation_ids=$b and dept_ids='$c' and years=$years and sems=$sems and mids=$mids and subject_codes='$d' order by q_id DESC";
getTheory($y);	
}
function getTheory($x)
{
	include('db.php');
?>
    <table id="example1" class="table table-bordered table-striped">
                    <thead>
					<tr> <td colspan="15"><button class="btn btn-success" name="delall" id="delall">Delete All</button></td></tr>
                      <tr><th> <input type="checkbox" value="Check All" onClick="this.value=check(this.form.list)"> </th>					  
						 <th>Correct Answer</th>						 
						 <th>Question</th>
						 <th>Question-image</th>
						 <th>Answer-1</th>
						 <th>Answer-1-image</th>
						 <th>Answer-2</th>
						 <th>Answer-2-image</th>
						 <th>Answer-3</th>
						 <th>Answer-3-image</th>
						 <th>Answer-4</th>
						 <th>Answer-4-image</th>
						  <th>Status</th>
						 <th></th>
						 <th></th>
                      </tr>
                    </thead>
                    <tbody>
 <?php 
$sql1=$x;
$res1=mysqli_query($con,$sql1);
if($res1)
{
$cnt1=mysqli_num_rows($res1);
if($cnt1>0)
{
while($row1=mysqli_fetch_array($res1))
{	
?>
<tr>
<td><input type="checkbox" name="qno[]" id="list" value="<?php echo $row1['q_id'];  ?>"/></td>
 <td><p style="display:block" id="abct1-<?php echo $row1['q_id'];  ?>"><?php echo $row1['q_correct'];  ?></p>
  <input style="display:none" type="text" onkeypress="return NumbersOnly(this,event)" name="abc1-<?php echo $row1['q_id'];  ?>" id="abc1-<?php echo $row1['q_id'];  ?>" value="<?php echo $row1['q_correct'];  ?>" class="form-control">
  </td>
  <td><p style="display:block" id="abct2-<?php echo $row1['q_id'];  ?>"><?php echo $row1['q_text'];  ?></p>
  <textarea style="display:none" name="abc2-<?php echo $row1['q_id'];  ?>" id="abc2-<?php echo $row1['q_id'];  ?>" class="form-control"><?php echo $row1['q_text'];  ?></textarea>
  </td>
  <td><p style="display:block" id="abct2i-<?php echo $row1['q_id'];  ?>">
  <?php 
  if($row1['q_text_image']!="")
  {
  ?>
  <img src="uploads/images/<?php echo $row1['q_text_image']; ?>" width="60" height="60"/>
  <?php 
  }
  ?></p>
  <input type="text" style="display:none" name="abc2i-<?php echo $row1['q_id'];  ?>" id="abc2i-<?php echo $row1['q_id'];  ?>" class="form-control" value="<?php echo $row1['q_text_image'];  ?>" />
  </td>
    <td><p style="display:block" id="abct3-<?php echo $row1['q_id'];  ?>"><?php echo $row1['q_ans1'];  ?></p>
  <textarea style="display:none" name="abc3-<?php echo $row1['q_id'];  ?>" id="abc3-<?php echo $row1['q_id'];  ?>" class="form-control"><?php echo $row1['q_ans1'];  ?></textarea>
  </td>
  <td><p style="display:block" id="abct3i-<?php echo $row1['q_id'];  ?>">
  <?php 
  if($row1['q_ans1_image']!="")
  {
  ?>
  <img src="uploads/images/<?php echo $row1['q_ans1_image']; ?>" width="60" height="60"/>
  <?php 
  }
  ?></p>
  <input type="text" style="display:none" name="abc3i-<?php echo $row1['q_id'];  ?>" id="abc3i-<?php echo $row1['q_id'];  ?>" class="form-control" value="<?php echo $row1['q_ans1_image'];  ?>" />
  </td>

      <td><p style="display:block" id="abct4-<?php echo $row1['q_id'];  ?>"><?php echo $row1['q_ans2'];  ?></p>
  <textarea style="display:none" name="abc4-<?php echo $row1['q_id'];  ?>" id="abc4-<?php echo $row1['q_id'];  ?>" class="form-control"><?php echo $row1['q_ans2'];  ?></textarea>
  </td>
  <td><p style="display:block" id="abct4i-<?php echo $row1['q_id'];  ?>">
  <?php 
  if($row1['q_ans2_image']!="")
  {
  ?>
  <img src="uploads/images/<?php echo $row1['q_ans2_image']; ?>" width="60" height="60"/>
  <?php 
  }
  ?></p>
  <input type="text" style="display:none" name="abc4i-<?php echo $row1['q_id'];  ?>" id="abc4i-<?php echo $row1['q_id'];  ?>" class="form-control" value="<?php echo $row1['q_ans2_image'];  ?>" />
  </td>
        <td><p style="display:block" id="abct5-<?php echo $row1['q_id'];  ?>"><?php echo $row1['q_ans3'];  ?></p>
  <textarea style="display:none" name="abc5-<?php echo $row1['q_id'];  ?>" id="abc5-<?php echo $row1['q_id'];  ?>" class="form-control"><?php echo $row1['q_ans3'];  ?></textarea>
  </td>
  <td><p style="display:block" id="abct5i-<?php echo $row1['q_id'];  ?>">
  <?php 
  if($row1['q_ans3_image']!="")
  {
  ?>
  <img src="uploads/images/<?php echo $row1['q_ans3_image']; ?>" width="60" height="60"/>
  <?php 
  }
  ?></p>
  <input type="text" style="display:none" name="abc5i-<?php echo $row1['q_id'];  ?>" id="abc5i-<?php echo $row1['q_id'];  ?>" class="form-control" value="<?php echo $row1['q_ans3_image'];  ?>" />
  </td>
          <td><p style="display:block" id="abct6-<?php echo $row1['q_id'];  ?>"><?php echo $row1['q_ans4'];  ?></p>
  <textarea style="display:none" name="abc6-<?php echo $row1['q_id'];  ?>" id="abc6-<?php echo $row1['q_id'];  ?>" class="form-control"><?php echo $row1['q_ans4'];  ?></textarea>
  </td>
  <td><p style="display:block" id="abct6i-<?php echo $row1['q_id'];  ?>">
  <?php 
  if($row1['q_ans4_image']!="")
  {
  ?>
  <img src="uploads/images/<?php echo $row1['q_ans4_image']; ?>" width="60" height="60"/>
  <?php 
  }
  ?></p>
  <input type="text" style="display:none" name="abc6i-<?php echo $row1['q_id'];  ?>" id="abc6i-<?php echo $row1['q_id'];  ?>" class="form-control" value="<?php echo $row1['q_ans4_image'];  ?>" />
  </td>  

  <td>
      <select class="form-control" disabled name="sts-<?php echo $row1['q_id'];  ?>" id="sts-<?php echo $row1['q_id'];  ?>">
	  <?php 
	  if($row1['q_active']==1)
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
 <button type="button" style="display:block" name="modify-<?php echo $row1['q_id'];  ?>" id="modify-<?php echo $row1['q_id'];  ?>" onclick="modify(this.id)" class="btn btn-success btn-sm">Modify</button>
 <button type="button" style="display:none;" name="save-<?php echo $row1['q_id'];  ?>" id="save-<?php echo $row1['q_id'];  ?>" onclick="save(this.id)" class="btn btn-success btn-sm">Save</button>
</td>
<td>
<button type="button" style="display:none;" name="cancel-<?php echo $row1['q_id'];  ?>" id="cancel-<?php echo $row1['q_id'];  ?>" onclick="cancel(this.id)" class="btn btn-danger btn-sm">Cancel</button> 
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
				 
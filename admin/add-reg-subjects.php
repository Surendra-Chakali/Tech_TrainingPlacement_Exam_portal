<?php 
ob_start();
session_start();
include("db.php");
if(!isset($_SESSION['admin_email']))
{
	header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function (e) {
			//alert();
			$("#uploadimage").on('submit',(function(e) {		
			e.preventDefault();
			$("#message").empty();
			$('#loading').html('<img src="images/loading.gif" alt="" width="24" height="24">');			
			$.ajax({
			url: "ajaxfile-add-reg-subjects.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
			$('#loading').hide();
			$("#message").html(data);
			}
			});						
			
			}));
			// Function to preview image after validation
			});		
</script>
  </head>
  <body class="skin-blue layout-top-nav">
 <?php 
require_once("header.php");
?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
         
          </section>

          <!-- Main content -->
               
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Assign subjects to regulation</h3>
              </div>
              <div class="box-body">
                
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">                
                <div class="box-body">
				
								
 <form id="uploadimage" enctype="multipart/form-data" class="form-horizontal">
                 <div class="box-body">	
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Regulation</label>
                      <div class="col-sm-6">
						      <select class="form-control" name="regulation_id" id="regulation_id">
						  <option value="">Select Regulation</option>
							<?php 
						$sql12="select * from regulations where regulation_active=1 order by regulation_name";
						$res12=mysqli_query($con,$sql12);
						$cnt12=mysqli_num_rows($res12);
						if($cnt12>0)
						{
						while($row12=mysqli_fetch_array($res12))
						{	
						echo '<option value="'.$row12['regulation_id'].'">'.$row12['regulation_name'].'</option>';
						}
						}
						  ?>
						  </select>
                      </div>
                    </div> 				 
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Department</label>
                      <div class="col-sm-6">
						      <select class="form-control" name="dept_id" id="dept_id">
						  <option value="">Select Department</option>
							<?php 
						$sql12="select * from departments where dept_active=1 order by dept_name";
						$res12=mysqli_query($con,$sql12);
						$cnt12=mysqli_num_rows($res12);
						if($cnt12>0)
						{
						while($row12=mysqli_fetch_array($res12))
						{	
						echo '<option value="'.$row12['dept_id'].'">'.$row12['dept_name'].'</option>';
						}
						}
						  ?>
						  </select>
                      </div>
                    </div>                  					
                   <div class="form-group"> 
				  <label for="inputEmail3" id="status" class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">					
                    <input type="submit" value="Assign" class="btn btn-success" />
                    <button type="reset" class="btn btn-danger">Cancel</button>
					</div>
                  </div><!-- /.box-footer -->
                  </div><!-- /.box-body -->
               
		<h4 id='loading'></h4>
<div id="message"></div>			
				
		
<div class="col-md-12">
 <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					  <th> <input type="checkbox" value="Check All" onClick="this.value=check(this.form.list)"> </th>
                         <th>Subject Code</th>
						 <th>Subject Name</th>
                      </tr>
                    </thead>
                    <tbody>
 <?php 
 $sql="select * from subjects where subject_active=1 order by subject_code";
$res1=mysqli_query($con,$sql);
$cnt1=mysqli_num_rows($res1);
if($cnt1>0)
{
while($row1=mysqli_fetch_array($res1))
{	
?>
<tr>
<td><input type="checkbox" name="qno[]" id="list" value="<?php echo $row1['subject_code'];  ?>"/></td>
<td><?php echo $row1['subject_code'];  ?></td>
<td><?php echo $row1['subject_name'];  ?></td> 
</tr>
<?php 
}
}
?>
                    
                 
                 
                    </tbody>
               
                  </table>
</div>	
 </form> 	
			</div><!-- /.box-body -->
            
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
     
	
              </div><!-- /.box-body -->
            </div><!-- /.box -->
        
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
   <?php 
   include("footer.php");
   ?>
    </div><!-- ./wrapper -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
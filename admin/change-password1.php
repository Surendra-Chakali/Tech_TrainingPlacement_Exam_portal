<?php 
ob_start();
session_start();
include("db.php");
if(!isset($_SESSION['faculty_email']))
{
	header("Location:faculty-login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
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
	
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script>
	function validate()
	{
		var x=document.getElementById("opwd").value;
		var y=document.getElementById("npwd").value;
		var z=document.getElementById("cpwd").value;
		if(x.length==0)
		{
			alert("Please enter old password");
			return false;
		}
		else if(y.length==0)
		{
			alert("Please enter new password");
			return false;
		}
		else if(z.length==0)
		{
			alert("Please enter confirm password");
			return false;
		}
		else if(y!=z)
		{
			alert("New and Confirm Passwords did not matched");
			return false;
		}
		else 
		{
			return true;
		}
	}
	</script>
  </head>
  <body class="skin-blue layout-top-nav">
 <?php 
require_once("header1.php");
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
                <h3 class="box-title">Change Password</h3>
              </div>
              <div class="box-body">
             
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">                
                <div class="box-body">
				<center>
				<?php 
if(isset($_POST['login']))
{
	$uname=$_SESSION['faculty_email'];
	$upwd=$_POST['opwd'];
	$npwd=$_POST['npwd'];
	$sql="select * from faculty where faculty_email='$uname' and faculty_pwd='$upwd'";
	$res=mysqli_query($con,$sql);
	$cnt=mysqli_num_rows($res);
	if($cnt>0)
	{		
	     $sql1="update faculty set faculty_pwd='$npwd' where faculty_email='$uname'";
		 if(mysqli_query($con,$sql1))
		 {
			echo '<p style="color:green">Your password changed successfully</p>'; 
		 }
	}
	else 
	{		
		echo '<p style="color:red">You have entered wrong old-password</p>';	
	}			
}

?>	
				 <form  method="post" action="" class="form-horizontal" onsubmit="return validate()">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Enter Old Password</label>
                      <div class="col-sm-5">
                       <input type="password" class="form-control" name="opwd" id="opwd" />
					   </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Enter New Password</label>
                      <div class="col-sm-5">
                       <input type="password" class="form-control" name="npwd" id="npwd" />
					   </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Confirm New Password</label>
                      <div class="col-sm-5">
                       <input type="password" class="form-control" name="cpwd" id="cpwd" />
					   </div>
                    </div>					
					
                  </div><!-- /.box-body -->
                  <div class="form-group"> 
				  <label for="inputEmail3" id="status" class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">
					<button type="reset" class="btn btn-danger">Cancel</button>
                    <input type="submit" name="login" value="Change Password" class="btn btn-success" />
					</div>
                  </div><!-- /.box-footer -->
                </form> 

				
		</center>				
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
    <!-- jQuery 2.1.4 --><!-- Bootstrap 3.3.2 JS -->
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
        //$("#example1").DataTable();
        $('#example1').DataTable({
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

<?php 
ob_start();
session_start();
include("db.php");
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

    <style type="text/css">
    
    body{background: url('placement.jpeg');background-size: 100% 100%;}

    #stdLogin{
          width: 370px;
          height: 380px;
          position: relative;
          left: 30%;
          margin-top: 150px;
          background-color: white;
          color: white;
          border-radius: 20px;
    }

</style>

  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body>
    <div class="wrapper">
   <!-- Full Width Column -->
      <div>
        <div class="container">
         
          <!-- Main content -->
          <section class="content">
<div class="col-md-3"></div>
           
			<div class="" align="center" style="" id="stdLogin">
              <!-- general form elements -->
              <div class="">
                <div class="box-header">
                  <h1 style="color:#C50909;" class="text-center">Admin Login</h1>
                </div><!-- /.box-header -->
								<?php 
if(isset($_POST['login']))
{
	$uname=$_POST['uname'];
	$upwd=$_POST['upwd'];
	$sql="select * from admin where admin_email='$uname' and admin_pwd='$upwd'";
	$res=mysqli_query($con,$sql);
	$cnt=mysqli_num_rows($res);
	if($cnt>0)
	{
		$row=mysqli_fetch_array($res);
		$_SESSION['admin_email']=$row['admin_email'];
		$_SESSION['admin_name']=$row['admin_name'];
		header("Location:home.php");
	}
	else 
	{		
		echo '<p style="color:black">Login failed.  Email id or Password is wrong</p>';	
	}			
}

?>
                <!-- form start -->
                <form role="form" method="post" action="">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1"></label>
                      <input type="text" class="form-control text-bold" id="uname" name="uname"placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"></label>
                      <input type="password" class="form-control text-bold" name="upwd" id="upwd" placeholder="Password">
                    </div>                
                  
                   </div><!-- /.box-body -->
                    <div class="form-group"></div>
                  <div class="form-group">
                    <button type="submit" name="login" style="background-color:#0A4E75;" class="btn btn-primary">Login</button>
                  </div>
                </form>

              </div><!-- /.box -->

            </div>
           
           
			
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer" style="background-color:#C50909;">
        <div class="container">
          <div class="pull-right hidden-xs">
           
          </div>
          <b style="color:#FFFFFF;">Copyright &copy;  <?php echo date('Y');?> TECH(HU). All rights reserved.</b>
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
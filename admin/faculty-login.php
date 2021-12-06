<?php 
ob_start();
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Faculty Login</title>
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
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">
   <!-- Full Width Column -->
      <div class="content-wrapper" style="background-color:#0EC31C;">
        <div class="container">
         
          <!-- Main content -->
          <section class="content">
<div class="col-md-3"></div>
           
			<div class="col-md-6" style="padding-top:30px;">
              <!-- general form elements -->
              <div class="col-md-12">
                <div class="box-header">
                  <h1 style="color:#C50909;">Faculty Login</h1>
                </div><!-- /.box-header -->
								<?php 
if(isset($_POST['login']))
{
	$uname=$_POST['uname'];
	$upwd=$_POST['upwd'];
	$sql="select * from faculty where faculty_email='$uname' and faculty_pwd='$upwd'";
	$res=mysqli_query($con,$sql);
	$cnt=mysqli_num_rows($res);
	if($cnt>0)
	{
		$row=mysqli_fetch_array($res);
		$_SESSION['faculty_email']=$row['faculty_email'];
		$_SESSION['faculty_name']=$row['faculty_name'];
		header("Location:faculty-home.php");
	}
	else 
	{		
		echo '<p style="color:black">Login failed.  Email id or Password is wrong</p>';	
	}			
}

?>
                <!-- form start -->
<?php 
$sql1="select * from faculty where faculty_active=1";
$res1=mysqli_query($con,$sql1);
if($res1)
{
	$cnt1=mysqli_num_rows($res1);
	if($cnt1>0)
	{
		
?>	

                <form role="form" method="post" action="">
                  <div class="box-body">
                    <div class="form-group col-md-8">
                      <label for="exampleInputEmail1"></label>
                      <input type="text" class="form-control" id="uname" name="uname"placeholder="Enter email">
                    </div>
                    <div class="form-group col-md-8">
                      <label for="exampleInputPassword1"></label>
                      <input type="password" class="form-control" name="upwd" id="upwd" placeholder="Password">
                    </div>                
                  
                   </div><!-- /.box-body -->
                    <div class="form-group col-md-5"></div>
                  <div class="form-group col-md-3">
                    <button type="submit" name="login" style="background-color:#0A4E75;" class="btn btn-primary">Login</button>
                  </div>
                </form>
<?php 
	}
	else 
	{
		echo '<button class="btn btn-success" name="allow">Faculty Login is blocked</button>';
	}
}
?>
              </div><!-- /.box -->

            </div>
           
           
			
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer" style="background-color:#C50909;">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b style="color:#FFFFFF;">Designed & Developed By VYR SOFTWARES,Hi-Tech City</b>
          </div>
          <b style="color:#FFFFFF;">Copyright &copy; 2015 MeRITS,Udayagiri. All rights reserved.</b>
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
<style type="text/css">
body{
	    padding-top: 238px;
}
</style>
	<script>
	$(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
});
	</script>
 <header class="main-header">
        <nav class="navbar navbar-fixed-top" style="background-color:#FFFFFF;">
        <div class="container" style="background-color:#FFFFFF;">
          <!-- Content Header (Page header) -->
          <section class="content-header">
		  <div class="col-md-2">
           <img src="images/logo1.png"/> 
          </div>
          <div class="col-md-10"> 
		  <h3 style="text-align:center;">TRAINING AND PLACEMENT ONLINE EXAM<br>
TADIPATRI ENGINEERING COLLGEGE <br>VEERAPURAM,TADIPATRI, ATP -515411
</h3>
		  </div>		  
          </section>
		</div>		
          <div class="container" style="background-color:#3c8dbc;">
            <div class="navbar-header">
              <a href="home.php" class="navbar-brand"><b>Home</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">              
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
				  <li><a href="add-regulations.php">Regulations</a></li>
				  <li><a href="add-subjects.php">Subjects</a></li>
                    <li><a href="add-departments.php">Departments</a></li>	                   
                    <li><a href="add-students.php">Students</a></li>
					<!-- <li><a href="add-faculty.php">Faculty</a></li>	-->				 
                  </ul>
                </li>
				
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">View<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
				  <li><a href="view-regulations.php">Regulations</a></li>
				  <li><a href="view-subjects.php">Subjects</a></li>
                    <li><a href="view-departments.php">Departments</a></li>	                   
                    <li><a href="view-students.php">Students</a></li>
					<!-- <li><a href="view-faculty.php">Faculty</a></li> -->
                  </ul>
                </li>
			<!--	<li class="dropdown" style="position:relative">				
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Assessment Criteria <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<li>
			<a class="trigger right-caret">Sectors</a>
			<ul class="dropdown-menu sub-menu">
				<li><a href="add-sector.php">Add Sector</a></li>
                <li><a href="view-sector.php">View Sectors</a></li>
			</ul>
		</li>
		<li>
			<a class="trigger right-caret">Job Roles</a>
			<ul class="dropdown-menu sub-menu">
				<li><a href="add-job-role.php">Add Job Role</a></li>                    
                <li><a href="view-job-roles.php">View Job Roles</a></li> 
			</ul>
		</li>
		<li>
			<a class="trigger right-caret">NOSs</a>
			<ul class="dropdown-menu sub-menu">
			 <li><a href="add-nos.php">Add NOS</a></li>					
			 <li><a href="view-nos.php">View NOSs</a></li> 
			</ul>
		</li>
		<li>
			<a class="trigger right-caret">PCs</a>
			<ul class="dropdown-menu sub-menu">
			<li><a href="add-pc.php">Add PC's</a></li>									
			<li><a href="view-pc.php">View PC's</a></li>  
			</ul>
		</li>
	</ul>
</li>
				<li class="dropdown" style="position:relative">				
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="nos-results.php">Result(NOS Wise)</a></li>
						<li><a href="student-report.php">Student Report</a></li>
						<li><a href="view-student-images.php">View Student Images</a></li>
						<li><a href="center-photos.php">View Center Images</a></li>	
						<li><a href="upload-videos.php">View Videos Proctoring</a></li>
						 <li><a href="view-feedback.php">View Feedback</a></li>	                        					
					</ul>
				</li>
 -->
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Question Bank <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">				    					 
                    <li><a href="add-questions.php">Add Questions</a></li>
					<li><a href="add-questions-image.php">Add Image Based Questions</a></li>
					<li><a href="view-questions.php">View Questions</a></li>
					<li><a href="view-papers.php">Question Paper Settings</a></li>
					
				  </ul>
                </li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Security <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">				    					 
                    <li><a href="block-faculty.php">Block Faculty Login</a></li>
				  </ul>
                </li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">				    					 
                    <li><a href="exam-results.php">Exam Results</a></li>
					<li><a href="exam-attendance.php">Exam Attendance</a></li>
					<li><a href="download-questions.php">Download Questions</a></li>
				  </ul>
                </li>					
				 <li class="dropdown">
                  <a href="change-password.php">Change Password</a>                
               </li>
			   <li class="dropdown">
                  <a href="logout.php">Logout</a>                
               </li>
              </ul>            
            </div><!-- /.navbar-collapse -->
           
          </div><!-- /.container-fluid -->
        </nav>
      </header>
<style type="text/css">
body{
	    padding-top: 138px;
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
           <img src="images/logo.png"/>           
          </section>
		</div>		
          <div class="container" style="background-color:#3c8dbc;">
            <div class="navbar-header">
              <a href="faculty-home.php" class="navbar-brand"><b>Home</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">              
       
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Question Bank <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">				    					 
                    <li><a href="add-questions1.php">Add Questions</a></li>
					<li><a href="add-questions-image1.php">Add Image Based Questions</a></li>
					<li><a href="view-questions1.php">View Questions</a></li>
				  </ul>
                </li>									
				 <li class="dropdown">
                  <a href="change-password1.php">Change Password</a>                
               </li>
			   <li class="dropdown">
                  <a href="logout1.php">Logout</a>                
               </li>
              </ul>            
            </div><!-- /.navbar-collapse -->
           
          </div><!-- /.container-fluid -->
        </nav>
      </header>
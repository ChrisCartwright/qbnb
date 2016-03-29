<?php include 'header.php'; ?>

<?php
  //Create a user session or resume an existing one
 session_start();
 ?>

 <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
    //Destroy the user's session.
    $_SESSION['id']=null;
    session_destroy();
}
 ?>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
            <a class="navbar-brand" href="">QBnB</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>	
                		<a href="index.php">Find a Place</a>
                		<li>
                		<a href="register.php">Become a Host</a>
                	</li>
                	<li>
                		<a href="register.php">Register</a>
                	</li>
                	<li>
                        <?php if(isset($_SESSION['id'])): ?>
                        <a href="home.php?logout=1" id="logout">Logout</a>
                        <?php else: ?>
                        <a href="login.php" id="login">Login</a>
                        <?php endif; ?>
                    </li>
                        

                       
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<div class="jumbotron">
	<div class="container">
  		<h1>Welcome Home</h1>
  		<p>Use the trusted Queen's Alumnae network when searching for a place to stay</p>
		  <div class="row">
		  <div class="col-lg-6 col-lg-offset-3">
		    <div class="input-group">
		      <input type="text" class="form-control" placeholder="Search for...">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button">Go!</button>
		      </span>
		    </div><!-- /input-group -->
		  </div><!-- /.col-lg-6 -->
		</div><!-- /.row -->
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="col-lg-6">
			
			</div>
			<div class="col-lg-6">
				
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>
</div>



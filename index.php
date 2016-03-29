<?php include 'header.php'; ?>

<?php
  //Create a user session or resume an existing one
 session_start();
 ?>

 <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
    //Destroy the user's session.

    $_SESSION['member_id']=null;
	$_SESSION['admin_id']=null;
    session_destroy();

    if(isset($_SESSION['member_id'])) {
  	 	$_SESSION['member_id']=null;
    	session_destroy();
    }

}
 ?>
 
 <?php
 //check if the user clicked the logout link and set the logout GET parameter
//if(isset($_GET['logout'])){
    //Destroy the user's session.

   //$_SESSION['admin_id']=null;
  // session_destroy();
//}

    if(isset($_SESSION['admin_id'])) {
    	$_SESSION['admin_id']=null;
    	session_destroy();
    }


 ?>

<?php include 'navigation.php'; ?>

<div class="jumbotron">
	<div class="container">
  		<h1>Welcome Home</h1>
  		<p>Use the trusted Queen's Alumnae network when searching for a place to stay</p>
		 <!-- <div class="row">
		  <div class="col-lg-6 col-lg-offset-3">
		    <div class="input-group">
		      <input type="text" class="form-control" placeholder="Search for...">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button">Go!</button>
		      </span>
		    </div>
		  </div>
		</div>-->
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>What is QBnB?</h2>
			<p>Queen's Bed and Breakfast is a network of Queen's Alumnae that facilitates easy and trusted renting of properties
				in the Ottawa area. All bookings are for one week starting on Saturdays to ensure you get that luxurious vacation 
				you deserve. Sign up today! All you need is the be a Queen's Alumnae.</p>
		</div>
	</div>
	<div class="row">			
		<div class="col-md-6">
			<h2>Trusted</h2>
			<p>Rent from fellow Queen's Alumnae to ensure your accomadation is just what you're looking for</p>
		</div>
		<div class="col-md-6">
			<h2>Fun!</h2>
			<p>Renting from Queen's Alumnae is not only safe, but fun as well. </p>
		</div>
	</div>
</div>



<?php include 'footer.php';?>
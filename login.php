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
}
 ?>
 
 
 
 <?php
 //check if the user is already logged in and has an active session
if(isset($_SESSION['member_id'])){
	//Redirect the browser to the profile editing page and kill this page.
	header("Location: index.php");
	die();
}
 ?>
  <?php
 //check if the user is already logged in and has an active session
if(isset($_SESSION['admin_id'])){
	//Redirect the browser to the admin home page and kill this page.
	header("Location: adminhome.php");
	die();
}
 ?>
 <?php include 'navigation.php'; ?>
 
 <?php

 
//check if the login form has been submitted
if(isset($_POST['loginmemBtn'])){
 
    // include database connection
    include_once 'config/connection.php'; 
	
	// SELECT query
        $query = "SELECT member_id, email, password FROM member WHERE email=? AND password=?";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)){
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("ss", $_POST['emailmem'], $_POST['passwordmem']);


         
        // Execute the query
		$stmt->execute();
 
		/* resultset */
		$result = $stmt->get_result();

		// Get the number of rows returned
		$num = $result->num_rows;
		
		if($num>0){
			//If the username/password matches a user in our database
			//Read the user details
			$myrow = $result->fetch_assoc();
			//Create a session variable that holds the user's id
			$_SESSION['member_id'] = $myrow['member_id'];
			//Redirect the browser to the profile editing page and kill this page.
			header("Location: index.php");
			die();
		} else {
			//If the username/password doesn't matche a user in our database
			// Display an error message and the login form
			echo "Failed to login";
		}
		} else {
			echo "failed to prepare the SQL";
		}
 }
?>
<?php

 
//check if the login form has been submitted
if(isset($_POST['loginadmBtn'])){
 
    // include database connection
    include_once 'config/connection.php'; 
	
	// SELECT query
        $query = "SELECT admin_id, password FROM admin WHERE admin_id=? AND password=?";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)){
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("is", $_POST['admin_id'], $_POST['passwordadm']);


         
        // Execute the query
		$stmt->execute();
 
		/* resultset */
		$result = $stmt->get_result();

		// Get the number of rows returned
		$num = $result->num_rows;
		
		if($num>0){
			//If the username/password matches a user in our database
			//Read the user details
			$myrow = $result->fetch_assoc();
			//Create a session variable that holds the user's id
			$_SESSION['admin_id'] = $myrow['admin_id'];
			//Redirect the browser to the admin home page and kill this page.
			header("Location: adminhome.php");
			die();
		} else {
			//If the username/password doesn't matche a user in our database
			// Display an error message and the login form
			echo "Failed to login";
		}
		} else {
			echo "failed to prepare the SQL";
		}
 }
?>

<div class="register-page">
	<h1 style="text-align: center">Queen's BnB Login</h1>
	
	<div class="well">
		<div class="row">
		
			<div class="col-md-4 col-md-offset-2">
				<h2>Login</h2>
				 <form name='login' id='login' action='login.php' method='post'>
				    <div class="form-group">
				            <label>Email</label>
				            <input class="form-control" type='text' name='emailmem' id='emailmem' />
				     </div>
				     <div class="form-group">
				            <label>Password</label>
				            <input class="form-control" type='password' name='passwordmem' id='passwordmem' />
				     </div>
				        
				            
				   	 <input class="btn btn-default" type='submit' id='loginmemBtn' name='loginmemBtn' value='Log In' />        
				   
				</form>
			</div>
			
			
			<h2>Administration Login</h2>
	
	
		
			<div class="col-md-4 col-md-offset-0">
				
				 <form name='loginadmin' id='loginadmin' action='login.php' method='post'>
				    <div class="form-group">
				            <label>Administrative ID</label>
				            <input class="form-control" type='number' name='admin_id' id='admin_id' />
				     </div>
				     <div class="form-group">
				            <label>Password</label>
				            <input class="form-control" type='password' name='passwordadm' id='passwordadm' />
				     </div>
				        
				            
				   	 <input class="btn btn-default" type='submit' id='loginadmBtn' name='loginadmBtn' value='Log In' />        
				   
				</form>
			</div>
			
		</div>
		
</div>
</div>
	
			
			

<?php include 'footer.php';?>
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
if(isset($_POST['loginBtn'])){
 
    // include database connection
    include_once 'config/connection.php'; 
	
	// SELECT query
        $query = "SELECT member_id, email, password FROM member WHERE email=? AND password=?";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)){
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("ss", $_POST['email'], $_POST['password']);


         
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

 if(isset($_POST['registerBtn'])){
 
    // include database connection
    include_once 'config/connection.php'; 
	
	// SELECT query
        $query = "SELECT member_id, email FROM member WHERE email=?";
 
        // prepare query for execution
        if($stmt = $con->prepare($query)){
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
	        $stmt->bind_Param("s", $_POST['email']);


	         
	        // Execute the query
			$stmt->execute();
	 
			/* resultset */
			$result = $stmt->get_result();

			// Get the number of rows returned
			$num = $result->num_rows;;
		
			if($num>0){
				echo "email already registered";
			} 
			else {
				$query = "INSERT INTO member (FName, LName, EMail, PPhone, Year, Faculty, Degree, password) VALUES (?,?,?,?,?,?,?,?)";
				if($stmt = $con ->prepare($query)) {
					$stmt->bind_Param("ssssisss", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['pphone'], $_POST['year'], $_POST['faculty'], $_POST['degree'], $_POST['password']);
					$stmt->execute();

					$_SESSION['member_id'] = $con->insert_id;
					//Redirect the browser to the profile editing page and kill this page.
					header("Location: index.php");
					die();

				}
				else {
					echo "insert query failed";
				}
			}
		} 
		else {
			echo "failed to prepare the SQL";
		}
 }
 
?>


<div class="register-page">
	<h1 style="text-align: center">Queen's BnB Sign Up or Login</h1>
	<div class="well">
	
		<div class="row" id="login-box">
			<div class="col-md-4 col-md-offset-2">
				<h2>Login</h2>
				 <form name='login' id='login' action='login.php' method='post'>
				    <div class="form-group">
				            <label>Email</label>
				            <input class="form-control" type='text' name='email' id='email' />
				     </div>
				     <div class="form-group">
				            <label>Password</label>
				            <input class="form-control" type='password' name='password' id='password' />
				     </div>
				        
				            
				   	 <input class="btn btn-default" type='submit' id='loginBtn' name='loginBtn' value='Log In' />        
				   
				</form>
			</div>
			<div class="col-md-4">
				<h2>Register</h2>
				 <form name='register' id='register' action='login.php' method='post'>
				    <div class="form-group">
				            <label>Email</label>
				            <input class="form-control" type='text' name='email' id='email' required="true" />
				     </div>
				     <div class="form-group">
				            <label>Password</label>
				            <input class="form-control" type='password' name='password' id='password' required="true"/>
				     </div>
				     <div class="form-group">
				            <label>First Name</label>
				            <input class="form-control" type='text' name='firstname' id='firstname' required="true"/>
				     </div>
				     <div class="form-group">
				            <label>Last Name</label>
				            <input class="form-control" type='text' name='lastname' id='lastname' required="true"/>
				     </div>
				     <div class="form-group">
				            <label>Phone Number</label>
				            <input class="form-control" type='text' name='pphone' id='pphone' required="true"/>
				     </div>
				     <div class="form-group">
				            <label>Graduating Year</label>
				            <input class="form-control" type='number' name='year' id='year' required="true"/>
				     </div>
				     <div class="form-group">
				            <label>Faculty</label>
				            <input class="form-control" type='text' name='faculty' id='faculty' required="true"/>
				     </div>
				     <div class="form-group">
				            <label>Degree</label>
				            <input class="form-control" type='text' name='degree' id='degree' required="true"/>
				     </div>
				        
				            
				   	 <input class="btn btn-default" type='submit' id='registerBtn' name='registerBtn' value='Register' />        
				   
				</form>
			</div>
		</div>
</div>
	
</div>

<?php include 'footer.php';?>
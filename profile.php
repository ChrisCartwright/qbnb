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
	session_destroy();
}
 ?>
 
 <?php include 'navigation.php'; ?>
 <?php 
 if(isset($_SESSION['member_id'])){

 include_once 'config/connection.php'; 
 $query = "SELECT * FROM member WHERE Member_ID=?";
 $stmt = $con ->prepare($query); 
 $stmt->bind_Param("i", $_SESSION['member_id']);
 $stmt->execute();
 $result = $stmt->get_result();
 $myrow = $result->fetch_assoc();
 
 }
 
 else {
	 echo "test";
	header("Location: index.php");
	die();
	}
	$password = $myrow['password'];
	$email = $myrow['EMail'];
	$firstname = $myrow['FName'];
	$lastname = $myrow['LName'];
	$pphone = $myrow['PPhone'];
	$year = $myrow['Year'];
	$faculty = $myrow['Faculty'];
	$degree = $myrow['Degree'];	
?>
 

 <?php
 
 if(isset($_POST['saveBtn'])&& isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
	
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$pphone = $_POST['pphone'];
	$year = $_POST['year'];
	$faculty = $_POST['faculty'];
	$degree = $_POST['degree']; 
	
	$query = "UPDATE member SET FName= '$firstname', LName= '$lastname', EMail= '$email', PPhone='$pphone', Year='$year', Faculty='$faculty', Degree='$degree', password='$password' WHERE Member_ID=?";
	echo $query;
	
 
	$stmt = $con->prepare($query); 
	$stmt->bind_Param("issssisss", $_SESSION['member_id'], $firstname, $lastname, $email, $pphone, $year, $faculty, $degree, $password); 
	
	// Execute the query
        if($stmt->execute()){
            echo "Record was updated";
        }else{
            echo "Unable to update record";
        }
	
	echo $query;
	echo $firstname;
 }
  
 ?>
 




		<div class="register-page">
			<h1>Welcome</h1>
				
				<div class="row">
				<div class="col-md-4">
				<div class="well">
				<h2>Profile</h2>
				 <form name='profile' id='profile' action='profile.php' method='post'>
					<?php if(isset($_POST['editBtn'])):?>
					
					
					<?php else:	?>		
					<fieldset disabled>
					<?php endif; ?>
					
					<div class="form-group">
				            <label>Email</label>
				            <input class="form-control" type='text' name='email' id='email' required="true" value="<?=$email ?>" />
				     </div>
				     <div class="form-group">
				            <label>Password</label>
				            <input class="form-control" type='password' name='password' id='password' required="true" value="<?=$password ?>" />
				     </div>
				     <div class="form-group">
				            <label>First Name</label>
				            <input class="form-control" type='text' name='firstname' id='firstname' required="true" value="<?=$firstname?>"/>
				     </div>
				     <div class="form-group">
				            <label>Last Name</label>
				            <input class="form-control" type='text' name='lastname' id='lastname' required="true" value="<?=$lastname?>" />
				     </div>
				     <div class="form-group">
				            <label>Phone Number</label>
				            <input class="form-control" type='text' name='pphone' id='pphone' required="true" value="<?=$pphone?>" />
				     </div>
				     <div class="form-group">
				            <label>Graduating Year</label>
				            <input class="form-control" type='number' name='year' id='year' required="true" value="<?=$year?>" />
				     </div>
				     <div class="form-group">
				            <label>Faculty</label>
				            <input class="form-control" type='text' name='faculty' id='faculty' required="true" value="<?=$faculty ?>" />
				     </div>
				     <div class="form-group">
				            <label>Degree</label>
				            <input class="form-control" type='text' name='degree' id='degree' required="true" value="<?=$degree?>" />
				     </div>
				      </fieldset>
					<input class="btn btn-default" type='submit' id='editBtn' name='editBtn' value='Edit' /> 
					 <input class="btn btn-default" type='submit' id='saveBtn' name='saveBtn' value='Save' /> 
				</form>
			</div>
			</div>
			</div>
			</div>

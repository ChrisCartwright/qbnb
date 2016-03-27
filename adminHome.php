<?php include 'header.php'; ?>
 
 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>
 <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
	//Destroy the user's session.
	$_SESSION['admin_id']=null;
	session_destroy();
}
 ?>

 <?php
 //want to display as editable form like in profile 
 //firstname, lastname, phonenum to edit and admin id 
 //and pass to see but not change
 
 if(isset($_SESSION['admin_id'])){

 include_once 'config/connection.php'; 
 $query = "SELECT * FROM admin WHERE Admin_ID=?";
 $stmt = $con ->prepare($query); 
 $stmt->bind_Param("i", $_SESSION['admin_id']);
 $stmt->execute();
 $result = $stmt->get_result();
  $myrow = $result->fetch_assoc();
 }
 
 else {
	 echo "test";
	header("Location: admin.php");
	die();
	}
	$firstname = $myrow['FirstName'];
	$lastname = $myrow['LastName'];
	$phone = $myrow['Phone'];
?>

<?php
 
 if(isset($_POST['saveBtn'])&& isset($_SESSION['admin_id'])){
  // include database connection
    include_once 'config/connection.php'; 
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	
	$query = "UPDATE admin SET FirstName= '$firstname', LastName= '$lastname', Phone='$phone' WHERE Admin_ID=?";
	echo $query;
	
 
	$stmt = $con->prepare($query); 
	$stmt->bind_Param("i", $_SESSION['admin_id']);
	// Execute the query
        if($stmt->execute()){
            
        }else{
            echo "Unable to update record";
        }
	
 }
  
 ?>
 
 
 
 

 <?php include 'navigation.php'; ?>
		<div class="register-page">
			<h1>Welcome</h1>
				
				<div class="row">
				<div class="col-md-4">
				<div class="well">
				<h2>Profile</h2>
				 <form name='adminprofile' id='aprofile' action='adminHome.php' method='post'>
					<?php if(isset($_POST['editBtn'])):?>
					
					
					<?php else:	?>		
					<fieldset disabled>
					<?php endif; ?>
					
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
				            <input class="form-control" type='text' name='phone' id='phone' required="true" value="<?=$phone?>" />
				     </div>
				     </fieldset>
					<input class="btn btn-default" type='submit' id='editBtn' name='editBtn' value='Edit' /> 
					 <input class="btn btn-default" type='submit' id='saveBtn' name='saveBtn' value='Save' /> 
				</form>
				
			</div>
			</div>
			
				
				<div class="col-md-4 col-md-offset-0">
				<div class="well">
				<h2>Member Management</h2>
				 <form name='search' id='search' action='adminHome.php' method='post'>
					<?php if(isset($_POST['searchBtn'])){
							include_once 'config/connection.php';
							
							$query = "SELECT address_number, address_name FROM member join property WHERE Member_ID =?";  
					
							if($stmt = $con ->prepare($query)) 
							{
								$stmt->execute();
								$result = $stmt->get_result();
								while($myrow = $result->fetch_assoc()) {
								}
								$memberid= $myrow['member_id'];
								
								
							}
							else{
								echo "query failed";
							}
						}
					?>
					
					<div class="form-group">
				            <label>Member ID</label>
				            <input class="form-control" type='text' name='memberid' id='memberid' required="true" value="<?=$memberid?>"/>
				     </div>
				     </fieldset>
					<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Search' /> 
				
			
					
				<h2>Member Details</h2>
				 <form name='search' id='search' action='adminHome.php' method='post'>
					
					<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Host Data' />
					<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Consumer Data' />
					<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Property Data' />
					
					<h3>Properties</h3>
					<!-- want to display list of properties here each with a delete button to its left-->
					
				     </fieldset>
					 
					
					<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Delete Member' />
				
				</form>
			</div>
			</div>
			</div>
			</div>


<?php include 'footer.php';?>
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
 <?php include 'navigation.php'; ?>

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
					<div class="form-group">
				            <label>Member ID</label>
				            <input class="form-control" type='text' name='member_id' id='member_id' required="true" />
				     </div>
				     
					<input class="btn btn-default" type='submit' id='searchmemBtn' name='searchmemBtn' value='Search' /> 
				
									
				<?php
				
					
					 //check if the login form has been submitted
					if(isset($_POST['searchmemBtn']))
					{
 
					// include database connection
					include_once 'config/connection.php'; 
					
					// SELECT query
						$query = "SELECT * FROM member WHERE Member_ID=?";
						// prepare query for execution
						if($stmt = $con->prepare($query)){
						// bind the parameters. This is the best way to prevent SQL injection hacks.
						$stmt->bind_Param("i", $_POST['member_id']);
						
						 // Execute the query
						$stmt->execute();
						/* resultset */
						$result = $stmt->get_result();
						$myrow = $result->fetch_assoc();
						// Get the number of rows returned
						$num = $result->num_rows;
						if($num>0){
							
							header("Location: admineditmember.php?id=" . $myrow['Member_ID'] . "");
							die();
							
						}
						/* echo "<h2>Properties</h2>";
						if($num>0){
							//If the username/password matches a user in our database
							//Read the user details
							while($myrow = $result->fetch_assoc()){
							echo "<h4>" .$myrow['Address_Number']." " .$myrow['Address_Name']. "</h4>";
							}							
						} else {
							//If the member id doesn't matche a user in our database
							// Display an error message and the login form
							echo "No Properties";
						}
						}  */
						else {
							echo "failed to prepare the SQL";
						}
				 }
				 }
				?> 
			
				
				</form>
				</div>
				</div>
				</div>
				
				<div class="col-md-4 col-md-offset-4">
				<div class="well">
				<h2>Accomodation Management</h2>
				 <form name='search' id='search' action='adminHome.php' method='post'>	
					<div class="form-group">
				            <label>Property ID</label>
				            <input class="form-control" type='text' name='propertyid' id='propertyid' required="true" />
				     </div>
				     
					<input class="btn btn-default" type='submit' id='searchpropBtn' name='searchpropBtn' value='Search Accomodation' /> 
				
									
				<?php
				
					
					 //check if the login form has been submitted
					if(isset($_POST['searchpropbtn']))
					{
 
					// include database connection
					include_once 'config/connection.php'; 
					
					// SELECT query
						$query = "SELECT * FROM property WHERE Property_ID=?";
						// prepare query for execution
						if($stmt = $con->prepare($query)){
						// bind the parameters. This is the best way to prevent SQL injection hacks.
						$stmt->bind_Param("i", $_POST['propertyid']);
						
						 // Execute the query
						$stmt->execute();
						/* resultset */
						$result = $stmt->get_result();
						$myrow = $result->fetch_assoc();
						// Get the number of rows returned
						$num = $result->num_rows;
						if($num>0){
							
							header("Location: admineditproperty.php?id=" . $myrow['Property_ID'] . "");
							die();
							
						}
						/* echo "<h2>Properties</h2>";
						if($num>0){
							//If the username/password matches a user in our database
							//Read the user details
							while($myrow = $result->fetch_assoc()){
							echo "<h4>" .$myrow['Address_Number']." " .$myrow['Address_Name']. "</h4>";
							}							
						} else {
							//If the member id doesn't matche a user in our database
							// Display an error message and the login form
							echo "No Properties";
						}
						}  */
						else {
							echo "failed to prepare the SQL";
						}
				 }
				 }
				?> 
			
				
				</form>
				</div>
				</div>
				</div>
				
				<!--				
				<br>
				<input class="btn btn-default" type='submit' id='dmBtn' name='dmBtn' value='Delete Member' />
							
			</div>
			</div>
				
					<div class="col-md-4 col-md-offset-0">
					<div class="well">
					<h2>Member Details<h2>
					 <form name='search' id='search' action='adminHome.php' method='get'>
						
						<?php
					
					/* if(isset($_POST['searchBtn'])){
 
					
					include_once 'config/connection.php'; 
					
					
						$query = "SELECT * FROM booking join property using (property_id) WHERE Booking.Member_ID=?";
						
						if($stmt = $con->prepare($query))
						{ */
						
					/* 	$stmt->bind_Param("i", $_POST['member_id']);
					
						 
						$stmt->execute();
						
						$result = $stmt->get_result();
						
						
						$num = $result->num_rows;
						
						echo "<h3>Property Data</h3>";
						if($num>0){
							
							while($myrow = $result->fetch_assoc()){
							echo "<h4>" .$myrow['Address_Number']."  " .$myrow['Address_Name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$myrow['StartDate']. "</h4>";
							}	
						}
						
						echo "<h3>Host Data</h3>";
						if($num>0){
							
							while($myrow = $result->fetch_assoc()){
							echo "<h4>" .$myrow['Address_Name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$myrow['StartDate']. "</h4>";
							}	
						}


						
						echo "<h3>Consumer Data</h3>";
						if($num>0){
							
							while($myrow = $result->fetch_assoc()){
							echo "<h4>" .$myrow['StartDate']. "</h4>";
							}	
						} 
						
						}
					} */
						?> 
					
						
					</fieldset>
					</form>
					</div>
					</div>
			</div>
			</div>-->


<?php include 'footer.php';?>
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
 
 
 
 <?php //include 'navigation.php'; ?>
 
 <?php
 if(isset($_SESSION['member_id'])){
 include_once 'config/connection.php'; 
 $query = "SELECT Address_Number, Address_Name, Address_Postal from property WHERE Member_ID = ?";
 $stmt = $con ->prepare($query); 
 $stmt->bind_Param("i", $_SESSION['member_id']);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result-> num_rows >0){
	
$myrow = $result->fetch_assoc();

 }
 else {echo "No Properties";
 }
 }
 ?>

 <?php if(isset($_SESSION['addBtn'])){
	header("Location: register.php"); 
	die();
 }
 ?>
 
 
 
 <div class="register-page">
			<h1>Manage Properties</h1>
				
				<div class="row">
				<div class="col-md-4">
				<div class="well">
				<h2>Properties</h2>
				 
				<?php while($myrow = $result->fetch_assoc()){
				
				echo "<h3>" + $myrow['Address_Number']+ " " + $myrow['Address_Name'] + "</h3>";
				}
				?>
				<br>				
				<input class="btn btn-default" type='submit' id='addBtn' name='addBtn' value='Add Property' /> 
				</div>
				</div>
				</div>
</div>

<?php include 'footer.php';?>		
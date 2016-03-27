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
 <?php 
 $id = $_GET["id"];

 ?>
   
 <?php include 'navigation.php'; ?>
 
 <div class="register-page">
	<br>
 
	<div class="row">
	<div class="col-md-4">
	<div class="well">
	<h2>Booking</h2>
	 <form name='consumerbooking' id='consumerbooking' action='ConsumerEditBooking.php?id=<?=$id?>' method='post'>
 
 <?php
  if(isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
 $query = "SELECT * FROM booking join property using (Property_ID) WHERE Booking_ID='".$id."'";
 $stmt = $con ->prepare($query); 
 $stmt->execute();
 $result = $stmt->get_result();
  $myrow = $result->fetch_assoc();
  $addnum = $myrow['Address_Number'];
  $addname = $myrow['Address_Name'];
  $propertyid = $myrow['Property_ID'];
  
  if($result-> num_rows >0){
	  echo "<h3> $addnum $addname</h3>";
  }
  else {echo "No Bookings";
	}
	
  }
  
  ?>
 
 <?php
  if(isset($_POST['deleteBtn'])){
	  include_once 'config/connection.php'; 
	
	$query = "DELETE FROM booking WHERE Booking_ID='".$id."'";
	if($stmt = $con->prepare($query)){
		
		$stmt->execute();
		header("Location: bookings.php");
		die();
	}
	else{
		echo "Unable to update record";
        }	
			
 } 
 ?>
 <?php
  if(isset($_POST['commentBtn'])){
	include_once 'config/connection.php'; 

	$query = "INSERT INTO comment(Member_ID, Property_ID, Rating, Date, Time, Text) VALUES (?,?,?,?,?,?)";
	if($stmt = $con ->prepare($query)) {
		$stmt->bind_Param("iiiiis", $_SESSION['member_id'], $_POST[$propertyid], $_POST['rating'], $_POST['comment']);
		$stmt->execute();
		
	//How do we insert the property_id? and what do we do about member_id (get from login?)
	
	header("Location: index.php");
	die();
	}
	else{
		echo "insert query failed";
	} 
	
 }
 
?>
 
 <label>Comment</label>
 <input class="form-control" type='text' name='comment' id='comment'/>
 <br>
 
 <div class="form-group">     
	<label>Rating:
		<select name="district" >
			<option value="">Select One..</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
	</label>
</div>	   
 
 <input class="btn btn-default" type='submit' id='commentBtn' name='commentBtn' value='Add Comment' />
 <br>
 <br>
 <input class="btn btn-default" type='submit' id='deleteBtn' name='deleteBtn' value='Delete Booking' />
 </form>
 </div>
 </div>
 </div>
 </div>
 
 <?php include 'footer.php';?>	
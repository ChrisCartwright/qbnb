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
	
<h1>Edit Bookings</h1>

<div class="row">
<div class="col-md-4">
<div class="well">

<h2>Booking Status</h2>
<style>
	table, th, td {
	border: 1px solid black;
	padding: 10px;
	}
</style>

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
  $start = $myrow['StartDate'];
  $end = $myrow['EndDate'];
  $propertyid = $myrow['Property_ID'];
  $status = $myrow['Status'];
  
  
  
  if($result-> num_rows >0){
	  echo "<table>";
	  echo "<tr>";
	  echo "<th><h4>Address</h4></th>";
	  echo "<th><h4>Start Date</h4></th>";
	  echo "<th><h4>End Date</h4></th>";
	  echo "</tr>";
	  echo "<tr>";
      echo"<td>".$myrow['Address_Number']." " .$myrow['Address_Name']."</td>";
	  echo"<td>".$myrow['StartDate']."</td>";
	  echo"<td>".$myrow['EndDate']."</td>";
	  echo "</tr>"; 
	  echo "</table>";
	  
  }
  else {echo "No Bookings";
	}
	
  }
  
  ?>
  <?php
  if(isset($_POST['statusBtn'])){
	  $status = $_POST['status'];
	  $query = "UPDATE booking SET Status= '$status' WHERE Booking_ID='".$id."'";
	  $stmt = $con->prepare($query); 
	
	// Execute the query
        if($stmt->execute()){
			
			Header("Location: property.php");
			
        } 
		else{
			
            echo "Unable to update record";
        }	 
  } 
  ?>


  

 <?php if($result-> num_rows >0): ?>

<form name='statusform' id='statusform' action='editbookings.php?id=<?=$id?>' method='post'>

<br>
<div class="form-group">     
	<label>Status:
		<select name="status" required="true">
			<option value="0" <?php if ($status == 0) echo 'selected="selected"';?>>Requested</option>
			<option value="1" <?php if ($status == 1) echo 'selected="selected"';?>>Confirm</option>
			<option value="2" <?php if ($status == 2) echo 'selected="selected"';?>>Rejected</option>
		</select>
	</label>
</div>	   

<input class="btn btn-default" type='submit' id='statusBtn' name='statusBtn' value='Submit' /> 
</form>

</div>
</div>
<?php else: ?>
<?php endif; ?>
 

</div>
</div>
 
 
 <?php include 'footer.php';?>
 
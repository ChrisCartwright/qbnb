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

  

 <?php if($result-> num_rows >0): ?>

<form name='status' id='status' action='editbookings.php?id=<?=$id?>' method='post'>

<br>
<div class="form-group">     
	<label>Status:
		<select name="district" required="true">
			<option value="">Select...</option>
			<option value="1">Confirm</option>
			<option value="2">Rejected</option>
		</select>
	</label>
</div>	   

<input class="btn btn-default" type='submit' id='statusBtn' name='statusBtn' value='Submit' /> 
</form>

</div>
</div>
<?php else: ?>
<?php endif; ?>
 
<!--<div class="col-md-4 col-md-offset-2">
<div class="well">
<h2>Reply to a Comment</h2>

<?php /* if(isset($_SESSION['member_id'])){
	include_once 'config/connection.php'; 
	$query = "SELECT * from comment join property using (Property_ID) WHERE Booking_ID='".$id."'";
	$stmt = $con ->prepare($query); 
	//$stmt->bind_Param("i", $_SESSION['member_id']);
	$stmt->execute();
							
				
	$result = $stmt->get_result();
		
		if($result-> num_rows >0){
			echo "<table>";
			echo "<tr>";
			echo "<th><h3>Address</h3></th>";
			echo "<th><h3>Comment</h3></th>";
			echo "<th><h3>Rating</h3></th>";
			echo "</tr>";
					
			while($myrow = $result->fetch_assoc()){
								
			echo "<tr>";
            echo"<td>".$myrow['Address_Number']." " .$myrow['Address_Name']."</td>";
			echo"<td>".$myrow['text']."</td>";
			echo"<td>".$myrow['rating']."</td>";
			//echo "<td><a href='ConsumerEditBooking.php?id=" . $myrow['Booking_ID'] . "'>Delete/Add Comment</a></td>";
			echo "</tr>"; 
					
										
			}
			echo "</table>";
			
			}
			else {echo "No Bookings";
				}
				} */
										
				?>
				 </table>

</div>
</div>-->


</div>
</div>
 
 
 <?php include 'footer.php';?>
 
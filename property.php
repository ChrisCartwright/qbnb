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
 $query = "SELECT COUNT(Property_ID) as Count from property WHERE Member_ID = ?";
 $stmt = $con ->prepare($query); 
 $stmt->bind_Param("i", $_SESSION['member_id']);
 $stmt->execute();
 $result = $stmt->get_result();
 
 $myrow = $result->fetch_assoc();
 echo $myrow['Count'];
 
 
 }
 ?>
 
 
 <div class="register-page">
			<h1>Manage Properties</h1>
				
				<div class="row">
				<div class="col-md-4">
				<div class="well">
				<h2>Properties</h2>
				<br>
				 
				<?php if(isset($_SESSION['member_id'])){
				include_once 'config/connection.php'; 
				$query = "SELECT Property_ID, Address_Number, Address_Name, Address_Postal from property WHERE Member_ID = ?";
				$stmt = $con ->prepare($query); 
				$stmt->bind_Param("i", $_SESSION['member_id']);
				$stmt->execute();
				$result = $stmt->get_result();
				
				
				if($result-> num_rows >0){
					
					while($myrow = $result->fetch_assoc()){
					
					echo "<h3>" .$myrow['Address_Number']." " .$myrow['Address_Name']. "</h3>";
					
					$property= $myrow['Property_ID'];
					
					echo "<a href='EditProperty.php?id=" . $myrow['Property_ID'] . "'>Edit/Delete</a>";
					
					
				}
				
				}
				else {echo "No Properties";
				}
				}
										
				?>
							
				<br>
				<br>
				
				<input class="btn btn-default" type='button' id='addBtn' name='addBtn' value='Add Property' onClick="document.location.href='register.php';"/>
				
				</div>
				</div>
				
							
				<div class="col-md-4 col-md-offset-2">
				<div class="well">
				<h2>View Bookings on Properties</h2>
				
				<br>
				<style>
				table, th, td {
				border: 1px solid black;
				}
				</style>
				
				
				<?php if(isset($_SESSION['member_id'])){
				include_once 'config/connection.php'; 
				$query = "SELECT Booking_ID, StartDate, EndDate, Status, Address_Name, Address_Number from property join booking using (Property_ID) WHERE property.Member_ID = ?";
				$stmt = $con ->prepare($query); 
				$stmt->bind_Param("i", $_SESSION['member_id']);
				$stmt->execute();
							
				
				$result = $stmt->get_result();
				
				if($result-> num_rows >0){
					echo "<table>";
					echo "<tr>";
					echo "<th><h3>Address</h3></th>";
					echo "<th><h3>Start Date</h3></th>";
					echo "<th><h3>End Date</h3></th>";
					echo "<th><h3>Edit</h3></th>";
					echo "</tr>";
					
					while($myrow = $result->fetch_assoc()){
					
					
					
					echo "<tr>";
                   	echo"<td>".$myrow['Address_Number']." " .$myrow['Address_Name']."</td>";
					echo"<td>".$myrow['StartDate']."</td>";
					echo"<td>".$myrow['EndDate']."</td>";
					echo "<td><a href='editbookings.php?id=" . $myrow['Booking_ID'] . "'>Edit</a></td>";
					echo "</tr>"; 
					
					
					
										
				}
				    echo "</table>";
				
				}
				else {echo "No Bookings";
				}
				}
										
				?>
				
				
				</div>
				</div>
				</div>
</div>




<?php include 'footer.php';?>		
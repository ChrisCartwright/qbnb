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
 $id = $_GET["id"];   

  ?>
  
 <?php include 'navigation.php'; ?>
 
  <?php
  if(isset($_POST['deleteBtn'])){
	  include_once 'config/connection.php'; 
	
	$query = "DELETE FROM member WHERE Member_ID= '".$id."'";
	$stmt = $con->prepare($query);
	if($stmt->execute()){
	
		header("Location: adminHome.php");
		die();
	}
	else{
		echo "Unable to update record";
        }	
			
 } 
 ?>
 
 
 <div class="register-page">
			<h1>Member Management</h1>
				
				<div class="row">
				<div class="col-md-4">
				<div class="well">
				<h2>Member</h2>
				<form name='memberdelete' id='memberdelete' action='admineditmember.php?id=<?=$id?>' method='post'>	
				
				<?php if(isset($_SESSION['admin_id'])){
				include_once 'config/connection.php'; 
				$query = "SELECT FName, LName from member WHERE Member_ID = '".$id."'";
				$stmt = $con ->prepare($query); 
				
				$stmt->execute();
				$result = $stmt->get_result();
				
				
				if($result-> num_rows >0){
					
					while($myrow = $result->fetch_assoc()){
					
					echo "<h3>" .$myrow['FName']." " .$myrow['LName']. "</h3>";		
					
				}
				
				}
				else {echo "No Member";
				}
				}
										
				?>
				 <input class="btn btn-default" type='submit' id='deleteBtn' name='deleteBtn' value='Delete Membership' /> 
				</form>
				</div>
				</div>
				
						
				<div class="col-md-4 col-md-offset-0">
				<div class="well">
				<h2>View Member's Bookings</h2>
				<br>
				<style>
				table, th, td {
				border: 1px solid black;
				padding: 10px;
				}
				</style>
				
				

				<?php 
				include_once 'config/connection.php'; 
				$query = "SELECT Booking_ID, StartDate, EndDate, Status, Address_Name, Address_Number from property join booking using (Property_ID) WHERE booking.Member_ID = '".$id."'";
				$stmt = $con ->prepare($query); 
				
				$stmt->execute();
							
				
				$result = $stmt->get_result();
				
				if($result-> num_rows >0){
					echo "<table>";
					echo "<tr>";
					echo "<th><h3>Address</h3></th>";
					echo "<th><h3>Start Date</h3></th>";
					echo "<th><h3>End Date</h3></th>";
					echo "</tr>";
					
					while($myrow = $result->fetch_assoc()){
					
					
					echo "<tr>";
                   	echo"<td>".$myrow['Address_Number']." " .$myrow['Address_Name']."</td>";
					echo"<td>".$myrow['StartDate']."</td>";
					echo"<td>".$myrow['EndDate']."</td>";
					echo "</tr>"; 
					
										
				}
					echo "</table>";
				
				}
				else {echo "No Bookings";
				}
				
										
				?>
				 </table>
				 
				 </div>
				 </div>
				 
				 
				 <div class="col-md-4 col-md-offset-0">
				<div class="well">
				<h2>Member's Ratings</h2>
				<br>
				<style>
				table, th, td {
				border: 1px solid black;
				padding: 10px;
				}
				</style>
				
				

				<?php 
				include_once 'config/connection.php'; 
				$query = "SELECT Property_ID from property where Member_ID = '".$id."'";
				$stmt = $con ->prepare($query); 
				
				$stmt->execute();
							
				
				$result = $stmt->get_result();
				
				if($result-> num_rows >0){
				$query = "SELECT Rating from comment join property using (Property_ID) WHERE property.Member_ID = '".$id."'";
				$stmt = $con ->prepare($query); 
				
				
				$stmt->execute();
							
				
				$result = $stmt->get_result();
				
				if($result-> num_rows >0){
					echo "<table>";
					echo "<tr>";
					
					echo "<th><h3>Ratings</h3></th>";
					
					echo "</tr>";
					
					while($myrow = $result->fetch_assoc()){
					
					
					echo "<tr>";
                   	
					echo"<td>".$myrow['Rating']."</td>";
					
					echo "</tr>"; 
					
										
				}
					echo "</table>";
				$query = "SELECT AVG(Rating) as average from comment join property using (Property_ID) WHERE property.Member_ID = '".$id."'";
				$stmt = $con ->prepare($query); 
				
				$stmt->execute();
							
				$result = $stmt->get_result();
				$myrow = $result->fetch_assoc();
				echo "<h2>Average Rating: " .$myrow['average']."</h2>";
				
				}
				else {echo "No Bookings";
				}
				}
				else{
					echo "Not a supplier";
				}
										
				?>
				 </table>
				 
				 </div>
				 </div>
			</div>
			
				
</div>
 
 <?php include 'footer.php';?>	
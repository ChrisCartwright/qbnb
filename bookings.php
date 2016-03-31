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
 <div class="register-page">
			<h1>Manage Bookings</h1>
				
				<div class="row">
				<div class="col-md-7">
				<div class="well">
				<h2>View My Bookings</h2>
				<br>
				<style>
				table, th, td {
				border: 1px solid black;
				padding: 10px;
				}
				</style>
				
				

				<?php if(isset($_SESSION['member_id'])){
				include_once 'config/connection.php'; 
				$query = "SELECT Booking_ID, StartDate, EndDate, Status, Address_Name, Address_Number from property join booking using (Property_ID) WHERE booking.Member_ID = ?";
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
					echo "<th><h3>Status</h3></th>";
					echo "<th><h3>Edit</h3></th>";
					echo "</tr>";
					
					while($myrow = $result->fetch_assoc()){
						if($myrow['Status'] == 0) 
							$status = "Requested";
						elseif($myrow['Status'] == 1) 
							$status = "Confirmed";
						else 
							$status = "Rejected";
					
					
					echo "<tr>";
                   	echo"<td>".$myrow['Address_Number']." " .$myrow['Address_Name']."</td>";
					echo"<td>".$myrow['StartDate']."</td>";
					echo"<td>".$myrow['EndDate']."</td>";
					echo"<td>".$status."</td>";
					echo "<td><a href='ConsumerEditBooking.php?id=" . $myrow['Booking_ID'] . "'>Delete/Add Comment</a></td>";
					echo "</tr>"; 
					
										
				}
					echo "</table>";
				
				}
				else {echo "No Bookings";
				}
				}
										
				?>
				 </table>
				 
				 </div>
				 </div>
				</div>
 
 
 <?php include 'footer.php';?>	
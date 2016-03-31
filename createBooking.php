

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

 <?php
 //check if the user is already logged in and has an active session
if(!isset($_SESSION['member_id'])){
	//Redirect the browser to the profile editing page and kill this page.
	header("Location: login.php?id=".$id);
	die();
}
 ?>

 

 <?php include 'navigation.php'; ?>

 <?php
 if(isset($_SESSION['member_id'])){
	 include_once 'config/connection.php'; 
	 $query = "SELECT * from property join district using (District_ID) WHERE Property_ID = ?";
	 $stmt = $con ->prepare($query); 
	 $stmt->bind_Param("i", $id);
	 $stmt->execute();
	 $result = $stmt->get_result();
	 
 
 }
 ?>
<?php
 if(isset($_POST['bookBtn'])){
	include_once 'config/connection.php'; 

	 
	$query = "INSERT INTO booking (Member_ID, Property_ID, StartDate, EndDate, Status) VALUES (?,?,?,?,0)";

	if($stmt = $con ->prepare($query)) {
		$stmt->bind_Param("iiss", $_SESSION['member_id'], $id, $_POST['start'], $_POST['end']);
		if($stmt->execute()) {
			header("Location: bookings.php");
			die();
		}
		else {
			echo "query failed";
		}
 	}
 }

 ?>

<div class="register-page">
	
<h1>Make a Reservation</h1>

<div class="well">
	<div class="row">
		<div class="col-md-4">
			<form name='makebooking' id='makebooking' action='createBooking.php?id=<?=$id?>' method='post'>
				<div class="form-group">
				<label>Start Date</label>
				<input class="form-control" type='date' name='start' id='start'/>
				<label>End Date</label>
				<input class="form-control" type='date' name='end' id='end' />
				</div>
				<input class="btn btn-default" type='submit' id='bookBtn' name='bookBtn' value='Reserve' /> 
			</form>
		</div>
		<div class="col-md-8">
			<?php
				while($myrow = $result->fetch_assoc()) {
 			if($myrow["Pool"] == 1) {
 				$pool = 'Yes';
 			}
 			else {
 				$pool = 'No';
 			}
 			if($myrow["Laundry"] == 1) {
 				$laundry = 'Yes';
 			}
 			else {
 				$laundry = 'No';
 			}
 			if($myrow["Internet"] == 1) {
 				$internet = 'Yes';
 			}
 			else {
 				$internet = 'No';
 			}
 			if($myrow["Parking"] == 1) {
 				$parking = 'Yes';
 			}
 			else {
 				$parking = 'No';
 			}
 			if($myrow["AC"] == 1) {
 				$ac = 'Yes';
 			}
 			else {
 				$ac = 'No';
 			}
 			if($myrow["Heat"] == 1) {
 				$heat = 'Yes';
 			}
 			else {
 				$heat = 'No';
 			}
 			if($myrow["Gym"] == 1) {
 				$gym = 'Yes';
 			}
 			else {
 				$gym = 'No';
 			}
 			if($myrow["Pets"] == 1) {
 				$pets = 'Allowed';
 			}
 			else {
 				$pets = 'Not Allowed';
 			}
 			if($myrow["Smoking"] == 1) {
 				$smoking = 'Yes';
 			}
 			else {
 				$smoking = 'No';
 			}
 			if($myrow["Wheelchair"] == 1) {
 				$wheelchair = 'Yes';
 			}
 			else {
 				$wheelchair = 'No';
 			}

 			echo '		<div class="col-md-3">
 							<h3>' . $myrow["Address_Number"] . ' ' . $myrow["Address_Name"] . '</h3>
							<h4>Price/week: ' . $myrow["Price"] . '</h4>
							<p>Postal Code: ' . $myrow["Address_Postal"] . '</p>
							<p>District: ' . $myrow["Name"] . '</p>
						</div>
						<div class="col-md-3" style="text-align: right">
							<p>Type: ' . $myrow["Type"] . '</p>
							<p>Number of Bedrooms: ' . $myrow["Bedroom"] . '</p>
							<p>Number of Bathrooms: ' . $myrow["Bathroom"] . '</p>
							<p>Internet: ' . $internet . '</p>
							<p>Wheelchair Accessible: ' . $wheelchair . '</p>
							
						</div>
						<div class="col-md-3" style="text-align: right">
							<p>Parking: ' . $parking . '</p>
							<p>Laundry: ' . $laundry . '</p>
							<p>Pool: ' . $pool . '</p>
							<p>Pets: ' . $pets . '</p>
						</div>
						<div class="col-md-3" style="text-align: right">
							<p>Heat: ' . $heat . '</p>
							<p>A/C: ' . $ac . '</p>
							<p>Gym: ' . $gym . '</p>
							<p>Smoking: ' . $smoking . '</p>'
				;
		}
			?>

		</div>
	</div>
</div>

	
</div>


<?php include 'footer.php';?>


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
	
<h1>Search Accomadations</h1>

<div class="row">
<div class="col-md-4">
<div class="well">
<h2 style="text-align: center">Search Details</h2>

<form name='searchproperty' id='searchproperty' action='search.php' method='post'>
	
	
	<div class="form-group">
			<label>Price Per Week</label>
			<input class="form-control" type='number' name='price' id='price' placeholder='Maximum'/>
	</div>			        
				            
	 <div class="form-group">     
			<label>District:
				<select name="district">
					<option value="">Select...</option>
					<option value="1">Central</option>
					<option value="2">East End</option>
					<option value="3">South End</option>
					<option value="4">West End</option>
				</select>
			</label>
	</div>	   
			
			
	 <div class="form-group">
			<label>Type:
				<select name="type">
					<option value="">Select...</option>
					<option value="Single">Single</option>
					<option value="Duplex">Duplex</option>
					<option value="Apartment">Apartment</option>
				</select>
			</label>
	</div>	   
			
	<div class="form-group">
			<label>Bedroom(s)</label>
			<input class="form-control" type='number' name='bedroom' id='bedroom' placeholder='2' />
	</div>	
	
	<div class="form-group">
			<label>Bathroom(s)</label>
			<input class="form-control" type='number' name='bathroom' id='bathroom' placeholder='2' />
	</div>

	<div class="form-group">
			<label>Pool:
				<select name="Pool">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	<div class="form-group">
			<label>Laundry:
				<select name="Laundry">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	 <div class="form-group">
			<label>Internet:
				<select name="Internet">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	<div class="form-group">
			<label>Parking:
				<select name="Parking">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	<div class="form-group">
			<label>Heat:
				<select name="Heat">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	

	<div class="form-group">
			<label>AC:
				<select name="AC">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	<div class="form-group">
			<label>Smoking:
				<select name="Smoking">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	<div class="form-group">
			<label>Wheelchair:
				<select name="Wheelchair">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	

	<div class="form-group">
			<label>Gym:
				<select name="Gym">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
	
	<div class="form-group">
			<label>Pets:
				<select name="Pets">
					<option value="">Select...</option>
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
			</label>
	</div>	
		
	

	<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Search' /> 


</form>
</div>
</div>
<div class="col-md-8">
	<?php
  if(isset($_POST['searchBtn'])){
	include_once 'config/connection.php'; 

	/*$query = "SELECT * FROM property WHERE Price LIKE '%" . $_POST['price'] . "%' AND District_ID LIKE '%" . $_POST['district'] . "%' AND Type LIKE '%" . $_POST['type'] . "%' AND Bedroom LIKE '%" . $_POST['bedroom'] . "%' AND Bathroom LIKE '%" . $_POST['bathroom'] . "%' AND Pool LIKE '%" . $_POST['Pool'] . "%' AND Laundry LIKE '%" . $_POST['Laundry'] . "%' AND Internet LIKE '%" . $_POST['Internet'] . "%' AND Parking LIKE '%" . $_POST['Parking'] . "%' AND AC LIKE '%" . $_POST['AC'] . "%' AND Heat LIKE '%" . $_POST['Heat'] . "%' AND Gym LIKE '%" . $_POST['Gym'] . "%' AND Pets LIKE '%" . $_POST['Pets'] . "%' AND Smoking LIKE '%" . $_POST['Smoking'] . "%' AND Wheelchair LIKE '%" . $_POST['Wheelchair'] . "%' "; */


	 
	$query = "SELECT * FROM property JOIN district using (District_ID) WHERE Price LIKE '%" . $_POST['price'] . "%' AND District_ID LIKE '%" . $_POST['district'] . "%' AND Type LIKE '%" . $_POST['type'] . "%' AND Bedroom LIKE '%" . $_POST['bedroom'] . "%' AND Bathroom LIKE '%" . $_POST['bathroom'] . "%' AND Pool LIKE '%" . $_POST['Pool'] . "%' AND Laundry LIKE '%" . $_POST['Laundry'] . "%' AND Internet LIKE '%" . $_POST['Internet'] . "%' AND Parking LIKE '%" . $_POST['Parking'] . "%' AND AC LIKE '%" . $_POST['AC'] . "%' AND Heat LIKE '%" . $_POST['Heat'] . "%' AND Gym LIKE '%" . $_POST['Gym'] . "%' AND Pets LIKE '%" . $_POST['Pets'] . "%' AND Smoking LIKE '%" . $_POST['Smoking'] . "%' AND Wheelchair LIKE '%" . $_POST['Wheelchair'] . "%'"; 


	if($stmt = $con ->prepare($query)) {
		$stmt->execute();
		$result = $stmt->get_result();
		$count = 0;
 		while($myrow = $result->fetch_assoc()) {
 			$count = $count + 1;
 			$commentQuery = "SELECT * FROM comment WHERE comment.Property_ID =" . $myrow["Property_ID"];
 			if($commentStmt = $con ->prepare($commentQuery)) {
				$commentStmt->execute();
				$commentResult = $commentStmt->get_result();
			}
			else {
				echo "get comments failed";
			}
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

 			echo '<div class="well">
					<div class="row">
						<div class="col-md-3">
							<h3>' . $myrow["Address_Number"] . ' ' . $myrow["Address_Name"] . '</h3>
							<h4>Price/week: ' . $myrow["Price"] . '</h4>
							<p>Postal Code: ' . $myrow["Address_Postal"] . '</p>
							<p>Availability: ' . $myrow["Name"] . '</p>
						</div>
						<div class="col-md-3" style="text-align: right">
							<p>District: ' . $myrow["Name"] . '</p>
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
							<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample'.$count.'" aria-expanded="false" aria-controls="collapseExample">
  								View Comments
							</button>
						</div>
						<div class="col-md-3" style="text-align: right">
							<p>Heat: ' . $heat . '</p>
							<p>A/C: ' . $ac . '</p>
							<p>Gym: ' . $gym . '</p>
							<p>Smoking: ' . $smoking . '</p>
							<a href=createBooking.php?id=' . $myrow['Property_ID'] . '><button class="btn btn-primary">Book!</button></a>
						</div>
					</div>
					<hr class="comment-divide">
					<div class="row">
						<div class="col-md-12">
							<div class="collapse" id="collapseExample'.$count.'">';
								while($commentRow = $commentResult->fetch_assoc()) {
									echo '
									<p>Rating: '.$commentRow["Rating"].' Stars</p>
	  								<p>Comment: '.$commentRow["Text"].'</p>
	  								<hr class="comment-divide">';
	  							}	
							echo '</div>
						</div>
					</div>
				</div>'
				;
		}

	}
	else{
		echo "query failed";
	}
	
 }
 
?>
</div>	
</div>
</div>


<?php include 'footer.php';?>


<?php include 'header.php'; ?>

<?php
  //Create a user session or resume an existing one
 session_start();
 ?>
 
 <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
	console.log("after logout in search");
	//Destroy the user's session.
	$_SESSION['member_id']=null;
	session_destroy();
}
 ?>

 <?php include 'navigation.php'; ?>
 
<?php
  if(isset($_POST['searchBtn'])){
	include_once 'config/connection.php'; 
	 if($_POST['bedroom'] > 0  ) {

	 	echo "<script>console.log('hello');</script>";
	 }
	$query = "SELECT * FROM property WHERE Price=? AND district_id=?";// AND type=? AND bedroom=? AND bathroom=? AND Pool=?";



	//(member_id, district_id, address, street_name, postal_code, type, price, bathroom, Pool, Laundry, Internet, Parking, AC, Heat, Gym, Pets, Smoking, Wheelchair, bedroom) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if($stmt = $con ->prepare($query)) {
		$stmt->bind_Param("ii", $_POST['price'], $_POST['district']);//, $_POST['type'], $_POST['bedroom'], $_POST['bathroom'], $_POST['Pool']);
		$stmt->execute();
		$result = $stmt->get_result();
 		$myrow = $result->fetch_assoc();
		echo $myrow['Type'];
	die();
	}
	else{
		echo "insert query failed";
	}
	
 }
 
?>
<div class="register-page">
	
<h1>Search Accomadations</h1>

<div class="row">
<div class="col-md-4">
<div class="well">
<h2 style="text-align: center">Search Details</h2>

<form name='searchproperty' id='searchproperty' action='search.php' method='post'>
	
	
	<div class="form-group">
			<label>Price Per Week</label>
		</br>
			<label>Minimum</label>
			<input class="form-control" type='number' name='price1' id='price1' placeholder='Minimum'/>
			<label>Maximum</label>
			<input class="form-control" type='number' name='price2' id='price2' placeholder='Maximum'/>
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
		
	

	<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Search' /> 


</form>
</div>
</div>
</div>
</div>


<?php include 'footer.php';?>
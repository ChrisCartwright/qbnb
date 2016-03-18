

<?php include 'header.php'; ?>
<?php include 'navigation.php'; ?>
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

 
 
<?php
  if(isset($_POST['searchBtn'])){
	include_once 'config/connection.php'; 
	 
	 console.log("hheklo");
	/*$query = "INSERT INTO property (member_id, district_id, address, street_name, postal_code, type, price, bathroom, Pool, Laundry, Internet, Parking, AC, Heat, Gym, Pets, Smoking, Wheelchair, bedroom) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if($stmt = $con ->prepare($query)) {
		$stmt->bind_Param("issiisiiiiiiiiiii", $_SESSION['member_id'], $_POST['district'], $_POST['address'], $_POST['street_name'], $_POST['postal_code'], $_POST['type'], $_POST['price'], $_POST['bathroom'], $_POST['Pool'], $_POST['Laundry'], $_POST['Internet'], $_POST['Parking'], $_POST['AC'], $_POST['Heat'], $_POST['Gym'], $_POST['Pets'], $_POST['Smoking'], $_POST['Wheelchair'], $_POST['bedroom']);
		$stmt->execute();
		
	//How do we insert the property_id? and what do we do about member_id (get from login?)
	
	header("Location: index.php");
	die();
	}
	else{
		echo "insert query failed";
	} */
	
 }
 
?>
<div class="register-page">
	
<h1>Search Accomadations</h1>

<div class="row">
<div class="col-md-4">
<div class="well">
<h2 style="text-align: center">Search Details</h2>

<form name='registerproperty' id='registerproperty' action='register.php' method='post'>
	
	
	<div class="form-group">
			<label>Price Per Week</label>
			<input class="form-control" type='number' name='price' id='price' placeholder='200'/>
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
			<input type="radio" name="Pool"
			<?php if (isset($Pool) && $Pool=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Pool"
		<?php if (isset($Pool) && $Pool=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Laundry:
			<input type="radio" name="Laundry"
			<?php if (isset($Laundry) && $Laundry=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Laundry"
		<?php if (isset($Laundry) && $Laundry=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	 <div class="form-group">
		<label>Internet:
			<input type="radio" name="Internet"
			<?php if (isset($Internet) && $Internet=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Internet"
		<?php if (isset($Internet) && $Internet=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Parking:
			<input type="radio" name="Parking"
			<?php if (isset($Parking) && $Parking=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Parking"
		<?php if (isset($Parking) && $Parking=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Heat:
			<input type="radio" name="Heat"
			<?php if (isset($Heat) && $Heat=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Heat"
		<?php if (isset($Heat) && $Heat=="No") echo "checked";?>
		value="0">No
		</label>
	</div>

	<div class="form-group">
		<label>AC:
			<input type="radio" name="AC"
			<?php if (isset($AC) && $AC=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="AC"
		<?php if (isset($AC) && $AC="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Smoking:
			<input type="radio" name="Smoking"
			<?php if (isset($Smoking) && $Smoking=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Smoking"
		<?php if (isset($Smoking) && $Smoking=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Wheelchair:
			<input type="radio" name="Wheelchair"
			<?php if (isset($Wheelchair) && $Wheelchair=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Wheelchair"
		<?php if (isset($Wheelchair) && $Wheelchair=="No") echo "checked";?>
		value="0">No
		</label>
	</div>

	<div class="form-group">
		<label>Gym:
			<input type="radio" name="Gym"
			<?php if (isset($Gym) && $Gym=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Gym"
		<?php if (isset($Gym) && $Gym=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Pets:
			<input type="radio" name="Pets"
			<?php if (isset($Pets) && $Pets=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Pets"
		<?php if (isset($Pets) && $Pets=="No") echo "checked";?>
		value="0">No
		</label>
	</div>

	<input class="btn btn-default" type='submit' id='searchBtn' name='searchBtn' value='Search' /> 


</form>
</div>
</div>
</div>
</div>


<?php include 'footer.php';?>
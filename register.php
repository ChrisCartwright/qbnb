

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
 //check if the user is already logged in and has an active session


if(!isset($_SESSION['member_id'])){
	//Redirect the browser to the profile editing page and kill this page.
	
	header("Location: login.php");

	die();

}
?>
 
 
<?php
  if(isset($_POST['registerBtn'])){
	include_once 'config/connection.php'; 

	$query = "INSERT INTO property (Member_ID, District_ID, Address_Number, Address_Name, Address_Postal, Type, Price, Bathroom, Pool, Laundry, Internet, Parking, AC, Heat, Gym, Pets, Smoking, Wheelchair, Bedroom) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	if($stmt = $con ->prepare($query)) {
		$stmt->bind_Param("iiisssiiiiiiiiiiiii", $_SESSION['member_id'], $_POST['district'], $_POST['address'], $_POST['street_name'], $_POST['postal_code'], $_POST['type'], $_POST['price'], $_POST['bathroom'], $_POST['Pool'], $_POST['Laundry'], $_POST['Internet'], $_POST['Parking'], $_POST['AC'], $_POST['Heat'], $_POST['Gym'], $_POST['Pets'], $_POST['Smoking'], $_POST['Wheelchair'], $_POST['bedroom']);
		$stmt->execute();
		
	
	header("Location: property.php");
	die();
	}
	else{
		echo "insert query failed";
	} 
	
 }
 
?>
<div class="register-page">
	
<h1>Register A Property</h1>
<div class="well">
<div class="row">
<div class="col-md-4 col-md-offset-4">

<h2 style="text-align: center">Property Details</h2>

<form name='registerproperty' id='registerproperty' action='register.php' method='post'>
	<div class="form-group">
			<label>Address</label>
			<input class="form-control" type='text' name='address' id='address' placeholder='200' required="true"/>
	</div>
	<div class="form-group">
			<label>Street Name</label>
			<input class="form-control" type='text' name='street_name' id='street_name' placeholder='University' required="true"/>
	</div>
				    
	<div class="form-group">
			<label>Postal Code</label>
			<input class="form-control" type='text' name='postal_code' id='postal_code' placeholder='KT1 1R4' required="true"/>
	</div>
	
	<div class="form-group">
			<label>Price Per Week</label>
			<input class="form-control" type='number' name='price' id='price' placeholder='200' required="true"/>
	</div>			        
				            
	 <div class="form-group">     
			<label>District:
				<select name="district" required="true">
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
				<select name="type" required="true">
					<option value="">Select...</option>
					<option value="Single">Single</option>
					<option value="Duplex">Duplex</option>
					<option value="Apartment">Apartment</option>
				</select>
			</label>
	</div>	   
			
	<div class="form-group">
			<label>Bedroom(s)</label>
			<input class="form-control" type='number' name='bedroom' id='bedroom' placeholder='2' required="true"/>
	</div>	
	
	<div class="form-group">
			<label>Bathroom(s)</label>
			<input class="form-control" type='number' name='bathroom' id='bathroom' placeholder='2' required="true"/>
	</div>
		
	<div class="form-group">
		<label>Pool:
			<input type="radio" name="Pool" required="true"
			<?php if (isset($Pool) && $Pool=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Pool" required="true"
		<?php if (isset($Pool) && $Pool=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Laundry:
			<input type="radio" name="Laundry" required="true"
			<?php if (isset($Laundry) && $Laundry=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Laundry" required="true"
		<?php if (isset($Laundry) && $Laundry=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	 <div class="form-group">
		<label>Internet:
			<input type="radio" name="Internet" required="true"
			<?php if (isset($Internet) && $Internet=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Internet" required="true"
		<?php if (isset($Internet) && $Internet=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Parking:
			<input type="radio" name="Parking" required="true"
			<?php if (isset($Parking) && $Parking=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Parking" required="true"
		<?php if (isset($Parking) && $Parking=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Heat:
			<input type="radio" name="Heat" required="true"
			<?php if (isset($Heat) && $Heat=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Heat" required="true"
		<?php if (isset($Heat) && $Heat=="No") echo "checked";?>
		value="0">No
		</label>
	</div>

	<div class="form-group">
		<label>AC:
			<input type="radio" name="AC" required="true"
			<?php if (isset($AC) && $AC=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="AC" required="true"
		<?php if (isset($AC) && $AC="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Smoking:
			<input type="radio" name="Smoking" required="true"
			<?php if (isset($Smoking) && $Smoking=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Smoking" required="true"
		<?php if (isset($Smoking) && $Smoking=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Wheelchair: 
			<input type="radio" name="Wheelchair" required="true"
			<?php if (isset($Wheelchair) && $Wheelchair=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Wheelchair" required="true"
		<?php if (isset($Wheelchair) && $Wheelchair=="No") echo "checked";?>
		value="0">No
		</label>
	</div>

	<div class="form-group">
		<label>Gym:
			<input type="radio" name="Gym" required="true"
			<?php if (isset($Gym) && $Gym=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Gym" required="true"
		<?php if (isset($Gym) && $Gym=="No") echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Pets:
			<input type="radio" name="Pets" required="true"
			<?php if (isset($Pets) && $Pets=="Yes") echo "checked";?>
			value="1">Yes
		<input type="radio" name="Pets" required="true"
		<?php if (isset($Pets) && $Pets=="No") echo "checked";?>
		value="0">No
		</label>
	</div>

	<input class="btn btn-default" type='submit' id='registerBtn' name='registerBtn' value='Submit' /> 


</form>
</div>
</div>
</div>
</div>


<?php include 'footer.php';?>
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
 
<?php
 
 if(isset($_SESSION['member_id'])){
  // include database connection
    include_once 'config/connection.php'; 
 $query = "SELECT * FROM property WHERE Property_ID='".$id."'";
 $stmt = $con ->prepare($query); 
 $stmt->execute();
 $result = $stmt->get_result();
  $myrow = $result->fetch_assoc();
 }
  
   else {
	 echo "Not logged in";
	header("Location: index.php");
	die();
	}
  
 // echo $property;
  $district = $myrow['District_ID'];
  $address = $myrow['Address_Number'];
  $street_name =$myrow['Address_Name'];
  $postal_code = $myrow['Address_Postal'];
  $type = $myrow['Type'];
  $price = $myrow['Price'];
  $bathroom = $myrow['Bathroom'];
  $Pool = $myrow['Pool'];
  $Laundry = $myrow['Laundry'];
  $Internet = $myrow['Internet'];
  $Parking = $myrow['Parking'];
  $AC = $myrow['AC'];
  $Heat = $myrow['Heat'];
  $Gym = $myrow['Gym'];
  $Pets = $myrow['Pets'];
  $Smoking = $myrow['Smoking'];
  $Wheelchair = $myrow['Wheelchair'];
  $bedroom = $myrow['Bedroom'];
  
  if($district == 1){
	  $districtname='Central';
  }
  elseif ($district == 2){
	  $districtname='East End';
  }
  elseif ($district == 3){
	  $districtname='South End';
  }
  else{
	  $districtname='West End';
  }
  
  
 ?>
	
<?php
	
	if(isset($_POST['updateBtn'])){
  
    include_once 'config/connection.php'; 
	
  $district = $_POST['district'];
  $address = $_POST['address'];
  $street_name =$_POST['street_name'];
  $postal_code = $_POST['postal_code'];
  $type = $_POST['type'];
  $price = $_POST['price'];
  $bathroom = $_POST['bathroom'];
  $Pool = $_POST['Pool'];
  $Laundry = $_POST['Laundry'];
  $Internet = $_POST['Internet'];
  $Parking = $_POST['Parking'];
  $AC = $_POST['AC'];
  $Heat = $_POST['Heat'];
  $Gym = $_POST['Gym'];
  $Pets = $_POST['Pets'];
  $Smoking = $_POST['Smoking'];
  $Wheelchair = $_POST['Wheelchair'];
  $bedroom = $_POST['bedroom'];
  $memid = $_SESSION['member_id'];
  echo $memid;
  
	$query = "UPDATE property SET District_ID = '$district', Address_Number= $address, Address_Name= '$street_name', Address_Postal='$postal_code', Type='$type', Price=$price, Bathroom=$bathroom, Pool=$Pool, Laundry=$Laundry, Internet=$Internet, Parking=$Parking, AC=$AC, Heat=$Heat, Gym=$Gym, Pets=$Pets, Smoking=$Smoking, Wheelchair=$Wheelchair, Bedroom=$bedroom WHERE Property_ID='".$id."'";
	//$query = "UPDATE property SET District_ID = '$district' WHERE Property_ID=6";  
	$stmt = $con->prepare($query); 
	//$stmt->bind_Param("i", $_SESSION['member_id']);
	// Execute the query
        if($stmt->execute()){
			
           header("Location: property.php");
		   
			die();
			$message = "wrong answer";
			echo "<script type='text/javascript'>alert('$message');</script>";
        } 
		else{
			
            echo "Unable to update record";
        }	 
   
 
	}
  
 ?>
 <?php
  if(isset($_POST['deleteBtn'])){
	  include_once 'config/connection.php'; 
	
	$query = "DELETE FROM property WHERE Property_ID='".$id."'";
	if($stmt = $con->prepare($query)){
		
		$stmt->execute();
		header("Location: property.php");
		die();
	}
	else{
		echo "Unable to update record";
        }	
			
 } 
 ?>

 
<div class="register-page">
	
<h1>Register A Property</h1>
<div class="well">
<div class="row">
<div class="col-md-4 col-md-offset-4">

<h2 style="text-align: center">Property Details</
h2>

<form name='updateproperty' id='updateproperty' action='EditProperty.php?id=<?=$id?>' method='post'>
	<div class="form-group">
			<label>Address</label>
			<input class="form-control" type='text' name='address' id='address'  required="true" value="<?=$address?>"/>
	</div>
	<div class="form-group">
			<label>Street Name</label>
			<input class="form-control" type='text' name='street_name' id='street_name' required="true" value="<?=$street_name?>"/>
	</div>
				    
	<div class="form-group">
			<label>Postal Code</label>
			<input class="form-control" type='text' name='postal_code' id='postal_code'  required="true" value="<?=$postal_code?>"/>
	</div>
	
	<div class="form-group">
			<label>Price Per Week</label>
			<input class="form-control" type='number' name='price' id='price' required="true" value="<?=$price?>"/>
	</div>			        
				            
	 <div class="form-group">     
			<label>District:
				<select name="district" required="true">
					<option value="1" <?php if ($district ==1) echo 'selected="selected"';?>>Central</option>
					<option value="2" <?php if ($district ==2) echo 'selected="selected"';?>>East End</option>
					<option value="3" <?php if ($district ==3) echo 'selected="selected"';?>>South End</option>
					<option value="4" <?php if ($district ==4) echo 'selected="selected"';?>>West End</option>
				</select>
			</label>
	</div>	   
			
			
	 <div class="form-group">
			<label>Type:
				<select name="type" required="true">
					<option value="Single" <?php if ($type =='Single') echo 'selected="selected"';?>>Single</option>
					<option value="Duplex" <?php if ($type =='Duplex') echo 'selected="selected"';?>>Duplex</option>
					<option value="Apartment" <?php if ($type =='Apartment') echo 'selected="selected"';?>>Apartment</option>
				</select>
			</label>
	</div>	   
			
	<div class="form-group">
			<label>Bedroom(s)</label>
			<input class="form-control" type='number' name='bedroom' id='bedroom' value="<?=$bedroom?>" required="true"/>
	</div>	
	
	<div class="form-group">
			<label>Bathroom(s)</label>
			<input class="form-control" type='number' name='bathroom' id='bathroom' value="<?=$bathroom?>" required="true"/>
	</div>
		
	<div class="form-group">
		<label>Pool:
			<input type="radio" name="Pool" required="true"
			<?php if (isset($Pool) && $Pool==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Pool" required="true"
		<?php if (isset($Pool) && $Pool==0) echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Laundry:
			<input type="radio" name="Laundry" required="true"
			<?php if (isset($Laundry) && $Laundry==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Laundry" required="true"
		<?php if (isset($Laundry) && $Laundry==0) echo "checked";?>
		value="0">No
		</label>
	</div>
	
	 <div class="form-group">
		<label>Internet:
			<input type="radio" name="Internet" required="true"
			<?php if (isset($Internet) && $Internet==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Internet" required="true"
		<?php if (isset($Internet) && $Internet==0) echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Parking:
			<input type="radio" name="Parking" required="true"
			<?php if (isset($Parking) && $Parking==2) echo "checked";?>
			value="2">Yes
		<input type="radio" name="Parking" required="true"
		<?php if (isset($Parking) && $Parking==1) echo "checked";?>
		value="1">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Heat:
			<input type="radio" name="Heat" required="true"
			<?php if (isset($Heat) && $Heat==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Heat" required="true"
		<?php if (isset($Heat) && $Heat==0) echo "checked";?>
		value="0">No
		</label>
	</div>

	<div class="form-group">
		<label>AC:
			<input type="radio" name="AC" required="true"
			<?php if (isset($AC) && $AC==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="AC" required="true"
		<?php if (isset($AC) && $AC==0) echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Smoking:
			<input type="radio" name="Smoking" required="true"
			<?php if (isset($Smoking) && $Smoking==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Smoking" required="true"
		<?php if (isset($Smoking) && $Smoking==0) echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Wheelchair: 
			<input type="radio" name="Wheelchair" required="true"
			<?php if (isset($Wheelchair) && $Wheelchair==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Wheelchair" required="true"
		<?php if (isset($Wheelchair) && $Wheelchair==0) echo "checked";?>
		value="0">No
		</label>
	</div>

	<div class="form-group">
		<label>Gym:
			<input type="radio" name="Gym" required="true"
			<?php if (isset($Gym) && $Gym==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Gym" required="true"
		<?php if (isset($Gym) && $Gym==0) echo "checked";?>
		value="0">No
		</label>
	</div>
	
	<div class="form-group">
		<label>Pets:
			<input type="radio" name="Pets" required="true"
			<?php if (isset($Pets) && $Pets==1) echo "checked";?>
			value="1">Yes
		<input type="radio" name="Pets" required="true"
		<?php if (isset($Pets) && $Pets==0) echo "checked";?>
		value="0">No
		</label>
	</div>

	<input class="btn btn-default" type='submit' id='updateBtn' name='updateBtn' value='Update' /> 
	<input class="btn btn-default" type='submit' id='deleteBtn' name='deleteBtn' value='Delete' />


</form>
</div>
</div>
</div>
</div>

<?php include 'footer.php';?>	


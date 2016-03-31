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
 $date = date("y:m:d");
 $time = date("H:i:s");                         
 
 ?>
   
 <?php include 'navigation.php'; ?>
 
 <div class="register-page">
	<br>
 
	<div class="row">
	<div class="col-md-4">
	<div class="well">
	<h2>Reply to Comment</h2>
	 <form name='reply' id='reply' action='reply.php?id=<?=$id?>' method='post'>
 
 <?php
  if(isset($_POST['commentBtn'])){
	include_once 'config/connection.php'; 
	 $memid = $_SESSION['member_id'];
	  $comment = $_POST['comment'];
	 

	//$query = "INSERT INTO comment(Member_ID, Property_ID, Rating, Date, Time, Text) VALUES (?,?,?,?,?,?)";
	//$query = "INSERT INTO comment (CNumber, Member_ID, Property_ID, Rating, Date, Time, reply) VALUES ($memid, $propertyid, $rating, '$date', '$time', '$comment')";
	$query = "UPDATE comment SET reply = '$comment' WHERE CNumber='".$id."'"; 
	if($stmt = $con ->prepare($query)) {
		//$stmt->bind_Param("iiidts", $_SESSION['member_id'], $_POST['$propertyid'], $_POST['rating'], $_POST['$date'], $_POST['$time'], $_POST['comment']);
		$stmt->execute();
		
	
	
	header("Location: property.php");
	die();
	}
	else{
		echo "Insert comment failed";
	} 
	
 }
 
?>
<label>Comment</label>
 <input class="form-control" type='text' name='comment' id='comment'/>
 <br>
 <input class="btn btn-default" type='submit' id='commentBtn' name='commentBtn' value='Add Comment' />
 </div>
  </div>
   </div>
    </div>
 <?php include 'footer.php';?>	
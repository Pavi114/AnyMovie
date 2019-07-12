<?php
session_start();
include("../initial/config.php");
if(isset($_POST['id'])){
	$user = $_SESSION["userLoggedIn"];
	$id=$_POST['id'];
	$query = "SELECT * from marks WHERE user_id='$user' and imdb_id='$id'";
	$get = mysqli_query($con,$query);
	if(mysqli_num_rows($get) > 0){
		$query = "DELETE FROM marks WHERE user_id='$user' and imdb_id='$id'";
		$result = mysqli_query($con,$query);
		echo 'no';
		$message = 'You marked a show('.$id.')';
		$query = "DELETE FROM activity WHERE user_id = '$user' and message = '$message'";
		$result = mysqli_query($con,$query);
	}
	else  {
		$query = "INSERT INTO marks (user_id,imdb_id) VALUES ('$user', '$id')";
		$get = mysqli_query($con,$query); 	
		echo 'yes';	
		$message = 'You marked a show('.$id.')';
		$query = "INSERT INTO activity (user_id,message) VALUES ('$user','$message')";
		$result = mysqli_query($con,$query);
	}
}
?>
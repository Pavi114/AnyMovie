<?php
session_start();
include("../initial/config.php");
if(isset($_POST['id'])){
	$user = $_SESSION["userLoggedIn"];
	$id=$_POST['id'];
	$query = "SELECT * from watched WHERE user_id='$user' and imdb_id='$id'";
	$get = mysqli_query($con,$query);
	if(mysqli_num_rows($get) > 0){
		$query = "DELETE FROM watched WHERE user_id='$user' and imdb_id='$id'";
		$result = mysqli_query($con,$query);
		echo 'no';
	}
	else  {
		$query = "INSERT INTO watched (user_id,imdb_id) VALUES ('$user', '$id')";
		$get = mysqli_query($con,$query); 	
		echo 'yes';	
	}
}
?>
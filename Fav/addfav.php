<?php
session_start();
include('../initial/config.php');
if(isset($_POST['id'])){
	$user = $_SESSION['userLoggedIn'];
	$id = $_POST['id'];
	$query = "SELECT * from favourites WHERE userId='$user' and imdbId='$id'";
	$get = mysqli_query($con,$query);
	if(mysqli_num_rows($get) > 0){
		$query = "DELETE FROM favourites WHERE userId='$user' and imdbId='$id'";
		$get = mysqli_query($con,$query);
		echo 'nofav';
		$message = 'You Liked a show('.$id.')';
		$query = "DELETE FROM activity WHERE user_id = '$user' and message = '$message'";
		$result = mysqli_query($con,$query);
	}
	else {
		$query = "INSERT INTO favourites (userId,imdbId) VALUES ('$user', '$id')";
		$get = mysqli_query($con,$query);
		echo 'fav';
		$message = 'You Liked a show('.$id.')';
		$query = "INSERT INTO activity (user_id,message) VALUES ('$user','$message')";
		$result = mysqli_query($con,$query);
	}
}
?>
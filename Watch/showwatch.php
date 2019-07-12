<?php
session_start();
include("../initial/config.php");
if(isset($_POST['id'])){
	$user = $_SESSION["userLoggedIn"];
	$id=$_POST['id'];
	$query = "SELECT * from marks WHERE user_id='$user' and imdb_id='$id'";
	$get = mysqli_query($con,$query);
	if(mysqli_num_rows($get) > 0){
	    echo 'yes';
	}
	else {
		echo 'no';
	}
}
?>
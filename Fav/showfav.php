<?php
session_start();
include('../initial/config.php');
  if(isset($_POST['id'])){
    $user = $_SESSION["userLoggedIn"];
    $id=$_POST['id'];
  	$query = "SELECT * from favourites WHERE userId='$user' and imdbId='$id'";
  	$get = mysqli_query($con,$query);
  	if(mysqli_num_rows($get) > 0){
  		echo 'yes';
  	}
  	else {
  		echo "no";
  	}
  }
?>
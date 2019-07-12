<?php
 session_start();
 include('../initial/config.php');
 if(isset($_SESSION['userLoggedIn'])){
 	$id = $_SESSION['userLoggedIn'];
 	$output = array();
 	$query = "SELECT * FROM favourites WHERE userId = '$id'";
 	$result = mysqli_query($con,$query);
 	if(mysqli_num_rows($result) > 0){
 		while($row = $result->fetch_assoc()){
 			array_push($output, $row['imdbId']);
 		}
 	}
    echo json_encode($output);
 }
?>
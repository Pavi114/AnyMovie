<?php
session_start();
 include('initial/config.php');
 $output = '';
 if(isset($_SESSION['userLoggedIn'])){
 	$id = $_SESSION['userLoggedIn'];
 	$query = "SELECT * FROM activity WHERE user_id = '$id' LIMIT 5";
 	$result = mysqli_query($con,$query);
 	if(mysqli_num_rows($result) > 0){
      while($row = $result->fetch_assoc()){
      	$output .= '<div class="dropdown-item">'.$row['message'].'</div>';
      }
 	}
 	else {
 		$output .= '<a class="dropdown-item">No new notifications</a>';
 	}

 	echo $output;
 }
?>
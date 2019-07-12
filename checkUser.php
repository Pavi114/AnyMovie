<?php 
include("initial/config.php");
if(isset($_POST['username'])){
  $username = $_POST['username'];
  $query = "SELECT * FROM user WHERE username = '$username'";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result) > 0){
  	echo 'yes';
  }
  else {
  	echo 'no';
  }
}
?>
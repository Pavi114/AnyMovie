<?php 
session_start();
include('initial/config.php');
if(isset($_SESSION['username'])){
	$user = $_SESSION["username"];
	$query = "SELECT id FROM user WHERE username='$user'";
	$get = mysqli_query($con,$query);
	$row = $get->fetch_assoc();
	$_SESSION['userLoggedIn'] = $row['id']; 
}
else {
	header("location: register.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
	body {
		background-color: #000000;
		color: white;
	}

	#result img {
		width: 100%;
	}

	#search {
		width: 40%;
		margin: 0 auto;
		background-color: rgba(0, 0, 0, 0.7);
		margin-top: 30px;
		text-align: center;
	}

	.btn {
		border: 1px solid white;
		border-radius: 10px;
		background-color: rgb(0, 0, 0);
		color: white;
	}

	.btn:hover {
		background-color: rgba(0, 0, 0, 0.7);
	}

	.image {
		border: 1px solid white;
		border-radius: 7px;
		padding: 10px;
		width: 100%;
		height: 420px;
		margin-top: 10px;
	}

	img {
		height: 280px;
		margin-bottom: 2px;
		width: 100%;
	}

	.more {
		margin-top: 10px;
	}
	hr {
		background: #FFFF00;
		width: 80%;
	}
	.dropdown{
		margin-top: 100px;
		margin-left: 20px;
	}

</style>
</head>
<body>
    <?php include('navbar.php') ?>
    <div class="dropdown" id='activity'>
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Activity
  </button>
  <div class="dropdown-menu" id="list" aria-labelledby="dropdownMenuButton">
  </div>
</div>
    <div class="container">
     <div id="popularShows" class="row">
		
	</div>	
    </div>
	<hr>
	<div class="container" id="search">
		<form>
			<div class="form-group">
				<input type="text" name="title" id="title" class="form-control" placeholder="Search by title">	
			</div>
			<div class="form-group">
				<input type="text" name="imdbid" id="imdbid" class="form-control" placeholder="Search by ID">	
			</div>
			<input type="button" class="btn btn-primary" name="submit" value="Search">
		</form>	
	</div>
	
	<div class="container">
		<div id="result" class="row">

		</div>	
	</div>
    <hr>
	<div class="container" style="margin-top:10px;">
		<h2>FAVOURITES:</h2>
		<div id="favourites" class="row">
			
			
		</div>	
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="home.js"></script>
</body>
</html>
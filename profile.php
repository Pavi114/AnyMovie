<?php
session_start();
if(!isset($_SESSION['userLoggedIn'])){
	header('Location: register.php'); 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<style type="text/css">
	body {
		background: #000000;
		color: #FFFFFF;
	}
		.image {
		border: 1px solid white;
		border-radius: 7px;
		padding: 10px;
		width: 100%;
		height: 390px;
		margin-top: 10px;
	}
	img {
		height: 250px;
		width: 100%;
		margin-bottom: 2px;
	}
	.more {
		margin-top: 10px;
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
	h2 {
		margin: 15px;
		text-align: center;
	}
	.container {
		margin-top: 100px;
	}
</style>
</head>
<body>
	<?php include('navbar.php'); ?>
	<div class="container">
		<h2>Watched Shows</h2>
		<div id="watched">

		</div>
		<h2>Watchlist</h2>
		<div id="wantToWatch" class="row">
		</div>	
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="profile.js"></script>
</body>
</html>
<?php
session_start();
include('initial/config.php');
include('initial/database.php');

if(isset($_SESSION['userLoggedIn'])){
	header('location: home.php');
}

$con = mysqli_connect($servername,$username,$password,$database);
$wasSuccessful = false;
$loginSuccessful = true;

if(isset($_POST['loginButton'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "SELECT * FROM user WHERE username = '$username'";
	$checkLogin = mysqli_query($con,$query);
	if(mysqli_num_rows($checkLogin) == 1){
		$row = $checkLogin->fetch_assoc();
		$passwordCorrect = password_verify($password,$row['password']);
		if($passwordCorrect){
			$loginSuccessful = true;

			$_SESSION['username'] = $username;
			header("Location: home.php");
		}
		else {
			$loginSuccessful = false;
		}
	}
	else {
		$loginSuccessful = false;
	}
	
}


if(isset($_POST['registerButton'])){
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "SELECT * FROM user WHERE username = '$username'";
	$existingUsername = mysqli_query($con,$query);
	if(mysqli_num_rows($existingUsername) > 0){
		$wasSuccessful = false;
	}
	else {
		$encrypt = password_hash($password,PASSWORD_DEFAULT);
		$query = "INSERT INTO user (name,username,password) VALUES ('$name','$username','$encrypt')";
		$insert = mysqli_query($con,$query);
		if($insert){
			$wasSuccessful = true;
		}
		else {
			$wasSuccessful = false;
		}	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>OMDB CLONE</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Rubik|Itim&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<style type="text/css">
	body {
		background-color: #000000;
		color: #FFFFFF;
		font-size: 1.5vw;
	}
	.btn {
		background-color: rgb(0,0,30);
		border: 1px solid white;
		border-radius: 5px;
		color: white;
	}
	.hidden {
		display: none;
	}
	.container {
		background-color: rgba(0,0,30);
		margin-top: 50px;
		height: 400px;
		width: 50%;
	}
	.form-control {
		margin-top: 10px;
	}
	.row {
		margin: 10px;
	}

</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<button type="button" class="btn form-control" id="showLogin">LOGIN</button>
			</div>
			<div class="col-md-6">
				<button type="register" class="btn form-control" id="showRegister">REGISTER</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="register.php" method="POST" id="login">
					<?php if(!$loginSuccessful){
						echo 'Invalid Credentials';
					} 
					if($wasSuccessful){
						echo "Successfully Registered";
					}
					?>
					<div class="row">
					  <input type="text" name="username" class="form-control" placeholder="Username" required>		
					</div>
					<div class="row">
						<input type="password" name="password" class="form-control" placeholder="password" required>
					</div>
					<div class="row">
						<button type="submit" class="btn btn-primary" name="loginButton">LOGIN</button>
					</div>
				</form>
				<form action="register.php" method="POST" id="register" class="hidden">
					<div class="row">
						<input type="text" class="form-control" name="name" placeholder="Name" required>
					</div>
					<div class="row">
						<input type="text" class="form-control" name="username" id="username" placeholder="username" required>
					</div>
					<div class="row">
						<input type="password" class="form-control" name="password" placeholder="password" required>
					</div>
					<div class="row text-center">
						<button type="submit" class="btn btn-primary" name="registerButton">REGISTER</button>
					</div>
				</form>
			</div>	
			
		</div>	
	</div>
	<?php
	if(isset($_POST['registerButton'])){
		if(!$wasSuccessful){
			echo '<script>
			var hidden = document.querySelector(".hidden");
			var login = document.querySelector("#login");
			var register = document.querySelector("#register");
			register.innerHTML += "Registration Unsuccessful";
			register.classList.remove("hidden");
			login.classList.add("hidden");
			</script>';
		}
	}
	?>
	<script type="text/javascript">
		var login = document.getElementById('login');
		var register = document.getElementById('register');
		var hidden = document.querySelector(".hidden");
		var username = document.querySelector('#username');
		var httpRequest = new XMLHttpRequest();
		document.querySelector("#showLogin").addEventListener("click",function(){
			register.classList.add('hidden');
			login.classList.remove('hidden');
		})
		document.querySelector("#showRegister").addEventListener("click",function(){
			register.classList.remove('hidden');
			login.classList.add('hidden');
		})
		username.addEventListener("input",function(){
			httpRequest.onreadystatechange = updateUser;
			httpRequest.open('POST','checkUser.php');
			httpRequest.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			httpRequest.send('username='+username.value);
		})
		function updateUser(){
           if(httpRequest.readyState == 4){
           	if(httpRequest.status == 200){
           		var response = httpRequest.responseText;
           		if(response == 'yes'){
           			username.style.boxShadow = '0px 0px 5px #FF0000';
           			username.style.border = '1px solid #FF0000';
           		}
           		else {
           			username.style.boxShadow = '0px 0px 5px #00FF00';
           			username.style.border = '1px solid #00FF00';
           		}
           	}
           }
		}
	</script>
</body>
</html>	
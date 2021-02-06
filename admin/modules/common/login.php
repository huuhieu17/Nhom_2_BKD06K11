<?php 
	error_reporting(0);
	require_once("config/config.php");
require_once("config/session.php");
	if (isset($_SESSION['admin']) || $_SESSION['admin'] != "") {
		header('Location:?modules=common&action=home');
	}
	$error = "";
	if (isset($_POST['btn'])) {
		$user = $_POST['username'];
		$pass = md5($_POST['password']);
		$sql = "SELECT * FROM admins WHERE username = '$user' AND password = '$pass' ";
		$query = mysqli_query($connection,$sql);
		if (mysqli_num_rows($query) == 0) {
			$error = "Thông tin đăng nhập không chính xác";
		}else{
			session_start();
			$admin = mysqli_fetch_assoc($query);
			// save info admin.
			$_SESSION['admin']['name'] = $admin['name'];
			$_SESSION['admin']['username'] = $admin['username'];
			$_SESSION['admin']['level'] = $admin['level'];
			$_SESSION['admin']['id'] = $admin['id'];
			mysqli_close($connection);
			header('Location:?modules=common&action=home');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			font-family: inherit;
		}
		#container{
			height: 100vh;
			width: 100%;
			background: white;
			padding: 4% 0;
		}
		#form{

			box-sizing: border-box;
			width: 30vw;
			background: #f1f1f1;
			margin: auto;
			border-radius: 3px;
			text-align: center;
		}
		h1{
			color: black;
			font-family: arial;
		}
		input{
			box-sizing: border-box;
			width: 70%;
			padding: 2%;
			margin: 1%;
			border-radius: 5px;
		}
		button{
			box-sizing: border-box;
			width: 69%;
			padding: 2%;
			background: none;
			color: black;
			font-weight: bold;
			border: 1px solid black;
		}
		form{
			padding: 5% 0;
		}
		hr{
			margin-bottom: 5%;
		}

	</style>
</head>
<body>
	<div id="container">
		<div id="form">
			<form action="#" method="POST">
				<h1>Hstore</h1>
				<hr>
				<p style="color:red">
					<?php 
						echo $error;
					 ?>
					
				</p>
				Username: <br>	
				<input type="text" name="username" placeholder="Username"><br>
				Password: <br>	
				<input type="password" name="password" placeholder="Password"><br>
				<button name="btn">Login</button>
			</form>
		</div>
	</div>
</body>
</html>
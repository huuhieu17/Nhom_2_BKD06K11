<?php 
	error_reporting(0);
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
			$_SESSION['admin']['level'] = $admin['admin'];
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
			width: 100%;
			background: black;
			padding: 15% 0;
		}
		#form{
			width: 30%;
			background: white;
			margin: auto;
			border-radius: 3px;
			text-align: center;
		}
		h3{
			font-family: arial;
		}
		input{
			width: 50%;
			padding: 2%;
			margin: 1%;
			border-radius: 3px;
		}
		button{
			width: 50%;
			padding: 2%;
			background: #2196f3;
			color: white;
			outline: none;
			border: none;
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
				<h3>Admin login</h3>
				<hr>
				<p style="color:red">
					<?php 
						echo $error;
					 ?>
					
				</p>
				<input type="text" name="username" placeholder="Username"><br>
				<input type="password" name="password" placeholder="Password"><br>
				<button name="btn">Login</button>
			</form>
		</div>
	</div>
</body>
</html>
<?php
require_once('customer/template/version1/header.php');
$subTitle = "Register";
if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
			// 
}else{
	header('Location:?s=home');
}
if (isset($_POST['btn'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$checkpass = $_POST['password'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$checksql = "SELECT * FROM users ";
	$checkquery = mysqli_query($connection,$sql);
	foreach ($checkquery as $key) {
		# code...
	}
	$sql = "INSERT INTO customers VALUES(null,'$username','$name','$email','$password','','','')";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		$error = "Error";
	}else{
		$error = "Register Successful! Please <a href='?s=home&act=login'><b> Login</b></a>";
	}
}
?>
<style>
	#login{
		background: #f9f9f9;
		padding: 8% 0;
		width: 100%;
		text-align: center;
	}
	#form{
		box-sizing: border-box;
		text-align: left;
		margin: auto;
		padding: 1%;
		background: white;
		width: 25%;
		border: 1px solid #f9f9f9;
		border-radius: 3px;
	}
	input.input{
		box-sizing: border-box;
		padding: 3%;
		margin: 2%;
		width: 90%;
		border-radius: 3px;
		border: 1px solid gray;
	}
	h2#title{
		margin: 2%;
		text-align: left;
	}
	button#btn{
		box-sizing: border-box;
		width: 90%;
		background: black;
		color: white;
		margin: 2%;
		padding: 3% 0;
		border-radius: 3px;
		transition: 0.7s;
	}
	button#btn:hover{
		font-weight: bold;
		box-shadow: 1px;
		transition: 0.7s;
	}
	@media only screen and (max-width: 768px) {
		#form{
			margin: auto;
			padding: 2%;
			background: white;
			width: 100vw;
			border: 1px solid #f9f9f9;
			border-radius: 3px;
		}
	}
</style>
<div id="login">
	<div id="form">	
		<h2 id="title">Register</h2><hr><br>
		<form action="#" method="POST">
			<span style="color:red;font-size: 13px;" id="error">
				<?php
				if (isset($_POST['btn'])) {
					echo $error.'</br>';
				}
				?>

			</span>	
			Username: <br>
			<input type="text" class="input" name="username" placeholder="Username" id="username" required=""><br>
			Name: <br>
			<input type="text" class="input" name="name" placeholder="Full Name" id="name" required=""><br>
			Email: <br>
			<input type="email" class="input" name="email" placeholder="Email" id="email" required=""><br>
			Password: <br>
			<input type="text" class="input" name="password" placeholder="Password" id="password" required=""><br>
			<button name="btn" id="btn">Register</button>
			<br>
			<span>Already have a account ? <a href="?s=home&act=login">Login</a></span>
		</form>
	</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>

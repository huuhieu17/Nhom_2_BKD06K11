<?php
if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
			// 
}else{
	echo "<script>window.location.replace('?s=home');</script>";
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
		$error = "Lỗi";
	}else{
		$error = "Đăng ký thành công! Mời bạn <a href='?s=home&act=login'>Đăng nhập</a>";
	}
}
?>
<style>
	#login{
		
		padding: 7% 0;
		width: 100%;
		text-align: center;
	}
	#form{
		margin: auto;
		padding: 2%;
		background: white;
		width: 25%;
		border: 1px solid #f9f9f9;
		border-radius: 3px;
	}
	input{
		padding: 3%;
		margin: 2%;
		width: 90%;
		border-radius: 3px;
		border: 1px solid gray;
	}
	h3#title{
		margin: 2%;
		text-align: left;
	}
	button#btn{
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
</style>
<div id="login">
	<div id="form">	
		<h3 id="title">Đăng Ký</h3>
		<form action="#" method="POST">
			<span style="color:red;font-size: 13px;" id="error">
				<?php
				if (isset($_POST['btn'])) {
					echo $error;
				}
				?>

			</span>	
			<input type="text" name="username" placeholder="Username" id="username" required=""><br>
			<input type="text" name="name" placeholder="Full Name" id="name" required=""><br>
			<input type="email" name="email" placeholder="Email" id="email" required=""><br>
			<input type="password" name="password" placeholder="Password" id="password" required=""><br>
			<button name="btn" id="btn">Register</button>
			<br>
			<span>Bạn đã có tài khoản ? <a href="?s=home&act=login">Đăng nhập</a></span>
		</form>
	</div>
</div>
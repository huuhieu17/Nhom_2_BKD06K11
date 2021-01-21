<?php
	$error = "";
	if(isset($_SESSION['user']['name']) && isset($_SESSION['user']['id'])){
		//problem with header location
		echo "<script>window.location.replace('?s=home');</script>";
	}else{
		if(isset($_POST['btn'])){
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$sql = "SELECT * FROM customers WHERE username ='$username' AND password ='$password'";
			$query = mysqli_query($connection,$sql);
			if (mysqli_num_rows($query) == 0) {
				$error = "Thông tin tài khoản mật khẩu không chính xác!";
			}else{
				$row = mysqli_fetch_assoc($query);
				$_SESSION['user']['name'] = $row['name'];
				$_SESSION['user']['id'] = $row['id'];
				mysqli_close($connection);
			//problem with header location
				echo "<script>window.location.replace('?s=home');</script>";
			}
		}
	}
?>
<style>
	#login{
		
		padding: 10% 0;
		width: 100%;
		text-align: center;
	}
	#form{
		margin: auto;
		padding: 2%;
		background: white;
		width: 30vw;
		border: 1px solid #f9f9f9;
		border-radius: 3px;
	}
	input.input{
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
	@media only screen and (max-width: 768px) {
		#form{
		margin: auto;
		padding: 2%;
		background: white;
		width: 60vw;
		border: 1px solid #f9f9f9;
		border-radius: 3px;
		}
	}
</style>
<div id="login">
	<div id="form">	
		<h3 id="title">Đăng nhập hệ thống</h3>
		<form action="" method="POST">
			<span style="color:red;font-size: 13px;"> <?php
			echo $error;
			?></span>	
			<input class="input" type="text" name="username" placeholder="Username"><br>
			<input class="input" type="password" name="password" placeholder="Password"><br>
			<button name="btn" id="btn">Login</button>
			<br>
			<span>Bạn chưa có tài khoản ? <a href="?s=home&act=register">Đăng ký ngay</a></span>
		</form>
	</div>
</div>

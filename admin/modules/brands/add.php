<?php 
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$sql = "INSERT INTO brands VALUES(null,'$name')";
		$query= mysqli_query($connection,$sql);
	}
?>
<style>
	#addbrand{
		width: 100%;
		background: #f1f1f1;
		margin: auto;
	}
	form{
		box-sizing: border-box;
		padding: 20px;
		background: white;
		width: 50%;
		margin: auto;
	}
	input{

		padding: 10px;
		width: 80%;
	}
	button{
		margin: 10px 0;
		padding: 10px;
		width: 80%;
	}
	a{
		color: gray;
		font-weight: bold;
	}
</style>
<a href="?modules=common&action=home">Home</a>/<a href="?modules=brands&action=all">Brands</a>/<a href="?modules=brands&action=add">Add</a>
<div id="addbrand">
	<form method="POST">
		<span>Brand Name:</span>
	<input type="text" name="name" placeholder="Brand Name"><br>
	<button name="btn">Add</button>
	</form>
</div>

<?php 
require_once 'template/header.php';
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$sql = "INSERT INTO categorizes VALUES(null,'$name')";
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
	a.nav{
		color: gray;
		font-weight: bold;
	}
</style>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=categorizes&action=all">Product Type</a>/<a class="nav"href="?modules=categorizes&action=add">Add</a>
<div id="addbrand">
	<form method="POST">
		<span>Product Type:</span><br>
	<input type="text" name="name" placeholder="Product Type"><br>
	<button name="btn">Add</button>
	</form>
</div>
<?php require_once 'template/footer.php'; ?>

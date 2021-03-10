<?php 
require_once 'template/header.php';
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$sql = "INSERT INTO brands VALUES(null,'$name')";
		$query= mysqli_query($connection,$sql);
	}
?>
<style>
	#contents{
		height: 100vh;
	}
	#addbrand{
		width: 100%;
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
		color: black;
		font-weight: bold;
	}
	h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	@media only screen and (max-width: 768px) {
		form{
			width: 100%;
		}
	}
</style>

<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=brands&action=all">Brands</a>/<a class="nav"href="?modules=brands&action=add">Add</a>
<h4>Add Brands</h4>
<div id="addbrand">
	<form method="POST">
		<span>Brand Name:</span><br>
	<input type="text" name="name" placeholder="Brand Name"><br>
	<button name="btn">Add</button>
	</form>
</div>
<?php require_once 'template/footer.php'; ?>

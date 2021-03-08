<?php 
require_once 'template/header.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM brands WHERE id ='$id' ";
		$query= mysqli_query($connection,$sql);
		$result = mysqli_fetch_assoc($query);
	}
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$id = $_GET['id'];
		$sql = "UPDATE brands SET name='$name' WHERE id='$id'";
		$query= mysqli_query($connection,$sql);
		if (!$query) {
			# code...
		}else{
			echo "<script>window.location.replace('?modules=categorizes&action=all');</script>";
			header('Location:?modules=categorizes&action=all');
		}
	}
?>
<style>
	#contents{
		height: 100vh;
	}
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
		color: black;
		font-weight: bold;
	}
</style>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=brands&action=all">Brands</a>/<a class="nav"href="?modules=brands&action=edit">Edit</a>
<div id="addbrand">
	<form method="POST">
		<span>Brand Name:</span><br>
	<input type="text" name="name" placeholder="Brand Name" value="<?php echo $result['name']?>"><br>
	<button name="btn">Add</button>
	</form>
</div>
<?php require_once 'template/footer.php'; ?>
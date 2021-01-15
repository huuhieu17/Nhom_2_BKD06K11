<?php 
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM categorizes WHERE id ='$id' ";
		$query= mysqli_query($connection,$sql);
		$result = mysqli_fetch_assoc($query);
	}
	if (isset($_POST['btn'])) {
		$name = $_POST['name'];
		$id = $_GET['id'];
		$sql = "UPDATE categorizes SET name='$name' WHERE id='$id'";
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
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=categorizes&action=all">Product Type</a>/<a class="nav"href="?modules=categorizes&action=edit">Edit</a>
<div id="addbrand">
	<form method="POST">
		<span>Product Type</span><br>
	<input type="text" name="name" placeholder="Product Type" value="<?php echo $result['name']?>"><br>
	<button name="btn">Edit</button>
	</form>
</div>


<style>
	a.nav{
		color: gray;
		font-weight: bold;
	}
	form{
		font-size: 20px;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	input{
		padding: 10px;
	}
	select{
		padding: 10px;
	}
</style>

<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=products&action=all">Products</a>/<a class="nav"href="?modules=products&action=add">Add</a>
<br><br>
<h1>Add Product</h1>
<form action="" method="POST" enctype="multipart/form-data">
	Id:
	<input type="number" name="id"><br>
	Name:
	<input type="text" name="name" placeholder="Name products"><br>
	Type:
	<select name="type" id="">
	<?php 
		$sql = "SELECT * FROM categorizes"; // get brands
		$query = mysqli_query($connection,$sql);
		foreach ($query as $key) {
			echo "<option value='".$key['id']."'>".$key['name']."</option>";
		}
		
	?>
	</select><br>
	Brand:
	<select name="brand" id="">
	<?php 
		$sql = "SELECT * FROM brands"; // get brands
		$query = mysqli_query($connection,$sql);
		foreach ($query as $key) {
			echo "<option value='".$key['id']."'>".$key['name']."</option>";
		}
		
	?>
	</select><br>
	Price:
	<input type="number" name="price"><br>
	Status:
	<select name="status" id="">
		<option value="1">Available</option>
		<option value="0">Not Available</option>
		<option value="2">Contact</option>
	</select><br>
	<img id="blah" alt="your image" width="30%" height="30%" />
	Image:
	<input type="file" name="img" 
    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
    <input type="submit" name="submit">
</form>
<?php 
if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$brand = $_POST['brand'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$status = $_POST['status'];
	// Upload image 
	$dir = "../public/img/product/";
	$img = $_FILES['img'];
	$imgname= $img['name'];
	$path = $dir.$imgname;
	move_uploaded_file($img['tmp_name'], $path);
	$sql = "INSERT INTO products VALUES(NULL,'$id','$name','$imgname','$price','','$brand','$type','$status')";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error: ". mysqli_connect_error();
	}else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	}
}
?>
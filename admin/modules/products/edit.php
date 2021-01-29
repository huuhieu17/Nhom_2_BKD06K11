<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM products WHERE id = '$id'";
	$row = mysqli_fetch_assoc(mysqli_query($connection,$sql));
}else{
	echo "<script>window.location.replace('?modules=products&action=all');</script>";
}
$sql = "SELECT * FROM products WHERE id='$id'";
?>
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<style>
	a.nav{
		color: gray;
		font-weight: bold;
	}
	form{
		padding: 20px;
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
	Name:
	<input type="text" name="name" placeholder="Name products" value="<?php echo $row['product_name'] ?>"><br>
	Type:
	<select name="type" id="">
	<?php 
		$sql = "SELECT * FROM categorizes"; // get brands
		$query = mysqli_query($connection,$sql);
		foreach ($query as $key) {
			if ($row['product_type'] == $key['id']) {
				echo "<option selected value='".$key['id']."'>".$key['name']."</option>";
			}else{
				echo "<option value='".$key['id']."'>".$key['name']."</option>";
			}
		}
		
	?>
	</select><br>
	Brand:
	<select name="brand" id="">
	<?php 
		$sql = "SELECT * FROM brands"; // get brands
		$query = mysqli_query($connection,$sql);
		foreach ($query as $key) {
			if ($row['product_type'] == $key['id']) {
				echo "<option selected value='".$key['id']."'>".$key['name']."</option>";
			}else{
				echo "<option value='".$key['id']."'>".$key['name']."</option>";
			}
		}
		
	?>
	</select><br>
	Price:
	<input type="number" name="price" value="<?php echo $row['product_price'] ?>"><br>
	Status:
	<select name="status" id="">
		<option value="1">Available</option>
		<option value="0">Not Available</option>
		<option value="2">Contact</option>
	</select><br>
	
    <textarea name="editor1" value=""><?php echo $row['product_description'] ?></textarea>
      <script>
                        CKEDITOR.replace( 'editor1' );
      </script>
    <input type="submit" name="submit">
</form>
<?php 
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$brand = $_POST['brand'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$status = $_POST['status'];
	$description = $_POST['editor1'];
	
	$sql = "UPDATE products SET product_name = '$name',product_brand='$brand',product_type ='$type',product_price ='$price',product_status ='$status',product_description ='$description' WHERE id='$id'";
	mysqli_query($connection,$sql);	
	//
	
	// $sql = "INSERT INTO products VALUES(NULL,'$id','$name','','$price','$description','$brand','$type','$status')";
	// $query = mysqli_query($connection,$sql);
	// if (!$query) {
	// 	echo "Error: ". mysqli_connect_error();
	// }else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	// }
}
?>
<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM products WHERE id_product = '$id'";
	$query_a = mysqli_query($connection,$sql);
	$result = mysqli_fetch_assoc($query_a);
}else{
	echo "<script>window.location.replace('?modules=products&action=all');</script>";
}
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

<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=products&action=all">Products</a>/<a class="nav"href="?modules=products&action=edit">Edit</a>
<br><br>
<h1>Edit Product</h1>
<form action="" method="POST" enctype="multipart/form-data">
	Id:
	<input type="number" name="id" value="<?php echo $result['id_product'] ?>" readonly><br>
	Name:
	<input type="text" name="name" placeholder="Name products" value="<?php echo $result['product_name'];?>"><br>
	Type:
	<select name="type" id="">
	<?php 
		$sql = "SELECT * FROM categorizes"; // get brands
		$query = mysqli_query($connection,$sql);
		$selected = $result['product_type'];
		foreach ($query as $key) {
			if ($key['id'] == $selected) {
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
		$selected = $result['product_brand'];
		foreach ($query as $key) {
			if ($key['id'] == $selected) {
			echo "<option selected value='".$key['id']."'>".$key['name']."</option>";
			}else{
				echo "<option value='".$key['id']."'>".$key['name']."</option>";
			}
		}
		
	?>
	</select><br>
	Price:
	<input type="number" name="price" value="<?php echo $result['product_price']?>"><br>
	Status:
	<select name="status" id="">
		<option value="1">Available</option>
		<option value="0">Not Available</option>
		<option value="2">Contact</option>
	</select><br>
	<img id="blah" src = "../public/img/product/<?php echo $result['product_images']?>"alt="your image" width="30%" height="30%" />
	Image:
	<input type="file" name="img" 
    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
    <textarea name="editor1"></textarea>
      <script>
                        CKEDITOR.replace( 'editor1' );
      </script>
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
	if ($img['name'] == "") {
		$imgname = $result['product_images'];
	}else{
		$imgname= $img['name'];
	}
	
	$path = $dir.$imgname;
	$description = $_POST['editor1'];
	move_uploaded_file($img['tmp_name'], $path);
	if (isset($_FILES['img'])) {
		$sql = "UPDATE products SET product_name= '$name', product_images = '$imgname', product_price = '$price',product_description = '$description',product_brand ='$brand',product_type ='$type',product_status='$status' WHERE id_product = '$id'";
	}else{
		$sql = "UPDATE products SET product_name= '$name', product_price = '$price',product_description = '$description',product_brand ='$brand',product_type ='$type',product_status='$status' WHERE id_product = '$id'";
	}
	
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error: ". mysqli_connect_error();
	}else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	}
}
?>
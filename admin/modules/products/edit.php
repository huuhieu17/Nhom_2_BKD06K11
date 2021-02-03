<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM products WHERE id = '$id'";
	$row = mysqli_fetch_assoc(mysqli_query($connection,$sql));
	$id_product = $row['id'];
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
		padding: 0 20px ;
		font-size: 15px;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	input{
		padding: 5px;
	}
	select{
		padding: 5px;
	}
	.color{
				display: inline-block;
				font-size: 13px;
				font-weight: bold;
	}
</style>

<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=products&action=all">Products</a>/<a class="nav"href="?modules=products&action=add">Add</a>
<br><br>
<h1>Add Product</h1>
<form action="" method="POST" enctype="multipart/form-data">
	Name:
	<input type="text" name="name" placeholder="Name products" value="<?php echo $row['product_name'] ?>">
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
	</select>
	Brand:
	<select name="brand" id="">
	<?php 
		$sql = "SELECT * FROM brands"; // get brands
		$query = mysqli_query($connection,$sql);
		foreach ($query as $key) {
			if ($row['product_brand'] == $key['id']) {
				echo "<option selected value='".$key['id']."'>".$key['name']."</option>";
			}else{
				echo "<option value='".$key['id']."'>".$key['name']."</option>";
			}
		}
		
	?>
	</select>
	Price:
	<input type="number" name="price" value="<?php echo $row['product_price'] ?>">
	Color:
	<div class="color">
		<?php 
			$sql ="SELECT product_variants.product_id,product_variants.product_variant_value_id,product_variants.status,variant_value.value FROM product_variants INNER JOIN variant_value WHERE product_variants.product_id = '$id_product' AND product_variants.product_variant_value_id = variant_value.id LIMIT 11";
			$query = mysqli_query($connection,$sql);
				foreach ($query as $key => $value) {
						if ($value['status'] == 1) {
							$check = "Checked";
						}else{
							$check ="";
						}
						echo "<input type='checkbox'".$check." name='color[ ]' value='".$value['product_variant_value_id']."'> ". $value['value']. " ";	
				}	

						
		?>
	</div>
	Size:
	<div class="size">
		<?php 
			$sql ="SELECT product_variants.product_id,product_variants.product_variant_value_id,product_variants.status,variant_value.value FROM product_variants INNER JOIN variant_value WHERE product_variants.product_id = '$id_product' AND product_variants.product_variant_value_id = variant_value.id AND variant_value.id > 11";
			$query = mysqli_query($connection,$sql);
				foreach ($query as $key => $value) {
						if ($value['status'] == 1) {
							$check = "Checked";
						}else{
							$check ="";
						}
						echo "<input type='checkbox'".$check." name='size[ ]' value='".$value['product_variant_value_id']."'> ". $value['value']. " ";	
				}	

						
		?>
	</div>
	Status:
	<select name="status" id="">
		<option value="1">Available</option>
		<option value="0">Not Available</option>
		<option value="2">Contact</option>
	</select>
	
	
    <textarea name="editor1" class="ckedit"></textarea>
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
	// Upload image 
	$dir = "../public/img/product/";
	// $fileNames = array_filter($_FILES['images']['name']); 
	// echo $fileNames;
	// if(!empty($fileNames)){ 
 //        foreach($_FILES['images']['name'] as $key=>$val){ 
 //            // File upload path 
 //            $fileName = basename($_FILES['images']['name'][$key]); 
 //            $targetFilePath = $dir . $fileName; 
 //            // Check whether file type is valid 
 //                // Upload file to server 
 //                if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){ 
 //                    // Image db insert sql 
 //                    $sql = "INSERT INTO products_images VALUES('$id','$fileName')";
 //                    $query = mysqli_query($connection,$sql);
 //                }else{ 
 //                    $errorUpload .= $_FILES['images']['name'][$key].' | '; 
 //                } 
             
 //        } 
 //    }
	// $sql = "INSERT INTO products VALUES(NULL,'$name','$price','$description','$brand','$type','$status')";
	mysqli_query($connection,$sql);	
	
	$color = $_POST['color'];
	for ($i=0; $i < sizeof($color) ; $i++) { 
		echo $color[$i];
		if ($_POST['color'][$i] == $color[$i]) {
			$sql = "UPDATE product_variants SET status = 1 WHERE product_id ='$id_product' AND product_variant_value_id ='$color[$i]'";
		}
		if (empty($_POST['color'][$i])) {
			$sql = "UPDATE product_variants SET status = 0 WHERE product_id ='$id_product' AND product_variant_value_id ='$color[$i]'";
		}
			
		
		echo $sql;
		$query=mysqli_query($connection,$sql);
		if (!$query) {
			echo "Error:".mysqli_error($connection);
		}
	}
	$size = $_POST['size'];
	for ($i=0; $i < sizeof($size) ; $i++) { 
		if (isset($_POST['size']) || $chec == "Checked") {
			$sql = "UPDATE product_variants SET status ='1' WHERE product_id ='$id_product' AND product_variant_value_id ='$size[$i]'";
		}else{
			$sql = "UPDATE product_variants SET status ='0' WHERE product_id ='$id_product' AND product_variant_value_id ='$size[$i]'";
		}
		$query=mysqli_query($connection,$sql);
		if (!$query) {
			echo "Error:".mysqli_error($connection);
		}
	}
		//
	
	// $sql = "INSERT INTO products VALUES(NULL,'$id','$name','','$price','$description','$brand','$type','$status')";
	// $query = mysqli_query($connection,$sql);
	// if (!$query) {
	// 	echo "Error: ". mysqli_connect_error();
	// }else{
	// 	// echo "<script>window.location.replace('?modules=products&action=all');</script>";
	// }
}
?>
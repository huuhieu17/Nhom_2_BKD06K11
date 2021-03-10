<?php 
require_once 'template/header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM products WHERE id = '$id'";
	$row = mysqli_fetch_assoc(mysqli_query($connection,$sql));
	$id_product = $_GET['id'];
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
	table,tr,th,td{
		border: 1px solid #eee;
	}
	h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
</style>

<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=products&action=all">Products</a>/<a class="nav"href="#">Edit</a>
<br><br>
<h4>Edit Product</h4>
<form action="" method="POST" enctype="multipart/form-data">
	Name:
	<input type="text" name="name" placeholder="Name products" value="<?php echo $row['product_name'] ?>">
	Gender:
	<select name="gender" id="">
		<option value="0">Female</option>
		<option value="1">Male</option>
	</select>
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
			$sql ="SELECT product_variants.product_id,product_variants.product_variant_value_id,product_variants.status,variant_value.value FROM product_variants INNER JOIN variant_value WHERE product_variants.product_id = '$id_product' AND product_variants.product_variant_value_id = variant_value.id AND product_variants.status = 1";
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
			$sql = "SELECT * FROM sku WHERE product_id ='$id_product'";
			
			$query = mysqli_query($connection,$sql);
		?>
		<?php foreach ($query as $keysize): ?>
			<span>
				<?php switch ($keysize['size_id']) {
				case '12':
					echo 'S';
					break;
				case '13':
					echo 'M';
					break;
				case '14':
					echo 'L';
					break;
				case '15':
					echo 'XL';
					break;
				case '16':
					echo 'XXL';
					break;
				case '17':
					echo 'XXXL';
					break;
				
				default:
					# code...
					break;
				} ?>
				<input type="number" name="quantity[ ]" placeholder ="Quantity" value ="<?php echo $keysize['quantity'] ?>">
			</span>
			
		<?php endforeach ?>
		<?php 
		 $sizearray = array(12,13,14,15,16,17);
		 $quantity = array();
		 if (isset($_POST['quantity'])) {
		 	 $quantity = $_POST['quantity'];
		 for ($i=0; $i < count($quantity) ; $i++) { 
		 	$sql = "UPDATE sku SET quantity ='$quantity[$i]' WHERE product_id = '$id_product' AND size_id='$sizearray[$i]'";
		 	mysqli_query($connection,$sql);
		 }
		 }
		
		?>
		<!-- <span>S:</span> <input type="number" name="squantity" placeholder="Quantity">
		<span>M:</span> <input type="number" name="squantity" placeholder="Quantity">
		<span>L:</span> <input type="number" name="squantity" placeholder="Quantity">
		<span>XL:</span> <input type="number" name="squantity" placeholder="Quantity">
		<span>XXL:</span> <input type="number" name="squantity" placeholder="Quantity">
		<span>XXL:</span> <input type="number" name="squantity" placeholder="Quantity"> -->
	</div>
	Status:
	<select name="status" id="">
		<option value="1">Available</option>
		<option value="0">Not Available</option>
		<option value="2">Contact</option>
	</select>
	
	
    <textarea name="editor1" class="ckedit"> <?php echo $row['product_description'] ?></textarea>
      <script>
                        CKEDITOR.replace( 'editor1' );
      </script>
    <input type="submit" name="submit">
</form>
<?php 
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$brand = $_POST['brand'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$status = $_POST['status'];
	$description = $_POST['editor1'];
	// Upload image 
	$dir = "../public/img/product/";

	$color = array();
	$color = $_POST['color'];
	for ($i=0; $i < count($color); $i++) { 
		if (isset($_POST['color'])) {
			$sql = "UPDATE product_variants SET status =1 WHERE product_id ='$id_product' AND product_variant_value_id ='$color[$i]' AND product_variant_value_id <= 11";
			mysqli_query($connection,$sql);
		}
		$sql = "UPDATE product_variants SET status = 0 WHERE product_id = '$id_product' AND product_variant_value_id <= 11 AND product_variant_value_id NOT IN (".implode(',',array_map('intval',$color)).") ";
			mysqli_query($connection,$sql);
	}
	
		
	
	$sql = "UPDATE products SET product_name ='$name', product_gender ='$gender',product_price ='$price',product_brand ='$brand',product_type ='$type',product_status = '$status',product_description ='$description' WHERE id= '$id_product'";
	$query = mysqli_query($connection,$sql);
	header("Location:?modules=products&action=all");
	if (!$query) {
		echo "Error: ". mysqli_connect_error();
	}else{
		header("Location:?modules=products&action=all");
	}
	// header("Location:?modules=products&action=all");
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	
}
require_once 'template/footer.php';
?>
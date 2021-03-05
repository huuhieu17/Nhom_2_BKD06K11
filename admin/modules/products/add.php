<?php 
require_once 'template/header.php'; ?>
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
	<input type="text" name="name" placeholder="Name products">
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
			echo "<option value='".$key['id']."'>".$key['name']."</option>";
		}
		
	?>
	</select>
	Brand:
	<select name="brand" id="">
	<?php 
		$sql = "SELECT * FROM brands"; // get brands
		$query = mysqli_query($connection,$sql);
		foreach ($query as $key) {
			echo "<option value='".$key['id']."'>".$key['name']."</option>";
		}
		
	?>
	</select>
	Price:
	<input type="number" name="price">
	Color:
	<div class="color">
		<?php 
			$sql = " SELECT * FROM variant_value WHERE variant_group_id = 1 ";
			$query = mysqli_query($connection,$sql);
			foreach ($query as $key) {
				$id = $key['id'];
				echo "<input type='checkbox' readonly name='color[ ]' value='$id'> ". $key['value']. " ";
			}
		?>
	</div>
	
	Status:
	<select name="status" id="">
		<option value="1">Available</option>
		<option value="0">Not Available</option>
		<option value="2">Contact</option>
	</select>
	Image:
	<div class="input-images-1 imgup">
		
	</div>
	
    <textarea name="editor1" class="ckedit"></textarea>
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
	$sql = "INSERT INTO products VALUES(NULL,'$name','$gender','$price','$description','$brand','$type','$status')";

	mysqli_query($connection,$sql);	
	$sql = "SELECT id FROM products order by id DESC LIMIT 1";
	$id = mysqli_fetch_assoc(mysqli_query($connection,$sql));
	$id = $id['id'];
	$color = array(1,2,3,4,5,6,7,8,9,10,11);
	for ($i=0; $i < sizeof($color) ; $i++) { 
		$sql = "INSERT INTO product_variants VALUES(NULL,'$id','$color[$i]','1')";
		$query=mysqli_query($connection,$sql);
		if (!$query) {
			echo "Error:".mysqli_error($connection);
		}
	}
	$color = array();
			$color = $_POST['color'];
			for ($i=0; $i < count($color); $i++) { 
				if (isset($_POST['color'])) {
					$sql = "UPDATE product_variants SET status =1 WHERE product_id ='$id' AND product_variant_value_id ='$color[$i]' AND product_variant_value_id <= 11";
					mysqli_query($connection,$sql);
				}
				$sql = "UPDATE product_variants SET status = 0 WHERE product_id = '$id' AND product_variant_value_id <= 11 AND product_variant_value_id NOT IN (".implode(',',array_map('intval',$color)).") ";
					mysqli_query($connection,$sql);
					
	}
	$size = array(12,13,14,15,16,17);
	$sql = "SELECT * FROM product_variants WHERE product_id ='$id' AND status = 1";
	$query = mysqli_query($connection,$sql);
	foreach ($query as $keycolor ) {
		$color_id = $keycolor['product_variant_value_id'];
		for ($i=0; $i < count($size); $i++) { 
			$sku = "P".$id."C".$color_id."S".$size[$i];
			$sql= "INSERT INTO sku VALUES(NULL,'$id','$sku','$color_id','$size[$i]',0)";
			mysqli_query($connection,$sql);	
		}
	}
	
	// size
	
	
	if (count($_FILES['images']['name']) > 0) {
		$total = count($_FILES['images']['name']);
		for ($i=0 ; $i <$total  ; $i++ ) { 
			$fileName = $_FILES['images']['name'][$i];
			$ext = explode('.', $_FILES['images']['name'][$i]);
			$ext = $ext[count($ext)-1];
			$newname = 'product_'.$id."_".$i.".".$ext;
			$newdir = $dir.$newname;
			$oldname = $dir.$fileName;
			move_uploaded_file($_FILES['images']['tmp_name'][$i], $oldname);
			rename($oldname, $newdir);
			$sql = "INSERT INTO products_images VALUES($id,'$newname')";
			echo $sql;
			mysqli_query($connection,$sql);
			header("Location:?modules=products&action=all");
		}
	}else{
		header("Location:?modules=products&action=all");
	}
		header("Location:?modules=products&action=all");
	
	//
	
	// $sql = "INSERT INTO products VALUES(NULL,'$id','$name','','$price','$description','$brand','$type','$status')";
	// $query = mysqli_query($connection,$sql);
	// if (!$query) {
	// 	echo "Error: ". mysqli_connect_error();
	// }else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	// }
}
require_once 'template/footer.php';
?>
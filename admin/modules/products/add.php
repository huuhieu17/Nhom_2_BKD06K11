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
	Image:
	<div class="input-images-1">
		
	</div>
	
    <textarea name="editor1"></textarea>
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
	$sql = "INSERT INTO products VALUES(NULL,'$name','$price','$description','$brand','$type','$status')";
	mysqli_query($connection,$sql);	
	$sql = "SELECT id FROM products order by id DESC LIMIT 1";
	$id = mysqli_fetch_assoc(mysqli_query($connection,$sql));
	$id = $id['id'];
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
			echo "<script>window.location.replace('?modules=products&action=all');</script>";
		}
	}else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
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
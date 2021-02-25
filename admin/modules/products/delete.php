<?php 
require_once 'template/header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
	$sql = "DELETE FROM product_variants WHERE product_id='$id'";
	$query = mysqli_query($connection,$sql);
	$sql = "DELETE FROM products_images WHERE id='$id'";
	$query = mysqli_query($connection,$sql);
	$sql = "DELETE FROM products WHERE id='$id'";
	$query = mysqli_query($connection,$sql);
	$sql = "DELETE FROM sku WHERE product_id='$id'";
	$query = mysqli_query($connection,$sql);
	

	if (!$query) {
		echo "Error",mysqli_connect_error();
	}else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	}


	
?>
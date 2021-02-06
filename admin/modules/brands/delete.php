<?php 
require_once 'template/header.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
	$sql = "DELETE FROM brands WHERE id='$id'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error",mysqli_connect_error();
	}else{
		echo "<script>window.location.replace('?modules=brands&action=all');</script>";
	}
?>
<?php 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
	$sql = "DELETE FROM products WHERE id='$id'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error",mysqli_connect_error();
	}else{
		echo "<script>window.location.replace('?modules=products&action=all');</script>";
	}
?>
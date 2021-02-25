<?php
require_once('customer/template/version1/header.php');
$subTitle = "Cart";
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	if (isset($_SESSION['cart'][$id])) {
		if (isset($_GET['up'])) {
			$_SESSION['cart'][$id] += 1;
		}else{
			$_SESSION['cart'][$id] -= 1;
			if ($_SESSION['cart'][$id] < 0) {
				$_SESSION['cart'][$id] = 0;
			}
		}
		
	}else{
		$_SESSION['cart'][$id] = 1;
	}
	header("Location:index.php?s=invoices&act=cart");
	// echo "<script>window.location.replace('')</script>";
}
?>
 <style>
 	table{
 		float: left;
 		width: 80%;
 	}
 	table,th,tr,td{
 		border: 1px solid #eee;
 		border-collapse: collapse;
 		text-align: center;
 	}
 	.btn-q{
 	padding: 5px;
 	border: 0;
 	margin: 5px;
 	font-weight: bold;

 	}
 	.imgcart{
 		width: 100px;
 		height: 70px;
 	}
 	.buy{
 		margin-left: 1%;
 		width: 18%;
 		float: left;
 		border: 1px solid #eee;
 	}
 	.buy button{
 		width: 100%;
 		background: none;
 		border: 1px solid #eee;
 		padding: 10px;
 		font-weight: bold;
 	}
 	.buy button:hover{
 		color: red;
 	}
 </style>
 <div class="cart">
 	<table>
 		<tr>
 			<th>No</th>
 			<th>Product</th>
 			<th>Price</th>
 			<th>Quantity</th>
 			<th>Total</th>
 		</tr>
 		
 		<?php
 		$count = 0;
 		$total = 0;
 		foreach ($_SESSION['cart'] as $id => $quantity) {
 			$count +=1;
 		 	$sql = "SELECT id,product_name,product_price FROM products WHERE id= '$id'";
 		 	$query = mysqli_query($connection,$sql);
 		 	$row = mysqli_fetch_assoc($query);
 		 	$product_id = $row['id'];
 		 	$img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id ='$product_id'"));
 		 	$name = $row['product_name'];
 		 	$price = $row['product_price'];
 		 	echo "<tr>";
 		 	echo "<td> $count </td>";
 		 	echo "<td>". $name ."<br><a href='?s=products&act=detail&id=$product_id'><img class='imgcart' src='./public/img/product/".$img['url']."'></a></td>";
 		 	echo "<td> $price $ </td>";
 		 	echo "<td>";
 		 	echo "<a href='?s=invoices&act=cart&id=$id&down'><button class='btn-q'>-</button></a>";
 		 	echo $quantity;
 		 	echo "<a href='?s=invoices&act=cart&id=$id&up'><button class='btn-q'>+</button></a>";
 		 	echo "</td>";
 		 	echo "<td>".($price * $quantity)."$ </td>";
 		 	$total += ($price * $quantity);
 		 	echo "</tr>";


 		 } 
 		?>
 		<tr>
 			<td colspan="4">Total Pay</td>
 			<td><?php echo $total ?> $</td>
 		</tr>
 				
 	</table>
 	<div class="buy">
 		<button onclick="window.location.replace('?s=home')">Continue Shopping</button><br>
 		<button onclick="window.location.replace('?s=invoices&act=checkout')">Pay</button>
 	</div>	

 </div>
 <?php 
require_once('customer/template/version1/footer.php'); ?>
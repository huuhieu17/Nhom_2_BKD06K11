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
	
}
if (isset($_SESSION['user'])) {
	$userid = $_SESSION['user']['id'];
	$user_sql = "SELECT name,phone,address FROM customers WHERE id = '$userid' ";
	$query = mysqli_query($connection,$user_sql);
	$userinfo = mysqli_fetch_assoc($query);
}

?>
 <style>
 	.cart{
 		height: 100vh;
 	}
 	table{
 		float: left;
 		width: 80%;
 	}

 	table,th,tr,td{
 		border: 1px solid #eee;
 		border-collapse: collapse;
 		text-align: center;
 	}
 	th{
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
 	.buy form input{
 		box-sizing: border-box;
 		width: 100%;
 		border:0;
 		border-bottom: 1px solid #eee;
 		border-top: 1px solid #eee;
 		padding: 10px;
 	}
 	span{
 		font-size: 13px;
 		color:#aaa;
 	}
 </style>
 <div class="cart">
 	<table>
 		<tr>
 			<th>No</th>
 			<th>Product</th>
 			<th>Detail</th>
 			<th>Price</th>
 			<th>Quantity</th>
 			<th>Total</th>
 			<th></th>
 		</tr>
 		
 		<?php
 		$count = 0;
 		$total = 0;
 		foreach ($_SESSION['cart'] as $id => $quantity) {
 			$count +=1;
 		 	$sql = "SELECT products.id,products.product_name, products.product_price, sku.sku, sku.color_id, sku.size_id,sku.quantity FROM sku INNER JOIN products WHERE sku.id = '$id' AND products.id = sku.product_id";
 		 	$query = mysqli_query($connection,$sql);
 		 	$row = mysqli_fetch_assoc($query);
 		 	$product_id = $row['id'];
 		 	$img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id ='$product_id'"));
 		 	$quantity_product = $row['quantity'];
 		 	if ($quantity > $quantity_product) {
 		 		$quantity = $quantity_product;
 		 	}
 		 	$name = $row['product_name'];
 		 	$price = $row['product_price'];
 		 	$color_id = $row['color_id'];
 		 	$size_id = $row['size_id'];
 		 	$getColor = mysqli_fetch_assoc(mysqli_query($connection,"SELECT value FROM variant_value WHERE id ='$color_id'"));
 		 	$getSize = mysqli_fetch_assoc(mysqli_query($connection,"SELECT value FROM variant_value WHERE id ='$size_id'"));
 		 	echo "<tr>";
 		 	echo "<td> $count </td>";
 		 	echo "<td>". $name ."<br><a href='?s=products&act=detail&id=$product_id'><img class='imgcart' src='./public/img/product/".$img['url']."'></a></td>";
 		 	echo "<td>";
 		 	echo "Product Code: ".$row['sku']."<br>";
 		 	echo "Color: ".$getColor['value']."<br>" ;
 		 	echo "Size: ".$getSize['value'];
 		 	echo "</td>";
 		 	echo "<td> $price $ </td>";
 		 	echo "<td>";

 		 	echo "<a href='?s=invoices&act=cart&id=$id&down'><button class='btn-q'>-</button></a>";
 		 	echo $quantity;
 		 	if ($quantity == $quantity_product) {
 		 		echo "<a href='#'><button class='btn-q' type='buttom'>+</button></a>";
 		 	}else{
 		 		echo "<a href='?s=invoices&act=cart&id=$id&up'><button class='btn-q'>+</button></a>";
 		 	}
 		 	
 		 	echo "</br>Quantity remaining:" .$quantity_product;
 		 	echo "</td>";
 		 	echo "<td>".($price * $quantity)."$ </td>";
 		 	$total += ($price * $quantity);
 		 	echo "<td>";
 		 		if (isset($_POST['btn'])) {
 		 			$id_cart = $_POST['id'];
 		 			unset($_SESSION['cart'][$id_cart]);
 		 			header("Location:index.php?s=invoices&act=cart");
 		 		}
 		 		echo "<form action='index.php?s=invoices&act=cart' method ='POST'>";
 		 			echo "<input type='hidden' name='id' value='$id'>";
 		 			echo "<button name='btn'>Remove</button>";
 		 		echo "</form>";
 		 	echo "</td>";
 		 	echo "</tr>";


 		 } 
 		?>
 		<tr>
 			<td colspan="6">Total Pay</td>
 			<td><?php echo $total ?> $</td>
 		</tr>
 				
 	</table>
 	<div class="buy">
 		<button onclick="window.location.replace('?s=home')">Continue Shopping</button><br>
 		<?php if (isset($_SESSION['user'])): ?>
 			<form action="index.php?s=invoices&act=checkout" method="POST">
 				<span>Receiver Name:</span>
 			<input type="text" placeholder="Name" name="receiver_name"value="<?php echo $userinfo['name'] ?>"><br>
 			<span>Receiver PhoneNumber:</span>
 			<input type="number" name="receiver_phone" placeholder="Phone" value="<?php echo $userinfo['phone'] ?>"><br>
 			<span>Receiver Address:</span>
 			<input type="text" name="receiver_address" placeholder="Address" value="<?php echo $userinfo['address'] ?>"><br>

 			<input type="hidden" name="total_amount" value="<?php echo $total ?>" >
 			<span>Receiver Note:</span>
 			<input type="text" name="receiver_note" placeholder="Note" value="">
 			<?php if ($total == 0): ?>
 				<button type ="button" name="btnCheckOut">Checkout</button>
 				<?php else: ?>
 			<button name="btnCheckOut">Checkout</button>
 			<?php endif ?>
 		</form>
 		<?php else: ?>
 			<Button onclick="window.location.replace('?s=home&act=login&checkout')">Login To Checkout</Button>
 		<?php endif ?>
 		
 	</div>	

 </div>
 <?php 
require_once('customer/template/version1/footer.php'); ?>
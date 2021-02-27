<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Checkout";
?>
<style>
	.checkout a{
		text-decoration: none;
		color: black;
		font-weight: bold;
	}
	.checkout{
		height: 100vh;
	}
</style>
<div class="checkout">
	<?php if (!isset($_SESSION['user'])): ?>
		<?php header("Location:?s=home&act=login&error=1"); ?>
		<?php else: ?>
			<h1>Checkout</h1>
			<?php 
				if (isset($_POST['btnCheckOut'])) {
					$id_customer = $_SESSION['user']['id'];
					$receiver_name = $_POST['receiver_name'];
					$receiver_phone = $_POST['receiver_phone'];
					$receiver_address = $_POST['receiver_address'];
					$receiver_note = $_POST['receiver_note'];
					$total_amount = $_POST['total_amount'];
					$sql = "INSERT INTO invoices VALUES (NULL,current_timestamp(),'$total_amount','$receiver_name','$receiver_phone','$receiver_address',1,'$id_customer',Null,'$receiver_note')";
					$query = mysqli_query($connection,$sql);
					if (!$query) {
						echo "Error:".mysqli_error($connection);
					}else{
						$id_invoice = mysqli_insert_id($connection);
						foreach ($_SESSION['cart'] as $id => $quantity) {
							$sql = "INSERT INTO invoices_detail VALUES('$id','$id_invoice','$quantity')";
							$query = mysqli_query($connection,$sql);
							if (!$query) {
								echo "Error: Please Contact Admin!";
							}
							//update quantity product
							$sql = "SELECT quantity FROM sku WHERE id='$id'";
							$getQuantity = mysqli_fetch_assoc(mysqli_query($connection,$sql));
							$pQuantity = $getQuantity['quantity'];
							$newQuantity = $pQuantity - $quantity;
							$sql = "UPDATE sku SET quantity ='$newQuantity' WHERE id='$id'";
							$query = mysqli_query($connection,$sql);
						}
						$_SESSION['id_invoice'] = $id_invoice;
					unset($_SESSION['cart']);

					}
				}
			?>
			<h1>Your Order Has Been Processed! </h1>
			<p>Thanks for shopping with us online! Your order has been successful processed!</p>
			<span>Order Number:</span><a href="?s=invoices&act=detail&id=<?php echo $_SESSION['id_invoice'] ?>">	#<?php echo $_SESSION['id_invoice'] ?></a>
	<?php endif ?>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
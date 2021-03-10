<?php 
require_once 'template/header.php';
$subTitle = "Invoice Detail";
$idAdmin = $_SESSION['admin']['id'];
if (isset($_GET['id'])) {
	$idOrder = $_GET['id'];
		$sql = "SELECT invoices.id,invoices.create_at,invoices.receiver,invoices.phone,invoices.total_amounts,invoices.address,invoices.status,invoices.note,invoices_detail.id_product,invoices.id_customer,invoices_detail.quantity,sku.id,sku.sku,sku.color_id,sku.size_id,products.product_name,invoices.id_admin FROM invoices INNER JOIN invoices_detail INNER JOIN sku INNER JOIN products WHERE invoices.id = '$idOrder' AND invoices_detail.id_product = sku.id AND sku.product_id = products.id AND invoices_detail.id_invoices = invoices.id";
			$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error:";
	}else if (mysqli_num_rows($query) == 0) {
		header("Location:?s=home");
	}else{
			$data = mysqli_fetch_assoc($query);
				$size = $data['size_id'];
	$color = $data['color_id'];
	$nameSize = mysqli_fetch_assoc(mysqli_query($connection,"SELECT value FROM variant_value WHERE id='$size'"));
	$nameColor = mysqli_fetch_assoc(mysqli_query($connection,"SELECT value FROM variant_value WHERE id='$color'"));
	}

	
}
if (isset($_POST['status'])) {
	$status = $_POST['status'];
	$sql = "UPDATE invoices SET status = '$status',id_admin = '$idAdmin' WHERE id = '$idOrder'";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo 'Error!';
	}else{
		echo "<script>window.location.replace('?modules=invoices&action=viewDetail&id=$idOrder')</script>";
	}
}
?>
<style>
	.detail{
		box-sizing: border-box;
		width: 100%;
		height: 100vh;
		padding: 10px;
	}
	.detail h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	.detail .info{
		padding: 20px;
	}
	.detail .info span{
		font-weight: bold;
		font-size: 15px;
	}
	.detail table{
		margin: auto;
		padding: 20px;
		width: 100%;
		box-sizing: border-box;
	}
	.detail table,tr,th,td{
		box-sizing: border-box;
		text-align: center;
		border:1px solid #eee;
		border-collapse: collapse;
	}
</style>
<div class="detail">
	<h1>Order Detail</h1>
	<hr>
	<h4> Order Information</h4>
	<div class="info">
		<p><span>Order Number:</span> <?php echo $idOrder ?></p>
	<p><span>Created At:</span> <?php echo date("F j, Y H:i a", strtotime($data['create_at'])); ?></p>
	<p><span>Receiver Name:</span><?php echo $data['receiver'] ?> </p>
	<p><span>Phone:</span><?php echo $data['phone'] ?> </p>
	<p><span>Address:</span> <?php echo $data['address'] ?> </p>
	<p><span>Order Status:</span>
		<?php 
					switch ($data['status']) {
						case '1':
							echo "Pending ";
							break;
						case '2':
							echo "Approved";
							break;
						case '3':
							echo "Completed";
							break;
						case '0':
							echo "Cancelled";
							break;
						default:
							# code...
							break;
					}
		?>
		<form action="#" method="POST">
			Action:
			<select name="status" id="" onchange="this.form.submit();">
				<?php if ($data['status'] == 1): ?>
					<option value="1" selected="">Pending</option>
					<?php else: ?>
						<option value="1">Pending</option>
				<?php endif ?>
				<?php if ($data['status'] == 2): ?>
					<option value="2" selected="">Approved</option>
					<?php else: ?>
						<option value="2">Approved</option>
				<?php endif ?>
				<?php if ($data['status'] == 3): ?>
					<option value="3" selected="">Completed</option>
					<?php else: ?>
						<option value="3">Completed</option>
				<?php endif ?>
				<?php if ($data['status'] == 0): ?>
					<option value="0" selected="">Cancelled</option>
					<?php else: ?>
						<option value="0">Cancelled</option>
				<?php endif ?>

				
			</select>
		</form>
	</p>
	<p><span>Admin Modify:</span><?php echo $data['id_admin']; ?></p>
	</div>
	
	<h4> Order Detail</h4>
		<table>
			<tr>
				<th>Product</th>
				<th>Detail</th>
				<th>Quantity</th>
				
			</tr>
			<?php foreach ($query as $total => $show): ?>
				<tr>
					<td> <?php echo $show['product_name'] ?></td>
					<td>Sku:<?php echo $show['sku'] ?><br>
						Size: <?php echo $nameSize['value'] ?><br>
						Color: <?php echo $nameColor['value'] ?>
					</td>
					<td>
						<?php echo $show['quantity'] ?>
					</td>
				</tr>
					
			<?php endforeach ?>
			<tr>
					<th>Total Amout</th>
					<td colspan="2" style="color: red;font-weight: bold;"><?php echo number_format($show['total_amounts'],0,'','.'); ?>$</td>	
				</tr>
		</table>
		<script>
			function cancelOrder() {
			var msg;
			var r =	confirm("Do You Want Cancel This Order ?");
				if( r == true){
					document.location.replace('?s=invoices&act=detail&id=<?php echo $idOrder ?>&action=Cancel');
				}else{
					alert('Opps!');
				}
			}
		</script>
		<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</div>	
<?php 
		require_once 'template/footer.php';
?>
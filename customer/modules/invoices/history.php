<?php
require_once('customer/template/version1/header.php');
$subTitle = "Order History";
$_SESSION['choose']=$_SESSION['from']=$_SESSION['to']="";
if (!isset($_SESSION['user']['id'])) {
	header("Location:?s=home");
}
$id_customer = $_SESSION['user']['id'];
$check1 = $check2 = $check3 = $check4 = $check5 = "";

if(isset($_GET['paid'])) {
	$ii=$_GET['paid'];
		$ii=trim($ii);
		$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' AND status = $ii ";
		if($ii ==5){
			$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' ";
		}

		$check = $ii;
		if(isset($_GET['daddy'])){
			if(isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])){
				$from=$_GET['from'];
				$to=$_GET['to'];
				$sql.=" and create_at between '".$from."' and '". $to."' ";
			}
		}
}
else if(!isset($_GET['daddy'])){
	$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' ";
}
else{
	$sql = "SELECT * FROM invoices WHERE id_customer = '$id_customer' ";
}
if (!isset($_GET['page'])) {
	$present_page = 1;
}else{
	$present_page = $_GET['page'];
}
$query = mysqli_query($connection,$sql); // get numinvoices
$totalInvoices = mysqli_num_rows($query);
$limit = 20;
$totalPage = ceil($totalInvoices/$limit);
$skip = ($present_page - 1)*$limit;
$sql = $sql. " ORDER BY id DESC LIMIT $limit OFFSET $skip";
$query = mysqli_query($connection,$sql);
echo $sql;
?>
<style>
	.historyCart{
		width: 100%;
	}
	.historyCart #cleft{
		width: 17%;
		float: left;
		border-right: 1px solid #eee;
	}
	.historyCart #cleft form{
		padding: 14px;
	}
	.historyCart #cright{
		width: 82%;
		float: left;
	}
	.historyCart #cright table{
		text-align: center;
		width: 100%;
	}
	.historyCart table,tr,td,th{
		border:1px solid #eee;
		border-collapse: collapse;
	}
	h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	@media only screen and (max-width: 768px){
		.historyCart #cleft{
			width: 100%;
		}
		.historyCart #cright{
			width: 100%;
		}
	}
</style>
<div class="historyCart">
	<h1>Order History</h1>
	<hr>
	<h4> Order History Information</h4>
	<div id="cleft">
		<form action="index.php?s=invoices&act=history&" method="GET">
			<input type="hidden" name="s" value="invoices">
			<input type="hidden" name="act" value="history">
			<input type="radio" name="paid" <?php if(isset($check) && $check ==5) echo "checked"; ?> value="5">All <br>
			<input type="radio" name="paid" <?php if(isset($check) && $check ==1) echo "checked"; ?> value="1">Pending <br>
			<input type="radio" name="paid" <?php if(isset($check) && $check ==2) echo "checked"; ?> value="2">Approved <br>
			<input type="radio" name="paid" <?php if(isset($check) && $check ==3) echo "checked"; ?> value="3">Completed <br>
			<input type="radio" name="paid" <?php if(isset($check) && $check ==0) echo "checked"; ?> value="0">Cancelled <br>
			Search From : <br>
			<input type="date" name="from" value="<?php if(isset($from) && !empty($from)){ echo $from;} else{echo "";} ?>" required=""><br>
			To: <br>
			<input type="date" name="to" value="<?php if(isset($to) && !empty($to)){ echo $to;} else{echo "";} ?>" required=""><br>
			<input type="Submit" name="daddy">
		</form>
		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>
		</script>
		<script>
			$('input[name=paid]').change(function(){
				$('form').submit();

			});
		</script>
	</div>
	<div id="cright">
		<table>
			<tr>
				<th>Id</th>
				<th>Total Amount</th>
				<th>Time</th>
				<th>Receiver</th>
				<th>Phone</th>
				<th>Address</th>
				<th>Status</th>
				<th></th>
			</tr>
			<?php foreach ($query as $row): ?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo number_format($row['total_amounts'],0,'','.')." $"; ?></td>
					<td><?php echo date("F j, Y H:ia", strtotime($row['create_at'])); ?></td>
					<td><?php echo $row['receiver'] ?></td>		
					<td><?php echo $row['phone'] ?></td>		
					<td><?php echo $row['address'] ?></td>
					<td>
						<?php 
						switch ($row['status']) {
							case '1':
							echo "Pending";
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
					</td>
					<td><a href="?s=invoices&act=detail&id=<?php echo $row['id'] ?>">View Detail</a></td>		
				</tr>	
			<?php endforeach ?>
			<tr>
				<td colspan="5">
					Page: 
					<?php
					$paid = "";
					if (isset($_GET['paid'])) {
						$paid = $_GET['paid'];
					}
					else{
						$paid=5;
					}
					for ($i=1; $i <= $totalPage ; $i++) { 
  						if(!isset($from) && !isset($to)){
  							echo "<a href='?s=invoices&act=history&paid=".$paid."&page=$i&daddy=Submit'>".$i."</a>";
  						}
  						else{
  							echo "<a href='?s=invoices&act=history&paid=".$paid."&page=$i&from=$from&to=$to&daddy=Submit'".">".$i."</a>";
  						}
						

					} ?>
				</td>
			</tr>
		</table>
	</div>
	
	
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
<?php 
require_once 'template/header.php';
$sql = "SELECT * FROM invoices";
$filter = "";
if (isset($_GET['filter'])) {
	$filter = $_GET['filter'];
	if ($filter == "") {
		$sql = $sql;
	}else{
		$sql = $sql." WHERE status = ".$filter." ";
		if (isset($_GET['idc'])) {
			
		}
	}
}


if (!isset($_GET['page'])) {
	$present_page = 1;
}else{
	$present_page = $_GET['page'];
}
$num1 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 1"));
$num2 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 2"));
$num3 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 3"));
$num4 = mysqli_num_rows(mysqli_query($connection,"SELECT * FROM invoices WHERE status = 0"));
$query = mysqli_query($connection,$sql);
$totalInvoices = mysqli_num_rows($query);
$limit = 20;
$totalPage = ceil($totalInvoices/$limit);
$skip = ($present_page - 1)*$limit;
if (isset($_GET['btn']) || isset($_GET['from'])) {
	$from = $_GET['from'];
	$to = $_GET['to'];
	if (empty($from) || empty($to)) {
		echo 'Error ! You must fill all the field';
	}else{
		if ($_GET['filter'] == "") {
			$sql = $sql. " WHERE create_at BETWEEN '". $from . "' AND '". $to . "' ORDER BY id DESC LIMIT $limit OFFSET $skip";
		}else{
			$sql = $sql. " AND create_at BETWEEN '". $from . "' AND '". $to . "' ORDER BY id DESC LIMIT $limit OFFSET $skip";
		}
		
	}
}else{
	$sql = $sql. " ORDER BY id DESC LIMIT $limit OFFSET $skip";
}
$query = mysqli_query($connection,$sql);
?>
<style>
	a.nav{
		color: gray;
		font-weight: bold;
	}
	#contents{
		height: 100vh;
	}
	.invoices{
		width: 100%;
		height: 100%;
	}
	table{
		padding: 10px;
	}
	table{
		width: 80%;
		margin: auto;
	}
	table,th,tr,td{
		border: 1px solid #eee;
		border-collapse: collapse;
	}
	table tr td a{
		text-decoration: underline;
	}
	#filter{
		text-align: center;
		margin: auto;
	}
	#filter button{
		padding: 4px;
	}
	h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	@media only screen and (max-width: 768px){
		table{
			width: 100%;
		}
	}
</style>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=invoices&action=manage">Invoices</a>
<div class="invoices">
	<h4>Invoices</h4>
	<table>
		<tr>
			<td colspan="6" id="filter">
				<button name="btn"><a href="?modules=invoices&action=manage&filter= ">All</a></button>
				<button name="btn"><a href="?modules=invoices&action=manage&filter=1">Pending (<?php echo $num1?>)</a></button>
				<button name="btn"><a href="?modules=invoices&action=manage&filter=2">Approved (<?php echo $num2?>)</a></button>
				<button name="btn"><a href="?modules=invoices&action=manage&filter=3">Completed (<?php echo $num3?>)</a></button>
				<button name="btn"><a href="?modules=invoices&action=manage&filter=0">Cancelled (<?php echo $num4?>)</a></button>
			</td>

		</tr>
		<tr>
			<td colspan="6" > 
				<form action="" method="GET">
					<input type="hidden" name="modules" value="invoices">
					<input type="hidden" name="action" value="manage">
					<input type="hidden" name="filter" value="<?php echo $filter ?>">
					<center>
						<?php 
						if (isset($_GET['from']) && isset($_GET['to'])) {
							$from = $_GET['from'];
							$to = $_GET['to'];
						}else{
							$from = $to = "";
						}
						?>
						IDC: <input type="number" name="idc">
						From: <input type="date" name="from" value="<?php echo $from ?>" required> To: <input type="date" name="to" value="<?php echo $to ?>" required>
						<input type="submit" name="btn" value="Search">
					</center>

				</form>
			</td>
		</tr>		
		<tr>
			<th>Id</th>
			<th>Created At</th>
			<th>Receiver</th>
			<th>Total Amount</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php if (mysqli_num_rows($query)): ?>
			<?php foreach ($query as $value): ?>
			<tr>
				<td><?php echo $value['id']; ?></td>
				<td><?php echo date("F j, Y H:i:a", strtotime($value['create_at']));?></td>
				<td><?php echo $value['receiver']; ?> ( IDC: <?php echo $value['id_customer']; ?>)</td>
				<td><?php echo $value['total_amounts']; ?></td>
				<td><?php switch ($value['status']) {
					case 0:
						echo 'Cancelled';
						break;
					case 1:
						echo 'Pending';
						break;
					case 2:
						echo 'Approved';
						break;
					case 3:
						echo 'Completed';
						break;
					
					default:
						// code...
						break;
				} ?></td>
				<td><a href="?modules=invoices&action=viewDetail&id=<?php echo $value['id'] ?>">ViewDetail</a></td>
			</tr>		
		<?php endforeach ?>
		<?php endif ?>
		
		<tr>
			<td colspan="6">
				Page: 
				<?php
				if (isset($_GET['from']) && isset($_GET['to'])) {
					$from = $_GET['from'];
					$to = $_GET['to'];
				}else{
					$from = $to = "";
				}
				for ($i=1; $i <= $totalPage ; $i++) { 
  // /?s=products&act=search&keyword=&sort=&type=&brand=
					if (isset($_GET['from']) && isset($_GET['to'])) {
						echo "<a href='?modules=invoices&action=manage&filter=$filter&page=$i&from=$from&to=$to'>".$i."</a>";
					}else{
						echo "<a href='?modules=invoices&action=manage&filter=$filter&page=$i'>".$i."</a>";							}

					} ?>
				</td>
			</tr>
		</table>	
	</div>
	<?php 
	require_once 'template/footer.php';
	?>
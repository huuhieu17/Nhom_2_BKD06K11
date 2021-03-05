<?php 
require_once 'template/header.php';
if (!isset($_GET['page'])) {
	$present_page = 1;
}else{
	$present_page = $_GET['page'];
}
$keyword= "";
if (isset($_POST['search'])) {
	$keyword = $_POST['keyword'];
	if (isset($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	}
}
$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'"; //get numproduct
$query = mysqli_query($connection,$sql);
$numproduct = mysqli_num_rows($query);
$limit = 4;
$numpage = ceil($numproduct/$limit);
$skip = ($present_page - 1)* $limit;
$sql = "SELECT * FROM products LIMIT $limit OFFSET $skip";
if (isset($_GET['keyword'])) {
	$keyword = $_GET['keyword'];
	$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%' LIMIT $limit OFFSET $skip";
}else{
	$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%' LIMIT $limit OFFSET $skip";
}


$query = mysqli_query($connection,$sql);
if (!$query) {
	echo "Error :". mysqli_connect_error();
}
?>
<style>
	#contents{
		height: 100vh;
	}
	a.nav{
		color: gray;
		font-weight: bold;
	}
	a#add{
		font-weight: bold;
		text-decoration: underline;
	}
	.imgpdct{
		width: 50px;
		height: 70px;
	}
	table{
		margin: auto;
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 80%;
	}
	td,th {
		border: 1px solid #eee;
		padding: 8px;
	}

	tr:hover {background-color: #eee;}

	th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;	
		color: black;
	}
	td a{
		font-weight: bold;
	}
</style>
<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=products&action=all">Products</a><br><br>
<h1>Manage Products</h1>

<table>
	<tr>
		<td colspan="6" border="0">
			<a id="add" href="?modules=products&action=add">Add new product</a>
	<form action="" method="POST">
		<input type="text" name="keyword" placeholder="Name Product"><button name="search">Search</button>
	</form>	
		</td>
		
	</tr>
	
	<tr>
		<th>Id</th>
		<th>Product</th>
		<th>Price</th>
		<th>Status</th>
		<th colspan="2">Action</th>
	</tr>
	<?php 

	foreach ($query as $row) {
		$id = $row['id'];
		$img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id = '$id'"));
		$result = "";
		switch ($row['product_status']) {
			case '0':
			$result = 'Not Available';
			break;
			case '1':
			$result = 'Available';
			break;
			case '2':
			$result = 'Comming Soon';
			break;
			default:
				# code...
			break;
		}
		echo "<tr>";
		if (mysqli_num_rows($query) == 0) {
			echo "<td colspan='5'>No record!</td>";
		}
		echo "<td>".$row['id']."</td>";
		echo "<td align='center'><b>".$row['product_name']."</b><br><img class='imgpdct' src='../public/img/product/".$img['url']."'>"."</td>";
		echo "<td>".$row['product_price']."</td>";
		echo "<td>".$result."</td>";
		echo "<td class='action'><a href='?modules=products&action=edit&id=$id'><i class='fa fa-pencil'></i>Edit</a></td>";
		echo "<td class='action'><a href='?modules=products&action=delete&id=$id'><i class='fa fa-times-circle'></i>Delete</a></td>";
		echo "</tr>";
	}
	?>
</table>
Page: 
<?php 

for ($i=1; $i <= $numpage ; $i++) { 
	echo "<a href='?modules=products&action=all&page=".$i."&keyword=".$keyword."'>".$i."</a>";

}
require_once 'template/footer.php';
?>
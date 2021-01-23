

<a class="nav"href="?modules=common&action=home">Home</a>/<a class="nav" href="?modules=brands&action=all">Brands</a><br><br>
<h1>Manage Brands</h1>
<a id="add" href="?modules=brands&action=add">Add new brand</a>

<style>
	a.nav{
		color: gray;
		font-weight: bold;
	}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
a#add{
	font-weight: bold;
	text-decoration: underline;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: gray;
  color: white;
}
td a{
	font-weight: bold;
}
.action{
	text-align: center;
}
</style>

<table id="customers">
	<tr>
		<th>ID</th>
		<th>Brand name</th>
		<th colspan="2">Action</th>
	</tr>
	<?php 
	$sql = "SELECT * FROM brands";
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo "Error",mysqli_connect_error();
	}else if (mysqli_num_rows($query) == 0) {
		$result = "No record!";
	}else{
		foreach ($query as $key) {
			$id = $key['id'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$key['name']."</td>";
			echo "<td class='action'><a href='?modules=brands&action=edit&id=$id'><i class='fa fa-pencil'></i>Edit</a></td>";
			echo "<td class='action'><a href='?modules=brands&action=delete&id=$id'><i class='fa fa-times-circle'></i>Delete</a></td>";
			echo "</tr>";
		}
	}
	?>
</table>
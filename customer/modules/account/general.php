<?php 
	require_once('customer/template/version1/header.php');
$subTitle = "Account Infomation";
?>
<style>
	.all{
    display: block;
    overflow: hidden;
    box-sizing: border-box;
    width: 100%;
    height: 100vh;
    border-top: 1px solid #eee;

  }
  .side{
    width: 15%;
    height: 100%;
    border-right: 1px solid #eee;
    box-sizing: border-box;
    float: left;
  }
  .center{
    box-sizing: border-box;
      height: 100%;
      margin: auto;
      text-align: center;
      
    width: 83%;
    float: left;
  }
  .side span{
  	box-sizing: border-box;
  width: 100%;
  display: block;
  padding: 10px;
  border-bottom: 1px solid #eee;
  }
  .side span a{
  	color: black;
  	text-decoration: none;
  }
  .side span a:hover{
  	font-weight: bold;
  }
  table,tr,td,th{
  	text-align: left;
  	padding: 3px;
  	margin:auto;
  	width: 70%;
  	border: 1px solid #eee;
  	border-collapse: collapse;
  }
  table tr td.col1{
  	width: 10%;
  	font-style: italic;
  	font-weight: bold;
  	text-align: left;
  }
  table tr td button{
    padding: 10px;
    color: black;
    font-weight: bold;
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
    .side{
      width: 100%;
      height: auto;
    }
    .center{
      width: 100%;
    }
    table{
      width: 100%;
    }
    table tr td input{
      width: 70%;
    }
  }
</style>
<div class="all">
	<div class="side">
		<center><h3>Account</h3><hr></center>
		<span><a href="?s=account&act=general"> > General</a></span>
		<span><a href="?s=invoices&act=history"> > Invoices</a></span>
		<span><a href="?s=account&act=changepw"> > Change Password</a></span>
	</div>
	<div class="center">
    <h4>General</h4>
		<table>
			<tr>
				<td colspan="2"><h2>Account Information</h2></td>
			</tr>
			<?php 
			$iduser =  $_SESSION['user']['id'];
				$query = mysqli_query($connection,"SELECT * FROM customers WHERE id = $iduser");
				
				$value = mysqli_fetch_assoc($query);
			?>
			<tr>
				<td class="col1">Name:</td>
				<td><?php echo $value['name'] ?></td>
			</tr>		
			<tr>
				<td class="col1">Username:</td>
				<td><?php echo $value['username'] ?></td>
			</tr>
			<tr>
				<td class="col1">Gender:</td>
				<td ><?php if ($value['gender'] == 0): ?>
					<?php echo "Female" ?>
					<?php else: ?>
						<?php echo "Male" ?>
				<?php endif ?></td>
			</tr>
			<tr>
				<td class="col1">Email:</td>
				<td><?php echo $value['email'] ?></td>
			</tr>		
			<tr>
				<td class="col1">Phone:</td>
				<td><?php echo $value['phone'] ?></td>
			</tr>
			<tr>
				<td class="col1">Address:</td>
				<td><?php echo $value['address'] ?></td>
			</tr>
			<tr>
				<td colspan="2"><a href="?s=account&act=edit"><button>Edit</button></a></td>
			</tr>		
		</table>
	</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
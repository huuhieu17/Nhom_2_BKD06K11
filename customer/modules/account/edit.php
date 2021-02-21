<?php 
	require_once('customer/template/version1/header.php');
$subTitle = "Account Infomation";
$iduser =  $_SESSION['user']['id'];
if (isset($_POST['btn'])) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $sql = "UPDATE customers SET name = '$name',gender = '$gender', email = '$email', phone = '$phone', address = '$address' WHERE id ='$iduser' ";
  
  $query = mysqli_query($connection,$sql);
  $_SESSION['user']['name'] = $name;
  if (!$query) {
    echo "Error". mysqli_connect_error($query);
  }else{
    echo "<script>
    window.location.replace('?s=account&act=general');
    </script>";
  }
}
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
  table tr td input{
    padding: 10px;
    width: 50%;
    color: black;
  }
  form {
    padding: 10px;
  }
  table tr td button{
    padding: 10px;
    color: black;
    font-weight: bold;
  }
</style>
<div class="all">
	<div class="side">
		<center><h3>Account</h3><hr></center>
		<span><a href="#"> > General</a></span>
		<span><a href="#"> > Invoices</a></span>
		<span><a href="#"> > Change Password</a></span>
	</div>
	<div class="center">
			<?php 
			$iduser =  $_SESSION['user']['id'];
				$query = mysqli_query($connection,"SELECT * FROM customers WHERE id = $iduser");
				
				$value = mysqli_fetch_assoc($query);
			?>
		  <form action="#" method="POST">
       <table>
        <tr><td colspan="2"><h2>Update Information</h2></td></tr>
         <tr>
           <td class="col1">Username</td>
           <td><?php echo $value['username'] ?></td>
         </tr>
         <tr>
           <td class="col1">Name</td>
           <td><input type="text" name="name" placeholder="Name" value="<?php echo $value['name'] ?>"></td>
         </tr>
         <tr>
           <td class="col1">Gender</td>
           <td><select name="gender" id="">
             <option value="0">Female</option>
             <option value="1">Male</option>
           </select></td>
           
         </tr>
         <tr>
           <td class="col1">Email</td>
           <td>
             <input type="email" name="email" placeholder="Email" value="<?php echo $value['email'] ?>">
           </td>
         </tr>
         <tr>
           <td class="col1">Phone</td>
           <td><input type="text" name="phone" placeholder="Phone Number" value="<?php echo $value['phone'] ?>"></td>
         </tr>
         <tr>
           <td class="col1">Address</td>
           <td><input type="text" name="address" placeholder="Address" value="<?php echo $value['address'] ?>"><span></span>
           </td>
         </tr>
         <tr><td colspan="2"><Button name="btn">Update</Button></td></tr>
       </table> 

      </form>
	</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
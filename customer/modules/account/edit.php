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
  	padding: 1px;
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
         <tr>
           <td>Username</td>
           <td><input type="" name="" placeholder="Username" value="<?php echo $value['username'] ?>"></td>
         </tr>
         <tr>
           <td>Name</td>
           <td><input type="text" name="name" placeholder="Name" value="<?php echo $value['name'] ?>"></td>
         </tr>
         <tr>
           <td>Gender</td>
           <td><select name="gender" id="">
             <option value="0">Female</option>
             <option value="1">Male</option>
           </select></td>
           
         </tr>
         <tr>
           <td>Email</td>
           <td>
             <input type="email" name="email" placeholder="Email" value="<?php echo $value['email'] ?>">
           </td>
         </tr>
         <tr>
           <td>Phone</td>
           <td><input type="text" name="phone" placeholder="Phone Number" value="<?php echo $value['phone'] ?>"></td>
         </tr>
       </table> 

      </form>
	</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
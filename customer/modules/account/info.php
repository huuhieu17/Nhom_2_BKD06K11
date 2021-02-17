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
</style>
<div class="all">
	<div class="side">
		<center><h3>Account Infomation</h3><hr></center>
	</div>
	<div class="center"></div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
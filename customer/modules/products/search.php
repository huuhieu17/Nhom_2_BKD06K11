<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Search";
?>
<style type="text/css">
	.scontent{
		margin-top:6%;
	}
	.new{
 box-sizing: border-box;
    height: 100%;
    padding: 0;
    width: 100vw;
    margin: auto;
    text-align: center;
    flex-flow: row wrap;
    display: flex;
    flex-direction: row;
}
.new:after{
  content: "";
  display: table;
  clear: both;
}
.item{
  box-sizing: content-box;
  text-align: center;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  float: left;
  width: 23%;
  padding: 10px;
  margin: auto;
  height: 500px;
}

.item:hover{
  transition: 0.1s;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  background: black;
  border-radius: 2px;
  color: white;
}
.item:hover .view img{
  background: black;
  opacity: 0.5;
  transition: 0.2s;
}
.item:hover .view{
  text-decoration: none;
  color: white;
}
.item img{
  width: 100%;
  height: 80%;
}
.view{
  text-decoration: none;
  color: black;
}
</style>
<h1>Search</h1><br>
<hr>
<div class="scontent">
	<div class="new">

     <?php
     	if (isset($_GET['id'])) {
     		$keyword = $_GET['id'];
     	 	$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'";
     	 }else{
     	 	 $sql = "SELECT * FROM products";
     	 } 
        $query = mysqli_query($connection,$sql);
        if (!$query) {
          echo "Error: ". mysql_connect_error();
        }else if (mysqli_num_rows($query) == 0) {
          echo "No result for ".$keyword;
        }else{
          foreach ($query as $key) {
            $id = $key['id'];
            $img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id = '$id'"));

            echo "<div class='item'>";
             echo "<a class='view' href='?s=products&act=detail&id=$id'>";
              echo "<img src='./public/img/product/".$img['url']."'>";
              echo "<b>".$key['product_name']."</b><br><br>";
                  echo "<b><p style='color:red'>".$key['product_price']."$</p></b>";
              echo "<a class='view' href='?s=products&act=detail&id=$id'>";
            echo "</div>";
          }
        }
      ?>
 
</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>

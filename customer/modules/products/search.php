<style type="text/css">
	.scontent{
		margin-top:6%;
	}
	.new{
  padding: 10px;
  flex-direction: row;
  display: flex;
  flex-wrap: wrap;
  box-sizing: border-box;
  width: 100%;
  margin-top: 0%;
}
.item{
  text-transform: uppercase;
  margin:10px;
  box-sizing: border-box;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  text-align: center;
  flex: 20%;
  width: 25%;
}
.item:hover{
  transition: 0.1s;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  border: 2px solid gray;
  border-radius: 2px;
}
.item img{
  width: 100%;
  height: 400px;
}
</style>
<h1>Search</h1><br>
<hr>
<div class="scontent">
	<div class="new">

     <?php
     	if (isset($_GET['keyword'])) {
     		$keyword = $_GET['keyword'];
     	 	$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword'";
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
            echo "<div class='item'>";
              echo "<img src='./public/img/product/".$key['product_images']."'>";
              echo "<b>".$key['product_name']."</b><br><br>";
                  echo "<b><p style='color:red'>".$key['product_price']."$</p></b>";
            echo "</div>";
          }
        }
      ?>
 
</div>
</div>

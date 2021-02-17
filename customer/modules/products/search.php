<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Search";
$keyword= "";
$keyword = $_GET['keyword'];
?>
<style type="text/css">
	.scontent{
    display: block;
    overflow: hidden;
		width: 100vw;
    height: auto;
	}
	.new{
 box-sizing: border-box;
    height: 100%;
    padding: 0;
    width: 83%;
    float: left;
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
.side{
  border-right: 1px solid black;
  width: 15%;
  float: left;
  height: 100%;
}
.side ul{
  float: none;
  width: 100%;
}
.side li{
  float: none;
  display: block;
  width: 100%;
}

.item{
  box-sizing: content-box;
  text-align: center;
  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
  float: left;
  width: 20%;
  padding: 10px;
  margin: auto;
  height: 400px;
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
.side form{
  width: 100%;
  box-sizing: border-box;
}
.side form span{
  box-sizing: border-box;
  width: 100%;
  display: block;
  padding: 10px;
  border-bottom: 1px solid black;
}
.side form span input{
  width: 80%;
  box-sizing: border-box;
  padding: 7px;
}
.side form span button{
  padding: 7px;
}
@media only screen and (max-width: 425px) {
  .new{
    width: 100%;
  }
  .item{
      height: 300px;
      width: 60%;
  }
   .item img{
    height: 60%;
  }
}
@media only screen and (max-width: 768px){
 .new{
    width: 100%;
  }
  .item{
      height: 350px;
      /*width: 60%;*/
  }
   .item img{
    height: 60%;
  }
  .side{
    display: none;
  }

}
.hidden{
  display: none;
}
</style>
<h1>Search</h1><br>
<hr>
<div class="scontent">
  <div class="side">
    <form action="index.php" method="GET">
      <input type="text" name="s" value="products" class="hidden">
      <input type="text" name="act" value="search" class="hidden">
       <span><input type="text" name="keyword" placeholder="Keyword" value="<?php echo $keyword ?>"><button><i class="fa fa-search"></i></button></span>
       <span>
          Price:
         <select name="sort" id="">
            <option value="">-----</option>
           <option value="1">Below 100$</option>
           <option value="2">100$ - 500$</option>
           <option value="3">500$ - 1000$</option>
           <option value="4">1000$ - 5000$</option>
           <option value="5">Under 5000$</option>
         </select>
       </span>

    </form>
   
  </div>
	<div class="new">

     <?php
     	if (isset($_GET['keyword'])) {
     		$keyword = $_GET['keyword'];
        //sort
        $sortsql = "";
        if (isset($_GET['sort'])) {
         $sort = $_GET['sort'];
          switch ($sort) {
          case '1':
            $sortsql = "AND product_price < 100";
            break;
          case '2':
            $sortsql = "AND product_price > 100 AND product_price < 500 ";
            break;
          case '3':
            $sortsql = "AND product_price > 500 AND product_price < 1000 ";
            # code...
            break;
          case '4':
            $sortsql = "AND product_price > 1000 AND product_price < 5000 ";
            # code...
            break;
          case '5':
            $sortsql = "AND product_price > 5000 ";
            # code...
            break;

          default:
            # code...
            break;
        }
        }  
        
     	 	$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%'".$sortsql."";
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

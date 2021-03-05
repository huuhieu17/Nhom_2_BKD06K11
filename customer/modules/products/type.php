<?php
require_once('customer/template/version1/header.php');
$subTitle = "Type";
$sql = "SELECT * FROM categorizes";
$query_type = mysqli_query($connection,$sql);
$keyword = "";
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
    flex-flow: row wrap;
    display: flex;
    flex-direction: row;
    width: 83%;
    float: left;
    overflow: auto;
  }
  .center:after{
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
    margin: 0 auto 0 auto;
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

  .view{
    height: 100%;
    text-decoration: none;
    color: black;
  }
  .item .view .img{
    width: 100%;
    height: 70%;
  }
  .item .view .img img{
    height: 100%;
    width: 100%;
  }
  .item .view .name{
    height: 20%;

  }
  .item .view .price{
    height: 9%;
  }

  .view{
    text-decoration: none;
    color: black;
  }
  .side ul{
    width: 100%;
  }
  .side li{
    width: 100%;
  }

  .mobile{
    display: none;
  }
  .mobile button{
    background: #f1f1f1;
    border: none;
    padding: 10px;
    border-radius: 3px;
  }
  .mobile button a{
    text-decoration: none;
    color: black;
  }
  @media only screen and (max-width: 425px) {
    .center{
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
    .all{
      
    }
    .mobile{
      display: block;
    }
    .side{
      display: none;
    }

  }
  @media only screen and (max-width: 768px) and (min-width: 426px) {
    
    .center{
      width: 100%;
    }
    .item{
      height: 350px;
      width: 30%;
    }
    .item img{
      height: 66%;
    }
  }
  





  @media only screen and (min-width: 1400px) {
    .item{
      width: 17%;
    }
  }
   .page1{
      overflow: auto;
      padding: 20px;
      width: 100%;
      text-align: center; 
    }
    .page1 a{
      text-decoration: none;
      color: black;
      margin-right: 10px;
      padding:3px;
    }
    .page1 a.active{
      background: black;
      color: white;
    }

</style>
<div class="all">
  <div class="mobile">
    <?php foreach ($query_type as $key): ?>
      <button><a href="?s=products&act=type&id=<?php echo $key['id'] ?>"><?php echo $key['name'] ?></a></button>
      
    <?php endforeach ?>
  </div>
  <div class="side">
    <center><h3>List Type</h3></center>
    
    <hr>
    <?php foreach ($query_type as $key): ?>
      <ul>
        <li><a href="?s=products&act=type&id=<?php echo $key['id'] ?>"><?php echo $key['name'] ?></a></li>
      </ul>         
    <?php endforeach ?>
  </div>
  <div class="center">
    
   <?php
  if (isset($_GET['id'])) {
  if ($_GET['id'] == "") {
     $sql = "SELECT * FROM products";
  }else{
       $keyword = $_GET['id'];
   $sql = "SELECT * FROM products WHERE product_type = '$keyword'";
  }

 }else{
   $sql = "SELECT * FROM products";
 } 
  if (!isset($_GET['page'])) {
  $present_page = 1;
}else{
  $present_page = $_GET['page'];
}
 $query = mysqli_query($connection,$sql);
$query = mysqli_query($connection,$sql); //get total product
$total_product = mysqli_num_rows($query);
$limit = 10;
$total_page = ceil($total_product/$limit);
$skip = ($present_page - 1)*$limit;
if (!isset($_GET['id']) || $_GET['id'] == "") {
  $sql = "SELECT * FROM products LIMIT $limit OFFSET $skip";
}else{
  $sql = "SELECT * FROM products WHERE type = '$keyword' LIMIT $limit OFFSET $skip";
}
 if (!$query) {
  echo "Error: ". mysql_connect_error();
}else if (mysqli_num_rows($query) == 0) {
  echo "No product";
}else{
  foreach ($query as $key) {
    $id = $key['id'];
    $img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT url FROM products_images WHERE id = '$id'"));
    
    echo "<div class='item'>";
    echo "<a class='view' href='?s=products&act=detail&id=$id'>";
    echo "<div class='img'>";
    echo "<img src='./public/img/product/".$img['url']."'>";
    echo "</div>";
    echo "<div class='name'>";
    echo "<b>".$key['product_name']."</b>";
    echo "</div>";
    echo "<div class='price'>";
    echo "<b><p style='color:red'>".$key['product_price']."$</p></b>";
    echo "</div>";
    
    
    
    echo "</a>";
    echo "</div>";
  }
}
?>
<div class="page1">
  <a href="#">Page:
  </a>  
  <?php
  $isactive = "";
  if (isset($_GET['page'])) {
   if ($_GET['page'] == $present_page) {
    $isactive = "active";
  }
}

for ($i=1; $i <= $total_page ; $i++) { 
  // /?s=products&act=search&keyword=&sort=&type=&brand=
  echo "<a class='$isactive' href='?s=products&act=brand&id=".$keyword."&page=".$i."'>".$i."</a>";

} ?>
</div>
</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>
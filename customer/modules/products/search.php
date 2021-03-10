<?php 
require_once('customer/template/version1/header.php');
$subTitle = "Search";
$keyword= "";
$keyword = $_GET['keyword'];
$sort = $keyword = $brand = $type = "";
?>
<style type="text/css">
	.scontent{
    display: block;
    overflow: hidden;
    width: 100vw;
    border-top: 1px solid #eee;
    height: 100%;
  }
  .new{
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
  .new:after{
    content: "";
    display: table;
    clear: both;
  }
  .side{
    height: 100%;
    border-right: 1px solid #eee;
    box-sizing: border-box;
    width: 15%;
    float: left;
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
    height: 40vh;
    box-sizing: content-box;
    text-align: center;
    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    float: left;
    width: 23%;
    padding: 10px;
    margin: 0 auto 0 auto;
  }
  .item .view{
    height: 100%;
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
  .side form{
    width: 100%;
    box-sizing: border-box;
  }
  .side form span{
    box-sizing: border-box;
    width: 100%;
    display: block;
    padding: 10px;
    border-bottom: 1px solid #eee;
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
      width: 45%;
    }
    
  }
  @media only screen and (max-width: 768px){
   .new{
    width: 100%;
  }
  .item{
    height: 30%;
  }

  .side{
    width: 100%;
    height: auto; 
  }

}
@media only screen and (max-width: 768px) and (min-width: 426px) {
  .item{
    width: 30%;
  }
}
@media only screen and (min-width: 1400px) {
  .item{
    width: 17%;
  }
}
.hidden{
  display: none;
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

<div class="scontent">
  <div class="side">
    <center><h3>Search</h3></center><hr>
    <form action="" method="GET">
      <input type="text" name="s" value="products" class="hidden">
      <input type="text" name="act" value="search" class="hidden">
      <span><input type="text" name="keyword" placeholder="Keyword" value="<?php echo $keyword ?>"><button><i class="fa fa-search"></i></button></span>
      <span>
        Price:
        <select name="sort" id="">
         <option value=''>-----</option>
         <?php if ($_GET['sort'] == 1): ?>
           <option value='1' selected="">Below 100$</option>
           <?php else: ?>
            <option value='1'>Below 100$</option>
          <?php endif ?>
          <?php if ($_GET['sort'] == 2): ?>
            <option value='2' selected="">100$ - 500$</option>
            <?php else: ?>
              <option value='2'>100$ - 500$</option>
            <?php endif ?>
            <?php if ($_GET['sort'] == 3): ?>
             <option value='3' selected="">500$ - 1000$</option>
             <?php else: ?>
               <option value='3'>500$ - 1000$</option>
             <?php endif ?>
             <?php if ($_GET['sort'] == 4): ?>
              <option value='4' selected="">1000$ - 5000$</option>
              <?php else: ?>
               <option value='4'>1000$ - 5000$</option>
             <?php endif ?>
             <?php if ($_GET['sort'] == 5): ?>
              <option value='5' selected="">Under 5000$</option>
              <?php else: ?>
               <option value='5'>Under 5000$</option>
             <?php endif ?>





           </select>
         </span>
         <span>
           Type:
           <?php 
           $query_type = mysqli_query($connection,"SELECT * FROM categorizes");
           ?>
           <select name="type" id="">
             <option value="">------------</option>
             <?php foreach ($query_type as $key): ?>
              <?php if ($_GET['type'] == $key['id']): ?>
               <option value="<?php echo $key['id'] ?>" selected><?php echo $key['name'] ?></option>
               <?php else: ?>
                <option value="<?php echo $key['id'] ?>"><?php echo $key['name'] ?></option>
              <?php endif ?>
              
            <?php endforeach ?>
          </select>
        </span>
        <span>
         Brand:
         <?php 
         $query_type = mysqli_query($connection,"SELECT * FROM brand");
         ?>
         <select name="brand" id="">
           <option value="">------------</option>
           <?php foreach ($query_brand as $key): ?>
            <?php if ($_GET['brand'] == $key['id']): ?>
             <option value="<?php echo $key['id'] ?>" selected><?php echo $key['name'] ?></option>
             <?php else: ?>
              <option value="<?php echo $key['id'] ?>"><?php echo $key['name'] ?></option>
            <?php endif ?>
            
          <?php endforeach ?>
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
    $typesql = "";  
    if (isset($_GET['type'])) {
      $type = $_GET['type'];
      if ($type == "") {
        $typesql = "";
      }else{
        $typesql = "AND product_type =".$type;
      }
      
      
    }
    $brandsql = "";  
    if (isset($_GET['brand'])) {
      $brand = $_GET['brand'];
      if ($brand == "") {
        $brandsql = "";
      }else{
        $brandsql = "AND product_brand = ".$brand;
      }
      
      
    }
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%' ".$sortsql." ".$typesql." ".$brandsql."" ;
  }else{
   $sql = "SELECT * FROM products";
 } 
 $query = mysqli_query($connection,$sql);
   // PAGENIATION
 if (!isset($_GET['page'])) {
  $present_page = 1;
}else{
  $present_page = $_GET['page'];
}
$total_product = mysqli_num_rows($query);
$limit = 8;
$total_page = ceil($total_product/$limit);
$skip = ($present_page - 1)*$limit;
$sql = "SELECT * FROM products WHERE product_name LIKE '%$keyword%' ".$sortsql." ".$typesql." ".$brandsql."LIMIT $limit OFFSET $skip" ;
$query = mysqli_query($connection,$sql);
if (!$query) {
  echo "Error: ". mysql_connect_error();
}else if (mysqli_num_rows($query) == 0) {
  echo "No result ".$keyword;
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
    echo "<b>".$key['product_name']."</b><br><br>";
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
  echo "<a class='$isactive' href='?s=products&act=search&keyword=".$keyword."&sort=".$sort."&type=".$type."&brand=".$brand."&page=".$i."'>".$i."</a>";

} ?>
</div>


</div>
</div>
<?php 
require_once('customer/template/version1/footer.php'); ?>

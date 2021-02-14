<?php
require_once('customer/template/version1/header.php');
$subTitle = "Type";
$sql = "SELECT * FROM categorizes";
$query_type = mysqli_query($connection,$sql);
 ?>
 <style>
  .all{
    display: block;
    overflow: hidden;
    box-sizing: border-box;
    width: 100%;

  }
  .side{
    width: 15%;
    height: 100vh;
    border-right: 1px solid black;
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
.side ul{
  width: 100%;
}
.side li{
  width: 100%;
}
.item img{
  width: 100%;
  height: 80%;
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
        $keyword = $_GET['id'];
        $sql = "SELECT * FROM products WHERE product_type[[[[[]]]]] = '$keyword'";
       }else{
         $sql = "SELECT * FROM products";
       } 
        $query = mysqli_query($connection,$sql);
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
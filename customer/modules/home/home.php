<?php $subTitle = "Home";
require_once('customer/template/version1/header.php');
?>

<style>
  .mySlides img {
    height: 100%;
    vertical-align: middle;
  }

  /* Position the image container (needed to position the left and right arrows) */

  .slideshow {
    transition: 0.7s;
    width: 100%;
    z-index: 0;
    height: 100%;
  }

  .slideshow #sleft{
    height: 90%;
    position: relative;
    width: 100%;
  }

  /* Hide the images by default */
  .mySlides {
    height: 100%;
    position: relative;
    width: 100%;
    display: none;
  }
  .mySlides img{
    height: 90vh;
  }
  /* Add a pointer when hovering over the thumbnail images */
  .cursor {
    cursor: pointer;
  }

  /* Next & previous buttons */
  .prev,
  .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
  }

  /* Position the "next button" to the right */
  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }

  /* On hover, add a black background color with a little bit see-through */
  .prev:hover,
  .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }

  /* Number text (1/3 etc) */
  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }





  /* Six columns side by side */
  .column {
    float: left;
    width: 25%;
  }

  /* Add a transparency effect for thumnbail images */
  .demo {
    opacity: 0.6;
    background: #f1f1f1;
    text-align: center;
    padding: 10px;
  }

  .active,
  .demo:hover {
    opacity: 1;
  }
  .slideshow:after {
    content:'';
    display:block;
    clear: both;
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
  margin: 0 auto 0 auto;
  height: 25vw;
}

.item:hover{
  transition: 0.1s;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  background: black;
  border-radius: 2px;
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
  height: 80%;
}
.item .view .img img{
  height: 100%;
  width: 100%;
}
.item .view .name{
  height: 10%;
  overflow: hidden;

}
.item .view .price{
  height: 9%;
}
.view{
  text-decoration: none;
  color: black;
}


h1{
  text-align: center;
}
@media only screen and (max-width: 425px) {
  .slideshow{
    display: none;  
  }
  .item{
    width: 42%;
  }
  .item{
    height: 60vw;
  }
  a{
    font-size: 15px;
    overflow: hidden; 
  }
  
}
@media only screen and (max-width: 768px) and (min-width: 426px) {
  .slideshow {
    padding: 3% 0;
  }
  .mySlides img{
    height: 100%;
  }
  .item{
    width: 30%;
    height: 40vw;
  }
}

}


@media only screen and (max-width: 1024px) {
  .item{
    width: 22%;
  }
}
@media only screen and (min-width: 1400px) {
  .item{
    width: 17%;
  }
}


</style>




<div class="slideshow">
	<div id="sleft">
		<div class="mySlides">

      <img src="public/img/template/banner.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <img src="public/img/template/img_nature_wide.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <img src="public/img/template/img_mountains_wide.jpg" style="width:100%">
    </div>
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" id="next" onclick="plusSlides(1)">❯</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


  </div>
</div>

<script>
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slides[slideIndex-1].style.display = "block";
        
      }
      setInterval(next,2000); 
      function next() {
        document.getElementById('next').click();
      }

    </script>
    <h1>New Arrival</h1>
    <hr>
    <div class="new">
     <?php 
     if (!isset($_GET['page'])) {
      $present_page = 1;
    }else{
      $present_page = $_GET['page'];
    }
    $sql = "SELECT * FROM `products` WHERE product_status = 1 ORDER BY id DESC";
    $query = mysqli_query($connection,$sql); 
    $totalProduct = mysqli_num_rows($query);
    $limit = 15;
    $totalPage = ceil($totalProduct/$limit);
    $skip = ($present_page - 1)*$limit;
    $sql = $sql. " LIMIT $limit OFFSET $skip";
    $query = mysqli_query($connection,$sql);
    if (!$query) {
      echo "Error: ". mysql_connect_error();
    }else if (mysqli_num_rows($query) == 0) {
      echo "No products";
    }else{
      foreach ($query as $key) {
        $id = $key['id'];
        $img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM products_images WHERE id = '$id'"));
        echo "<div class='item'>";
        echo "<a class='view' href='?s=products&act=detail&id=$id'>";
        echo "<div class='img'>";
        echo "<img src='./public/img/product/".$img['url']."'>";
        echo "</div>";
        echo "<div class='name'>";
        echo "<b>".$key['product_name']."</b>";
        echo "</div>";
        echo "<div class='price'>";
        echo "<b><p style='color:red'>".number_format($key['product_price'],0,'','.')."$</p></b>";
        echo "</div>";               
        echo "</a>";
        echo "</div>";
      }
    }
    ?>
  </div>

  <div class="page1">
    <center>
      
      
      Page:
      <?php
      $isactive = "";
      if (isset($_GET['page'])) {
       if ($_GET['page'] == $present_page) {
        $isactive = "active";
      }
    }

    for ($i=1; $i <= $totalPage ; $i++) { 
  // /?s=products&act=search&keyword=&sort=&type=&brand=
      echo "<a class='$isactive' href='?s=home&page=".$i."'>".$i."</a>";

    } ?>
  </center>
</div>
<hr>
<?php 
require_once('customer/template/version1/footer.php'); ?>
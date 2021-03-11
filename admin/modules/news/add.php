<?php 
require_once './template/header.php';
if (isset($_POST['submit'])) {
	$title  = $_POST['title'];
	$content = $_POST['editor1'];
	$dir = "../public/img/template/";
	$editor = $_SESSION['admin']['name'];
	foreach($_FILES['images']['name'] as $key=>$val){ 
	$fileNames = basename($_FILES['images']['name'][$key]);
	$target = $dir.$fileNames; 
	move_uploaded_file($_FILES['images']['tmp_name'][$key], $target);
	$sql = "INSERT INTO news VALUES(Null,'$title','$fileNames','$content',current_timestamp(),'$editor')";
	echo $sql;
	$query = mysqli_query($connection,$sql);
	if (!$query) {
		echo 'Error'.mysqli_error($connection);;
	}else{
		echo "<script>window.location.replace('?modules=news&action=manage') </script>";
		header("Location:?modules=news&action=manage");
	}
}
	
}
?>
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<style>
	.news{
		width: 100%;
	}
	h4{
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
	form{
		width: 80%;
		margin: auto;
		border: 1px solid #eee;
		padding: 10px;
	}
	form input{
		width: 100%;
		padding: 10px;
	}
</style>
<div class="news">
	<h4>New / Add Post</h4>
	<form action="#" method="POST" enctype="multipart/form-data">
		Title: <input type="text" name="title"><br>
		 Images: <div class="input-images-1 imgup">
		
	</div>
		Content: 
		 <textarea name="editor1" class="ckedit"></textarea>
      <script>
                        CKEDITOR.replace( 'editor1' );
      </script>

    <input type="submit" name="submit">
	</form>
</div>

<?php 
require_once './template/footer.php';
?>
<?php 
require_once 'template/header.php';
require_once('././config/check_login.php');
?>
<style>
	h4{
		text-align: left;
		font-size: 13px;
		box-sizing: border-box;
		width: 100%;
		padding: 10px;
		background: #f1f1f1;
	}
</style>
<h1>Dashboard</h1>
	<?php 
		$sql = " SELECT year(create_at) as years FROM invoices WHERE status = 3 GROUP BY year(create_at)";
		$query = mysqli_query($connection,$sql);
		if (isset( $_POST['btn'])) {
			$year = $_POST['year'];
			$_SESSION['year'] = $year;
		}
		if (isset($_POST['reset'])) {
			if (isset($_SESSION['year'])) {
				unset($_SESSION['year']);
			}
		}
	?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
   	<div>
   		<form action="#" method="POST">
   			<select name="year">
   			<option value="1">All</option>
   			<?php 
   				while ($row = mysqli_fetch_assoc($query)) {
   					if (isset($_SESSION['year']) && $_SESSION['year'] == $row['years']) {
   						echo "<option selected value='".$row['years']."'>".$row['years']. "</option>";
   					}else{
   						echo "<option value='".$row['years']."'>".$row['years']. "</option>";
   					}
   				}
   			?>
   			</select>
   			<input type="submit" name="btn"> <button type="submit" name="reset">Reset</button>
   		</form>
   	</div>
<canvas id="linechart"></canvas>
<?php
 if(isset($_SESSION['year']) && $_SESSION['year'] != 1){
    $x1=$y1='';
    $year=$_SESSION['year'];                             
    $month="select month(create_at) as 'month' from invoices where year(create_at)=$year and status=3 group by month(create_at) order by month(create_at) ASC";
    $month=mysqli_query($connection,$month);
    while($m=mysqli_fetch_assoc($month)){
        $mo=$m['month'];
        $total=0;
        $x1.="'"."Tháng ".$mo."',";

        $sql_m="select total_amounts from invoices where year(create_at)=$year and month(create_at)=$mo and status=3";
        $sql_m=mysqli_query($connection,$sql_m);
        while($t=mysqli_fetch_assoc($sql_m)){
            $total+=$t['total_amounts'];
        }
        $y1.=$total.",";

    }
    echo "<script>";
        echo"
            var bienx=[".$x1;
            //    echo"2000,2001,2002,2003";
            echo"];";
                    echo "var bieny=[".$y1."];
                    var CHART=document.getElementById('linechart').getContext('2d');
                    var line_chart=new Chart(CHART,{
                        type:'bar',
                        data:{
                            labels:bienx,
                            datasets:[{
                                label:'Doanh thu trong năm ".$year."',"."borderColor:'#55ffff',
                                borderWidth:2,
                                data:bieny,
                            }]
                        }
                    });
            </script>";



 }
 else if(!isset($_SESSION['year']) ){
     $x1=$y1='';

     $year="select year(create_at) as 'year' from invoices where status=3 group by year(create_at) order by year(create_at) ASC";
     $year=mysqli_query($connection,$year);
     while($row=mysqli_fetch_assoc($year)){
         $y=$row['year'];
         $x1.="'"."Năm ".$y."',";
         $total=0;
         $sql_y="select total_amounts from invoices where year(create_at)=$y and status=3";
         $sql_y=mysqli_query($connection,$sql_y);
         while($m=mysqli_fetch_assoc($sql_y)){
             $total+=$m['total_amounts'];
         }
         $y1.=$total.",";
         
     }
        // echo $x1."<br>";
        // echo $y1;

        echo "<script>";
        echo"
            var bienx=[".$x1;
            //    echo"2000,2001,2002,2003";
            echo"];";
                    echo "var bieny=[".$y1."];
                    var CHART=document.getElementById('linechart').getContext('2d');
                    var line_chart=new Chart(CHART,{
                        type:'bar',
                        data:{
                            labels:bienx,
                            datasets:[{
                                label:'Doanh thu hàng năm',
                                borderColor:'#55ffff',
                                borderWidth:2,
                                data:bieny,
                            }]
                        }
                    });
            </script>";
    }else{
    	// echo "<script> window.location.replace('?modules=home')</script>";
    	header("location:index.php");
    }
?>
</html>
<?php
require_once 'template/footer.php';
?>
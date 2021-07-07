<?php
session_start();
include('../templates/header.html');
include('../templates/navbar.php');
require('../config/conexion.php');

// include('intento_proceso_review.php');

$tienda_id = $_POST["tienda_elegida"];

// $servername='localhost';
// $username='root';
// $password='';
// $dbname = "trading";
// $conn=mysqli_connect($servername,$username,$password,"$dbname");

# se supone que el usuario inició sesión por ver_tiendas (que lleva a visitar tienda y a esto)
// ratings -> tabla con info


$query1 = "SELECT AVG(puntuacion) FROM ratings";
$resultado1 = $db2 -> prepare($query1);
$resultado1 -> execute();
$data1 = $resultado1 -> fetchAll();
$promedio = $data1[0];

$query2 = "SELECT count(puntuacion) FROM ratings";
$resultado2 = $db2 -> prepare($query2);
$resultado2 -> execute();
$data2 = $resultado2 -> fetchAll();
$n_puntuaciones = $data2[0];

$query3 = "SELECT comentario, puntuacion, email FROM ratings ORDER BY fecha_publicacion";
$resultado3 = $db2 -> prepare($query3);
$resultado3 -> execute();
// review
$data3 = $resultado3 -> fetchAll();

// arreglar
$query4 = "SELECT count(*), puntuacion FROM ratings GROUP BY puntuacion ORDER BY puntuacion DESC";
$resultado4 = $db2 -> prepare($query2);
$resultado4 -> execute();
// rating
$data4 = $resultado4 -> fetchAll();
?>

<html style="background-color: #6495ed">

<div class="row container">
<div class="col-md-4 ">
	<h3><b>Rating & Reviews</b></h3>
	<div class="row">
	
		<div class="col-md-6">
			<h3 align="center"><b><?php echo round($promedio,1);?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h3>
			<p><?=$n_puntuaciones;?> opiniones </p>
		</div>
		<div class="col-md-6">
			<?php
			foreach ($data4 as $d4){
			?>
				<h4 align="center"><?=$d4[1];?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:green;"></i> Total <?=$d4[0];?></h4>
			<?php	
			}
				
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">	
		<?php
			foreach ($data3 as $d3){
		?>
            <h4><?php $d3[1];?> <i class='fa fa-star' data-rating='2' style='font-size:20px;color:green;'></i> by <span style='font-size:14px;'><?php $d3[2];?></span></h4>
            <p><?php $d3[0];?></p>
            <hr>
		<?php	
			}	
		?>
		</div>
	</div>
		
	
	<div id="rating_div">
				<div class="star-rating">
					<span class="fa divya fa-star-o" data-rating="1" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="2" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="3" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="4" style="font-size:20px;"></span>
					<span class="fa fa-star-o" data-rating="5" style="font-size:20px;"></span>
					<input type="hidden" name="whatever3" class="rating-value" value="1">
				</div>
	</div>
</div>
</div><br>
<input type="hidden" name="demo_id" id="demo_id" value="1">
<div class="col-md-4">
<input type="text" class="form-control" name="email" id="email" placeholder="Email Id"><br>
<textarea class="form-control" rows="5" placeholder="Escribe tu comentario aquí..." name="remark" id="remark" required></textarea><br>
<p><button  class="btn btn-default btn-sm btn-info" id="srr_rating">Submit</button></p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/index.js"></script>

</body>
</html>
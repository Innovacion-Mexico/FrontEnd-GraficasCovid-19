<?php 
require_once "php/conexion.php";

$conexion = conexion();

$sql = "SELECT * FROM totalnegativos";
$sql2 = "SELECT * FROM totalpositivos";
$sql3 = "SELECT * FROM totaldifuntos";
//$sql = "select `cat_entidad`.`entidad` AS `estados`,count(`cat_resultado`.`resultado`) AS `positivos` from ((`covidmx200507` join `cat_entidad` on((`cat_entidad`.`clave_entidad` = `covidmx200507`.`entidad_res`))) join `cat_resultado` on((`cat_resultado`.`clave` = `covidmx200507`.`resultado`))) where (`covidmx200507`.`resultado` = 1) group by `covidmx200507`.`entidad_res`,`cat_entidad`.`entidad` order by `cat_entidad`.`clave_entidad`";

$resultados = mysqli_query($conexion, $sql);
$resultados2 = mysqli_query($conexion, $sql2);


$valoresY=array();//montos

$valoresYY=array();//montos

$valoresYYY=array();//montos

//casos negativos
while( $ver = mysqli_fetch_row($resultados) ){
	$valoresY[]=$ver[0]; 
}

$tamY = count($valoresY);

$datosY = "";

for($x=0; $x<$tamY; $x++){
	if($x == $tamY -1 ){
		$datosY = $datosY . "'" . $valoresY[$x] . "'";
	}else{
		$datosY = $datosY . "'" . $valoresY[$x] . "',";
	}
}

mysqli_free_result($resultados);

//casos positivos
while( $ver = mysqli_fetch_row($resultados2) ){
	$valoresYY[]=$ver[0];
}

mysqli_free_result($resultados2);

$tamYY = count($valoresYY);

$datosYY = "";

for($x=0; $x<$tamYY; $x++){
	if($x == $tamYY -1 ){
		$datosYY = $datosYY . "'" . $valoresYY[$x] . "'";
	}else{
		$datosYY = $datosYY . "'" . $valoresYY[$x] . "',";
	}
}

//casos en defuncion
$resultados3 = mysqli_query($conexion, $sql3);
while( $ver = mysqli_fetch_row($resultados3) ){
	$valoresYYY[]=$ver[0];
}

$tamYYY = count($valoresYYY);

$datosYYY = "";

for($x=0; $x<$tamYYY; $x++){
	if($x == $tamYYY-1 ){
		$datosYYY = $datosYYY . "'" . $valoresYYY[$x] . "'";
	}else{
		$datosYYY = $datosYYY . "'" . $valoresYYY[$x] . "',";
	}
}
mysqli_free_result($resultados3);
?>

<div id="graficasBarras"></div> 
<div class="col-sm-3">
	<div id="datos">
		<ul class="list-group">
		  <li class="list-group-item">
		    <span class="badge"><?php echo $valoresY[0]; ?></span>
		    NEGATIVOS
		  </li>
		  <li class="list-group-item">
		    <span class="badge"><?php echo $valoresYY[0]; ?></span>
		    POSITIVOS
		  </li>
		      <li class="list-group-item">
		    <span class="badge"><?php echo $valoresYYY[0]; ?></span>
		    DEFUNCIONES
		  </li>
		</ul>
	</div>	
</div>

<script type="text/javascript">
	datosY = <?php echo $datosY; ?>;
	datosYY = <?php echo $datosYY; ?>;
	datosYYY = <?php echo $datosYYY; ?>;

	var trace1 = {
	  x: ['NEGATIVOS'],
	  y: [datosY],
	  name: 'NEGATIVOS',
	  type: 'bar'
	};

	var trace2 = {
	  x: ['POSITIVOS'],
	  y: [datosYY],
	  name: 'POSITIVOS',
	  type: 'bar'
	};	

	var trace3 = {
	  x: ['DEFUNCIONES'],
	  y: [datosYYY],
	  name: 'DEFUNCIONES',
	  type: 'bar'
	};		

	var data = [trace1,trace2,trace3];

	var layout = {

	  title: 'CASOS NEGATIVOS, POSITIVOS, DEFUNCIONES DE COVID19 EN MÉXICO<BR> HASTA EL 10 DE MAYO 2020 CORTE: 19:00 HRS',
	  yaxis: {
	    title: 'EN MILES',
	    showline: true
	  }
	};

	var config = {responsive: true}	

	Plotly.newPlot('graficasBarras', data, layout, config);
</script>

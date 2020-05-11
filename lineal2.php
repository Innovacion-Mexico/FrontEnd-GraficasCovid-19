<?php 
require_once "php/conexion.php";

$conexion = conexion();

$sql = "SELECT `estados`,`positivos` FROM `posxestados`";
$sql2 = "SELECT `estados`,`negativos` FROM `negxestados`";
$sql3 = "SELECT `estados`,`defunciones` FROM `defxestados`";
//$sql = "select `cat_entidad`.`entidad` AS `estados`,count(`cat_resultado`.`resultado`) AS `positivos` from ((`covidmx200507` join `cat_entidad` on((`cat_entidad`.`clave_entidad` = `covidmx200507`.`entidad_res`))) join `cat_resultado` on((`cat_resultado`.`clave` = `covidmx200507`.`resultado`))) where (`covidmx200507`.`resultado` = 1) group by `covidmx200507`.`entidad_res`,`cat_entidad`.`entidad` order by `cat_entidad`.`clave_entidad`";

$resultados = mysqli_query($conexion, $sql);
$resultados2 = mysqli_query($conexion, $sql2);


$valoresY=array();//montos
$valoresX=array();//

$valoresYY=array();//montos
$valoresXX=array();//fechas

$valoresYYY=array();//montos
$valoresXXX=array();//fechas

//casos positivos

//while ($ver=mysqli_fetch_row($resultados)) {
while( $ver = mysqli_fetch_row($resultados) ){
	$valoresX[]=utf8_encode($ver[0]); 
	$valoresY[]=$ver[1];
}

$tamX = count($valoresX);

$datosX = "[";

for($x=0; $x<$tamX; $x++){
	if($x == $tamX -1 ){
		$datosX = $datosX . "'" . $valoresX[$x] . "']";
	}else{
		$datosX = $datosX . "'" . $valoresX[$x] . "',";
	}
}
//$datosX = $datosX . "]";
mysqli_free_result($resultados);
//$datosX=json_encode($valoresX);
$datosY=json_encode($valoresY);

//casos negativos
while( $ver = mysqli_fetch_row($resultados2) ){
	$valoresXX[]=$ver[0]; 
	$valoresYY[]=$ver[1];
}

mysqli_free_result($resultados2);

$tamXX = count($valoresXX);

$datosXX = "[";

for($x=0; $x<$tamXX; $x++){
	if($x == $tamXX -1 ){
		$datosXX = $datosXX . "'" . $valoresXX[$x] . "']";
	}else{
		$datosXX = $datosXX . "'" . $valoresXX[$x] . "',";
	}
}
$datosYY=json_encode($valoresYY);

//casos en defuncion
$resultados3 = mysqli_query($conexion, $sql3);
while( $ver = mysqli_fetch_row($resultados3) ){
	$valoresXXX[]=$ver[0]; 
	$valoresYYY[]=$ver[1];
}

$tamXXX = count($valoresXXX);

$datosXXX = "[";

for($x=0; $x<$tamXXX; $x++){
	if($x == $tamXXX-1 ){
		$datosXXX = $datosXXX . "'" . $valoresXXX[$x] . "']";
	}else{
		$datosXXX = $datosXXX . "'" . $valoresXXX[$x] . "',";
	}
}
mysqli_free_result($resultados3);

$datosYYY=json_encode($valoresYYY);
//casos en defuncion

?>

<div id="graficaLineal"></div>

<script type="text/javascript">
	function crearCadenaLineal(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x])
		}

		return arr; 
	}

</script>

<script type="text/javascript">

	datosX = <?php echo $datosX; ?>;
	datosY = crearCadenaLineal('<?php echo $datosY; ?>');

	datosXX = <?php echo $datosXX; ?>;
	datosYY = crearCadenaLineal('<?php echo $datosYY; ?>');		

	datosXX = <?php echo $datosXX; ?>;
	datosYYY = crearCadenaLineal('<?php echo $datosYYY; ?>');		

	var positivos = {
		x: datosX,
		y: datosY,
		name: 'Casos Positivos',
		type: 'scatter'
	};

	var negativos = {
		x: datosX,
		y: datosYY,
		name: 'Casos Negativos',
		type: 'scatter'
	};

	var defuncion = {
		x: datosX,
		y: datosYYY,
		name: 'DEFUNCIONES',
		type: 'scatter'
	};	

	var data = [positivos, negativos, defuncion];

	var layout = {

	  title: 'CASOS DE COVID POR ESTADOS DE MEXICO<BR>AL 10 DE MAYO 2020 CORTE: 19:00 HRS',
	  yaxis: {
	    title: 'EN MILES',
	    showline: true
	  }
	};

	var config = {responsive: true}

	Plotly.newPlot('graficaLineal', data, layout, config);	
</script>

<?php 
require_once "php/conexion.php";

$conexion = conexion();

$sql = "SELECT `fecha`,`casosxdia` FROM `acumuladoxdia`";

$resultados = mysqli_query($conexion, $sql);


$valoresY=array();//montos
$valoresX=array();//

//casos positivos
$anterior=0;

while( $ver = mysqli_fetch_row($resultados) ){
	$valoresX[] =$ver[0];
	$anterior = $anterior + $ver[1]; 
	$valoresY[] =  $anterior;
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
?>

<div id="graficaAcumulados"></div>

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

	var positivos = {
		x: datosX,
		y: datosY,
		name: 'Casos Positivos',
		type: 'scatter'
	};
	var data = [positivos];

	var layout = {

	  title: 'CASOS ACUMULADOS DE COVID19 EN MEXICO<br> AL 10 DE MAYO 2020 CORTE: 19:00 HRS',
	  yaxis: {
	    title: 'EN MILES',
	    showline: true
	  }
	};

	var config = {responsive: true}

	Plotly.newPlot('graficaAcumulados', data, layout, config);	
</script>

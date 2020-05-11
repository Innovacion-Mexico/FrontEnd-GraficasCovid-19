<?php 
require_once "php/conexion.php";

$conexion = conexion();

$sql = "SELECT estados, positivos FROM posxEstados";

//$resultados = mysqli_query($conexion, $sql);
$result = $conexion->prepare($sql);
//Ejecutamos la consulta
$result->execute();

$resultados = $result->fetchAll(\PDO::FETCH_ASSOC);
print_r($resultados);

$valoresY=array();//montos
$valoresX=array();//fechas

while ($ver=$resultados->fetch()) {
	$valoresY[]=$ver[1]; 
	$valoresX[]=$ver[0];
}



$datosX=json_encode($valoresX);
$datosY=json_encode($valoresY);



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

	datosX = crearCadenaLineal('<?php echo $datosX; ?>');
	datosY = crearCadenaLineal('<?php echo $datosY; ?>');

	var trace1 = {
	  x: datosX,
	  y: datosY,
	  type: 'scatter'
	};

	var data = [trace1];

	Plotly.newPlot('graficaLineal', data);	
</script>
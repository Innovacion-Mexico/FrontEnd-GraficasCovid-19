<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Graficas Covid 19 Quintana Roo</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.3.1.min.js"></script>
	<script src="librerias/plotly-latest.min.js"></script>
	<style>
		body {
		  background: url('imgs/fondo.jpg') no-repeat center center fixed;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  background-size: cover;
		  -o-background-size: cover;
		}
	</style>	
</head>
<body>
	<div class="container">
		<h1 style="text-align: center; font-size: 18px;">
			<b style="color: white; text-decoration: none;">GRAFICOS DE COVID19 EN MEXICO Y QUINTANA ROO</b><br>
			<b style="font-size: 10px;"><a href="https://datos.gob.mx/busca/dataset/informacion-referente-a-casos-covid-19-en-mexico" style="color: white; text-decoration: none;">Fuente de los datos: Secretaria de Salud Gobierno de México</a></b><br>
			<b style="font-size: 10px; color: white; text-decoration: none;">Elabora: Roberto Ivan Santiago Hernandez</b><br>
		</h1>
		<div class="row" style="opacity:0.95; /* Opacidad 85% */">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<!--panel acumulados en mexico -->
					<div class="panel panel-heading">
						Casos Acumulados de Covid19 en México
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="cargaAcumulados"></div>
							</div>							
						</div>
					</div>					
					<!--panel por mexico -->
					<div class="panel panel-heading">
						Casos Covid19 México por topico
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="cargaBarras"></div>
							</div>							
						</div>
					</div>
					<!--panel por estados -->						
					<div class="panel panel-heading">
						Casos por Estados
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="cargaLineal"></div>
							</div>							
						</div>
					</div>									
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cargaAcumulados').load('acuxdia.php');		
		$('#cargaBarras').load('barras.php');
		$('#cargaLineal').load('lineal2.php');
	});
</script>


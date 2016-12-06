<?php

require_once("clases\producto.php");
$tituloVentana = "Recuperatorio Primer Parcial";
?>
<html>
<head>
	<title> <?php echo $tituloVentana; ?> </title>
	  
		<!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<script type="text/javascript" src="./JavaScript/funciones.js"></script>
		
		
        <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>PRODUCTOS</h1>      
		</div>
		<div class="CajaInicio" style="width:1100px">
			<h1>Recuperatorio Primer Parcial</h1>
			<table>
				<tbody>
					<tr>
						<td width="50%">
							<div id="divFrm" style="height:250px;overflow:auto;margin-top:20px">
								<input type="text" name="marca" id="marca" placeholder="Ingrese Marca" />
								<br>
								<input type="text>" name="modelo" id="modelo" placeholder="Ingrese Modelo" />
								<br>
								<input type="date"  name="fecha" id="fecha">
								<br>
								<select id="selec">
									<option value="and">Android</option>
									<option value="win">Windows</option>
									<option value="ios">iOS</option>
								</select>
								<br>
								<input type="radio" name="sim" id="sim1">1
								<br>
								<input type="radio" name="sim" id="sim2">2


								<input type="file" name="archivo" id="archivo" onchange="SubirFoto()" /> 
								
								<input type="button" class="MiBotonUTN" onclick="AgregarProducto()" value="Guardar"  />
								<input type="hidden" id="hdnQueHago" value="agregar" />
							</div>
						</td>
						<td rowspan="2">
							<div id="divGrilla" style="height:610px;overflow:auto;border-style:solid">
							
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div id="divFoto" style="height:350px;overflow:auto">
							
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>
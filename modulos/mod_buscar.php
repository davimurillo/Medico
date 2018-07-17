<?php require_once('common.php'); checkUser(); //chequeo de usuario entrante ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	 <title itemprop="name">Dr. Heiro Pinto | Cirujano Plástico Estético y Reconstructivo</title>
	<link rel="shortcut icon" type="image/x-icon" href="../img/logos/drheiro_icono.png" />
	<link href="../lib/css/font-awesome.css" rel="stylesheet">
	 <!-- Theme color -->
    <link id="switcher" href="../lib/css/theme-color/lite-blue-theme.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="../style.css" rel="stylesheet">
	
</head>
<body>

<div class="container-fluid">
		<?php include('cfg_encabezado.php'); ?>

  <script>
		var antes=(new Date ()).getTime();
		function tdc(){ // tiempo de carga
			var despues=(new Date()).getTime();
			var segundos=(despues-antes)/1000;
			document.getElementById('tdc').innerHTML="(" + segundos + " seg.)";
		}
  </script>
 
		
		<!-- CABEZADO -->
		<?php include_once('cfg_encabezado.php'); ?>
      	  
		<!-- CONTENIDO -->  
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center" style="font-size:28px; font-weight:bold; margin:20px 0px 20px 0px; ">
				<i class="fa fa-search"> </i> BUSCADOR
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#888">
				Búsqueda rápida de la información de los pacientes:
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:20px">
				<form id="form1" action="">
					<input type="text" id="buscar" name="buscar" class="form-control" placeholder="Nombre del paciente" autofocus>
				</form>
			</div>
			<div id="resultado" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px">
			
			<?php 
			// BUSCA DATOS DE LAS UNIDADES ORGANIZATIVA ------------------- //
				if (isset($_GET['buscar'])){
					 $SQL="SELECT id_paciente, tx_documento, tx_nombres_apellidos, tx_correo, tx_telefono, '<button class=\"btn btn-info\"><i class=\"fa fa-plus-square\" style=\" font-size:16px\" ></i> Ver Datos</button>' as ver_datos FROM tbl_paciente WHERE upper(tx_nombres_apellidos) LIKE ('%".strtoupper($_GET['buscar'])."%') OR upper(tx_documento) LIKE ('%".strtoupper($_GET['buscar'])."%') ";
					$RES=abredatabase(g_BaseDatos,$SQL);
					if (dnumerofilas($RES)==0){ echo "No existen Empresas con esta información '".$_GET['buscar']."' que busca";}else{
						echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'  style='color:#ccc;' >Palabra Buscada: '".$_GET['buscar']."'</div>";
						echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'  style='color:#ccc;' >Cerca de (".dnumerofilas($RES).") resultados encontrados <span id='tdc'><span></div>";
			?>
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'  style="margin-top:20px">
			<table class="table table-hover" width="100%">
			<thead>
			<tr>
				<th width="35%">Paciente</th>
				<th width="15%">Identificación</th>
				<th width="25%" align="center">Correo</th>
				<th width="15%">Telefono</th>
				<th width="10%">Acción</th>
				
			</tr>
			</thead>
			<tbody>
			<?php 
			
			while($ROW=dregistro($RES)){ 
			
			?>
			<tr>
				<td><a href="mod_paciente_editar.php?id=<?php echo $ROW['id_paciente']; ?>"><?php echo $ROW['tx_nombres_apellidos']; ?></a></td>
				<td><?php echo $ROW['tx_documento']; ?></td>
				<td align="center"><a href="mailto:<?php echo $ROW['tx_correo']; ?>"><?php echo $ROW['tx_correo']; ?></a></td>
				<td><a href="tel:<?php echo $ROW['tx_telefono']; ?>"><?php echo $ROW['tx_telefono']; ?></a></td>
				<td><a href="mod_paciente_editar.php?id=<?php echo $ROW['id_paciente']; ?>"><button class="btn btn-info"><i class="fa fa-plus-square" style=" font-size:16px" ></i> Ver Datos</button></a></td>
				
			</tr>
			
			
					
			<?php } ?>
			</tbody>
					</table>	
				</div>
			<?php
					}
				}
			?>
			</div>
		</div>
		
		<!-- JS -->
		<script src="../lib/js/jquery.min.js" ></script>
		<script src="../lib/js/bootstrap.min.js" ></script>
</body>
</html>
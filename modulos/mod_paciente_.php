<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	<link href="../lib/css/fonts/font-awesome.css" rel="stylesheet">
	
	
</head>
<body>

<div class="container-fluid">
		<?php include('cfg_encabezado.php'); ?>

	<!-- seccion de configuracion del sistema -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="color:#ccc">
			<h3><i class="fa fa-user"></i> Lista de Pacientes</h3>
		</div>
		<div align="right" class="col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6" style="color:#ccc">
			<button type="button" class="btn btn-info" id="iniciar" style="margin-top:15px" data-toggle="modal" data-target="#myModal_sesion">Nuevo Paciente</button>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc; margin-top:-20px">
		<hr>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="color:#ccc">
			
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="color:#ccc">
			N° de Identidad
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="color:#ccc;">
			Nombres y Apellidos
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="color:#ccc;">
			Sexo
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="color:#ccc;">
			Telefono
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="color:#ccc">
			Email
		</div>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc; margin-top:10px">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="color:#ccc">
			<input type="checkbox" class="icheckbox_flat-green" checked="checked"> 
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="color:#ccc">
			N° de Identidad
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="color:#ccc;">
			Nombres y Apellidos
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="color:#ccc;">
			Sexo
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="color:#ccc;">
			Telefono
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="color:#ccc">
			<i class="fa fa-envelope-o"></i>
		</div>
	</div>
</div>
 <!-- sección de inicio de la aplicación -->
  <div class="modal fade" tabindex="-1" id="myModal_sesion" role="dialog" style="color:#999">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title" style="color:#ccc"> <i class="fa fa-user"></i> Nuevo Paciente</h2>
		  </div>
		  <div class="modal-body" >
		   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<iframe id="datos_pacientes" width="100%" height="340px" src="" allowtransparency="1" frameborder="1"></iframe>
				
			</div>
		  </div>
		  <div class="modal-footer"  style="text-align:center; margin-top:360px">
				  
			<div class="row" id="inicio_sesion" > </div>
			<button type="button" class="btn btn-info btn-lg" id="registrar">Guardar</button>
			<button type="button" class="btn btn-danger btn-lg" id="cancelar">Cancelar</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
 <script src="../lib/js/jquery.min.js"></script>
<script src="../lib/js/bootstrap.min.js" ></script>
 <script src="../lib/js/icheck/icheck.min.js"></script>
<script>
	$('#servicios').click( function (){
		$('#contenedor_data').attr('src', "cfg_servicios.php");
	});
</script>
<body>
<html>
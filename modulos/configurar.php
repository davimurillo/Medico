<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	<link href="../lib/css/font-awesome.css" rel="stylesheet">
	
</head>
<body>

<div class="container-fluid">
		<?php include('cfg_encabezado.php'); ?>

	<!-- seccion de configuracion del sistema -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc">
		<h3><i class="fa fa-cogs"></i> Configuración del Sistema</h3>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc; margin-top:-20px">
		<hr>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="list-group">
		  <span class="list-group-item active">Configuración</span>
		  <a href="#" id=datos_generales class="list-group-item">Generales</a>
		  <a href="#" id=usuario class="list-group-item"> <i class="fa fa-users" style="font-size:18px" ></i> Usuarios</a>
		  <a href="#" id=servicios class="list-group-item"><i class="fa fa-medkit" style="font-size:18px" ></i> Servicios</a>
		  <a href="#" id=tipo_servicios class="list-group-item"> <i class="fa fa-plus-square" style="font-size:18px"></i> Tipo de Servicios</a>
		  <a href="#" id=consultorios class="list-group-item"><I class="fa fa-hospital-o"></i> Consultorios</a>
		  <a href="#" id=plantillas class="list-group-item"><I class="fa fa-magic"></i> Plantillas</a>
		  <a href="#" id=salasoperacion class="list-group-item">Salas de Operaciones</a>
		   <a href="#" id=datos_generales_sistema class="list-group-item">General del Sistema</a>
		</div>
	</div>
	<div id="contenedor" class="col-lg-9 col-md-9 col-sm-9 col-xs-12" >
	<div class="panel panel-info">
			<div id="encabezado" class="panel-heading"><i class="fa fa-edit" style="font-size:18px"></i></div>
				<div class="panel-body">
					<iframe id="contenedor_data" src="" width="100%" allowtransparency="1" frameborder="0"  ></iframe>
				</div>
			</div>
		
	</div>
</div>
 <script src="../lib/js/jquery.min.js"></script>
<script src="../lib/js/bootstrap.min.js" ></script>
<script>
	//configuración de consultorios
	$('#consultorios').click( function (){
		$('#contenedor_data').attr('src', "cfg_consultorio.php");
		$('#encabezado').html('<i class="fa fa-hospital-o"></i> Consultorios');
	});

	//configuración de usuarios
	$('#usuario').click( function (){
		$('#contenedor_data').attr('src', "cfg_cuentas.php");
		$('#encabezado').html('<i class="fa fa-users"></i> Usuarios');
	});
	
	//configuración de sistema de generales
	$('#datos_generales_sistema').click( function (){
		$('#contenedor_data').attr('src', "cfg_configuracion_general.php");
	});
	
	
	$('#servicios').click( function (){
		$('#contenedor_data').attr('src', "cfg_servicios.php");
		$('#encabezado').html('<i class="fa fa-medkit"></i> Servicios');
	});
	$('#tipo_servicios').click( function (){
		$('#contenedor_data').attr('src', "cfg_tipos_servicios.php");
		$('#encabezado').html('<i class="fa fa-medkit"></i> Tipos de  Servicios');
	});
	
	//configuración plantillas
	$('#plantillas').click( function (){
		$('#contenedor_data').attr('src', "cfg_plantillas.php");
		$('#encabezado').html('<i class="fa fa-magic"></i> Diseño de Plantillas');
	});
	
	 //reconfigura el tamaño de la pantalla
		function alertSize() {
		  var myWidth = 0, myHeight = 0;
		  if( typeof( window.innerWidth ) == 'number' ) {
			//Non-IE
			myWidth = window.innerWidth;
			myHeight = window.innerHeight;
		  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
			//IE 6+ in 'standards compliant mode'
			myWidth = document.documentElement.clientWidth;
			myHeight = document.documentElement.clientHeight;
		  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
			//IE 4 compatible
			myWidth = document.body.clientWidth;
			myHeight = document.body.clientHeight;
		  }
		 // window.alert( 'Width = ' + myWidth );
		//  window.alert( 'Height = ' + myHeight );
		  document.getElementById('contenedor_data').style.height=(myHeight-225) + "px";
		  document.getElementById('contenedor').style.height=(myHeight-225) + "px";
		  
		  
		  
		}

		alertSize();

		function Resize()
		{
		alertSize();
		}

		window.onresize=Resize;
</script>
<body>
<html>
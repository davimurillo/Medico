<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
	
	<style>
		body { padding-top: 70px; height:100% }
		#contenedor {
			height:100vh;
		}
		#contenedor_data {
			height:80vh;
		}
	</style>
</head>
<body>
<div class="container-fluid">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="#">Dr. Heiro Pinto</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  
			 
			  <ul class="nav navbar-nav navbar-right">
				<li ><a href="#">Inicio</a></li>
				<li ><a href="#">Paciente</a></li>
				<li ><a href="#">Publicaciones</a></li>
				<li class="active"><a href="#">Configuración</a></li>
				 <form class="navbar-form navbar-left" role="search">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Buscar...">
				</div>
				<button type="submit" class="btn btn-default">Buscar</button>
			  </form>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
	</nav>

	<!-- seccion de configuracion del sistema -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1>Configuración del Sistema</h1>
	</div>
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
		<div class="list-group">
		  <span class="list-group-item active">Configuración</span>
		  <a href="#" id=datos_generales class="list-group-item">Datos generales </a>
		  <a href="#" id=servicios class="list-group-item">Servicios</a>
		  <a href="#" id=tipo_servicios class="list-group-item">Tipos de Servicios</a>
		  <a href="#" id=plantillas class="list-group-item">Plantillas</a>
		</div>
	</div>
	<div id="contenedor" class="col-lg-9 col-md-8 col-sm-8 col-xs-6" style="border:0px solid #ccc; height:400px; ">
		<iframe id="contenedor_data" src="" height="380px" width="100%" allowtransparency="1" frameborder="0" ></iframe>
	</div>
</div>
 <script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>
	$('#servicios').click( function (){
		$('#contenedor_data').attr('src', "cfg_servicios.php");
	});
	$('#tipo_servicios').click( function (){
		$('#contenedor_data').attr('src', "cfg_tipos_servicios.php");
	});
	$('#plantillas').click( function (){
		$('#contenedor_data').attr('src', "cfg_plantillas.php");
	});
</script>
<body>
<html>
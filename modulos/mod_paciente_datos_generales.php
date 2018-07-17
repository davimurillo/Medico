<!DOCTYPE html>

    
  
<?php require_once('common.php'); checkUser(); //chequeo de usuario entrante 
//selecciona los modulos segun el tipo de usuario y asignaciones
	$sql="SELECT tx_documento, (tx_nombres_apellidos) as nombre, CASE WHEN nu_sexo='12' THEN 'Femenino' ELSE 'Masculino' END AS nu_sexo, tx_foto, to_char(fe_actualizacion,'DD  Mon YYYY') as fecha_actualizacion, to_char(fe_nacimiento,'DD/MM/YYYY') as fe_nacimiento, fe_nacimiento as fecha_nacimiento, tx_ocupacion, (SELECT tx_nombre FROM cfg_configuracion_general WHERE id_configuracion=a.n_pais) AS pais, tx_provincia, tx_direccion, tx_telefono, tx_otro_telefono, tx_correo, CASE WHEN n_pais=14 THEN 'V' ELSE 'E' END AS nacionalidad, (SELECT tx_nombre FROM cfg_configuracion_general WHERE id_configuracion=a.id_tipo_documento) AS tipo_documento, (SELECT to_char(fe_diagnostico,'DD Mon YYYY') FROM tbl_diagnostico WHERE id_paciente=a.id_paciente ORDER BY id_diagnostico DESC LIMIT 1) as ultima_fecha   FROM tbl_paciente a WHERE id_paciente=".$_GET['id']." and id_estatus=1";
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
		$row['nombre'];
		$foto=$row['tx_foto'];
	
	
	if ($foto==""){
		$foto="../img/fotos/img.jpg";	
	}else{
		$foto="uploads/foto_paciente/".trim($foto);
	}
	
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	<link href="../lib/css/font-awesome.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="../lib/css/animate.css" >
	<link id="switcher" href="../lib/css/theme-color/lite-blue-theme.css" rel="stylesheet">
	  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	 
</head>
<body>

<div class="container-fluid" >




<div class="row animated slideInLeft">		
<div class="panel panel-default">
  <div class="panel-heading" >
	<div class="row">
		<div class="col s6">
			<h5 ><i class="fa fa-user"></i> Datos Generales del Paciente</h5>
		</div>
		<div  align="right"  class="col s6" >
				<label > Ultima Actualización: </label> <?php echo $row['fecha_actualizacion']; ?>
		</div>
		<div  align="right"  class="col s6" >
				<label > Ultima Visita: </label> <?php echo $row['ultima_fecha']; ?>
		</div>
	</div>
  </div>
  
  
  <div class="panel-body">
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
			<?php echo $row['nombre']; ?>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
			<?php echo $row['tipo_documento']; ?>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
		 <?php echo $row['nacionalidad']." - ".$row['tx_documento']; ?>
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
			<label> Sexo: </label> <?php echo $row['nu_sexo']; ?>
		</div>
		
	
	
	<?php 
		date_default_timezone_set('America/Caracas');
			$datetime1 = new DateTime("now");
			$datetime2 = new DateTime($row['fecha_nacimiento']);
			$interval = date_diff($datetime2, $datetime1);
			$años=$interval->format('%Y');
			
						
	?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:5px;  ">
			<label> Fecha de Nacimiento: </label> <?php echo $row['fe_nacimiento']; ?> (<?php echo $años; ?> Años)
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> Ocupación: </label> <?php echo $row['tx_ocupacion']; ?> 
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> País: </label> <?php echo $row['pais']; ?> 
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> Provincia: </label> <?php echo $row['tx_provincia']; ?> 
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> Dirección: </label> <?php echo $row['tx_direccion']; ?> 
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> Teléfono: </label> <?php echo $row['tx_telefono']; ?> 
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> Movil: </label> <?php echo $row['tx_otro_telefono']; ?> 
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" ">
			<label> Email: </label> <?php echo $row['tx_correo']; ?> 
	</div>
	</div>
	</div>
	</div>
	
</div>
</div>
<?php cierradatabase(); ?>
 <script src="../lib/js/jquery.min.js"></script>
<script src="../lib/js/bootstrap.min.js" ></script>

<body>
<html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	<link href="../lib/css/font-awesome.css" rel="stylesheet">
	
   <link rel="stylesheet" href="../lib/css/animate.css" >
   
	<style>
		#usuario_perfil {
			width: 88px;
			height: 88px;
			margin-right: 5px;
		}
	</style>
</head>
<body>

<div class="container-fluid">
		<?php include('cfg_encabezado.php'); 
		$sql="SELECT tx_documento, (tx_nombres_apellidos) as nombre, CASE WHEN nu_sexo='12' THEN 'Femenino' ELSE 'Masculino' END AS nu_sexo, tx_foto, to_char(fe_actualizacion,'DD  Mon YYYY') as fecha_actualizacion, to_char(fe_nacimiento,'DD/MM/YYYY') as fe_nacimiento, fe_nacimiento as fecha_nacimiento, tx_ocupacion, (SELECT tx_nombre FROM cfg_configuracion_general WHERE id_configuracion=a.n_pais) AS pais, tx_provincia, tx_direccion, tx_telefono, tx_otro_telefono, tx_correo, CASE WHEN n_pais=14 THEN 'V' ELSE 'E' END AS nacionalidad, (SELECT tx_nombre FROM cfg_configuracion_general WHERE id_configuracion=a.id_tipo_documento) AS tipo_documento, (SELECT to_char(fe_diagnostico,'DD Mon YYYY') FROM tbl_diagnostico WHERE id_paciente=a.id_paciente ORDER BY id_diagnostico DESC LIMIT 1) as ultima_fecha, tx_telefono, tx_correo   FROM tbl_paciente a WHERE id_paciente=".$_GET['id']." and id_estatus=1";
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
		$nombre_paciente=$row['nombre'];
		$telefono=$row['tx_telefono'];
		$mail=$row['tx_correo'];
		$fecha_nacimiento=$row['fe_nacimiento'];
		$sexo=$row['nu_sexo'];
		$foto=$row['tx_foto'];
		$identificacion=$row['nacionalidad']." - ".$row['tx_documento']; 
		$ultima_visita=$row['ultima_fecha'];
		if ($foto=="" or $foto==null){
		$foto="../img/fotos/img.jpg";	
		}else{
		$foto="uploads/foto_paciente/".trim($foto);
		}
		
		date_default_timezone_set('America/Caracas');
			$datetime1 = new DateTime("now");
			$datetime2 = new DateTime($row['fecha_nacimiento']);
			$interval = date_diff($datetime2, $datetime1);
			$años=$interval->format('%Y');
		cierradatabase();
		?>

	<!-- seccion del paciente -->
	<!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>

 

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
	<div class="row" style="margin-top:20px">	
	
	
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 grey lighten-3 z-depth-2" style="margin-right:25px; margin-bottom:20px" >
		<div align="center" class="col s12 m12 l12 xl4" style="margin:10px 5px 10px -5px;">
			<img id="usuario_perfil" src="<?php echo $foto; ?>"  >  
		</div>
		<div align="center" class="col s12 m12 l12 xl8 light-blue darken-1" style="color:#fff; margin:10px 0px 0px 0px; padding-top:5px">
			
				<h6><strong><?php echo $nombre_paciente; ?></strong></h6>
				<h5 style="margin-top:-2px; font-size:20px"><?php echo "Edad ".$años." Años"; ?></h5>
			
		</div>
		<div align="center" class="col col s12 m12 l12 xl8 grey" style="color:#fff; font-size:14px; margin:5px 0px 0px 0px;">
			
				<?php echo "Ultima Visita: ".$ultima_visita; ?>
			
		</div>
		
		<!-- Contactos -->
		
		<div class="col s12 m12  grey lighten-5 z-depth-1" style="margin:10px 0px 10px 0px; ">
			<div class="col s12 m12" style="margin:10px 0px 10px 0px; font-size:10px; color:#0CB1E9">
				<strong>Contacto</strong> 
			</div>  
			<div align="right" class="col s12 m12  " style="margin:-20px 0px 10px 0px" >
				<a href="https://api.whatsapp.com/send?phone=<?php echo $telefono; ?>" class="btn-floating btn waves-effect waves-light blue darken-1"><i class="fa fa-whatsapp"></i></a>
				<a href="tel:<?php echo $telefono; ?>" class="btn-floating btn waves-effect waves-light blue darken-1"><i class="fa fa-phone"></i></a>
				<!-- <a class="btn-floating btn waves-effect waves-light blue darken-34"><i class="fa fa-share-alt"></i></a> -->
				<a href="mailto:<?php echo $mail; ?>" class="btn-floating btn waves-effect waves-light blue darken-1"><i class="fa fa-envelope-o"></i></a>
			</div> 
			
			
		</div>
		
		<!-- Citas -->
		
		<div class="col s12 m12  grey lighten-5 z-depth-1" style="margin:0px 0px 10px 0px; ">
			<div class="col s12 m12" style="margin:10px 0px 10px 0px; font-size:10px; color:#0CB1E9">
				<strong>Citas</strong> 
			</div>  
			<div align="right" class="col s12 m12  "  style="margin:-20px 0px 10px 0px">
				
				<a href="mod_paciente_citas.php?id=<?php echo $_GET['id']; ?> " class="btn-floating btn waves-effect waves-light  blue darken-1"><i class="fa fa-calendar"></i></a>
			</div> 
			
			
		</div>
		
		<!-- Cirugías -->
		
		<div class="col s12 m12  grey lighten-5 z-depth-1" style="margin:0px 0px 10px 0px; ">
			<div class="col s12 m12" style="margin:10px 0px 10px 0px; font-size:10px; color:#0CB1E9">
				<strong>Cirugías</strong> 
			</div>  
			<div align="right" class="col s12 m12  "  style="margin:-20px 0px 10px 0px">
				
				<a href="mod_paciente_cirugias.php?id=<?php echo $_GET['id']; ?> " class="btn-floating btn waves-effect waves-light  blue darken-1"><i class="fa fa-heartbeat"></i></a>
			</div> 
			
			
		</div>
		
		
		<!-- Historia Clinica -->
		
		<div class="col s12 m12  grey lighten-5 z-depth-1" style="margin:0px 0px 10px 0px; ">
			<div class="col s12 m12" style="margin:10px 0px 10px 0px; font-size:10px; color:#0CB1E9">
				<strong>Historia Clinica</strong> 
			</div>  
			<div align="right" class="col s12 m12  " style="margin:-20px 0px 10px 0px" >
				
				<a href="mod_paciente_historia_medica.php?id=<?php echo $_GET['id']; ?>" class="btn-floating btn waves-effect waves-light  blue darken-1"><i class="fa fa-stethoscope"></i></a>
			</div> 
			
			
		</div>
		
		<!-- Facturación		-->
		
		<div class="col s12 m12  grey lighten-5 z-depth-1" style="margin:0px 0px 10px 0px; ">
			<div class="col s12 m12" style="margin:10px 0px 10px 0px; font-size:10px; color:#0CB1E9">
				<strong>Facturas</strong> 
			</div>  
			<div align="right" class="col s12 m12  " style="margin:-20px 0px 10px 0px" >
				
				<a href="mod_paciente_factura.php?id=<?php echo $_GET['id']; ?> " class="btn-floating btn waves-effect waves-light  blue darken-1"><i class="fa fa-list-ul"></i></a>
			</div> 
			
			
		</div>
		
		<!-- Consultas		-->
		
		<div class="col s12 m12  grey lighten-5 z-depth-1" style="margin:0px 0px 10px 0px;  ">
			<div class="col s12 m12" style="margin:10px 0px 10px 0px; font-size:10px; color:#0CB1E9">
				<strong>Total Consultas</strong> 
			</div>  
			<div align="right" class="col s12 m12  " style="margin:-20px 0px 10px 0px" >
				
				<a class="btn-floating btn waves-effect waves-light  blue darken-1"><i class="fa ">4</i></a>
			</div> 
			
			
		</div>
		
	
	</div>
	
	
	<!-- contenido  --->
	
	
	
	
		
		<div class="row">
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 grey lighten-5 z-depth-1" style="margin-top:10px; margin-bottom:10px" >
			<div class="col s12 m12  teal lighten-1" style="margin:10px 0px 10px 0px; color:#FFF">
				<div class="col s8">
					<i class="fa fa-calendar" style="font-size:20px; margin-top:10px"></i> <strong>Citas</strong> 
				</div>
				<div align="right" class="col s4" style="margin:5px 0px 5px 0px">
					<a class="btn-floating btn waves-effect waves-light "><i class="fa fa-plus "></i></a>
				</div>
				
			</div>  
			<div  class="col s12 m12  " style="margin:0px 0px 10px 0px;" >
				<?php 
				
				$sql="SELECT to_char(fe_cita,'DD Mon YYYY') as fe_citas,
  tbl_cita.id_cita, 
  tbl_cita.id_paciente,  
  tbl_cita.tx_motivo, 
  tbl_cita.id_estatus, 
  cfg_tipo_objeto.tx_tipo, 
  tbl_cita.id_servicio, 
  tbl_consultorio.tx_nombre_consultorio
FROM 
  public.tbl_cita, 
  public.tbl_consultorio, 
  public.cfg_tipo_objeto
WHERE 
  tbl_cita.id_consultorio = tbl_consultorio.id_consultorio AND
  tbl_cita.n_tipo_cita = cfg_tipo_objeto.id_tipo_objeto and id_paciente=".$_GET['id']." and id_estatus=5 ORDER BY fe_cita DESC LIMIT 3 ";
					
					$res=abredatabase(g_BaseDatos,$sql);
					while($row=dregistro($res)){
				?>		
				    <div class="col s4 m4 l4 xl4 ">
						<label><?php echo $row['tx_tipo']; ?>:</label>
					</div>
					<div align="right" class="col s8 m8 l8 xl8 ">
						<?php echo $row['fe_citas']; ?>
					</div>
					
					<div class="col s12 " style="font-size:12px">
						<?php echo $row['tx_motivo']; ?>
						<hr>
					</div>
					
					

				<?php
					}
				
				?>
					
			</div> 
			
			
		</div>
		
		
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 grey lighten-5 z-depth-1" style="margin-top:10px; margin-bottom:10px" >
			<div class="col s12 m12  blue lighten-3" style="margin:10px 0px 10px 0px; color:#FFF">
				<div class="col s8">
					<i class="fa fa-calendar" style="font-size:20px; margin-top:10px"></i> <strong>Facturación</strong> 
				</div>
				<div align="right" class="col s4" style="margin:5px 0px 5px 0px">
					<a class="btn-floating btn waves-effect waves-light blue lighten-3"><i class="fa fa-plus "></i></a>
				</div>
				
			</div>  
			<div  class="col s12 m12  " style="margin:0px 0px 10px 0px;" >
				<?php 
				
				$sql="SELECT 
  tbl_factura.id_paciente, 
  tbl_factura.fe_actualizacion, 
  tbl_factura.id_factura, 
  cfg_tipo_objeto.tx_tipo, 
  to_char(tbl_factura.fe_creacion,'DD Mon YYYY') as fe_creacion,
  tbl_factura.nu_monto
  
FROM 
  public.tbl_factura, 
  public.tbl_diagnostico, 
  public.cfg_tipo_objeto
WHERE 
  tbl_factura.id_diagnostico = tbl_diagnostico.id_diagnostico AND
  tbl_diagnostico.n_tipo_diagnostico = cfg_tipo_objeto.id_tipo_objeto ORDER BY id_factura DESC LIMIT 3 ";
					
					$res=abredatabase(g_BaseDatos,$sql);
					while($row=dregistro($res)){
				?>		
				    <div class="col s4 m4 l4 xl4 ">
						<label><?php echo $row['tx_tipo']; ?>:</label>
					</div>
					<div align="right" class="col s8 m8 l8 xl8 ">
						<?php echo $row['fe_creacion']; ?>
					</div>
					
					<div class="col s12 " style="font-size:12px">
						Factura N°: <?php echo $row['id_factura']; ?> |
						Monto Bs.:<?php echo number_format($row['nu_monto'],2); ?>
						<hr>
					</div>
					
					

				<?php
					}
				
				?>
					
			</div>  
			
			
		</div>
			
		</div>
		
		
	
	
	
	
</div>
</div>
 
<body>
<html>
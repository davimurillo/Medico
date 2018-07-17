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
		
		<!-- 
					
		##################################################################################   
		## +---------------------------------------------------------------------------+##
		## | 1. Modulo Inicio							                               |## 
		## +---------------------------------------------------------------------------+##
		##################################################################################
					
			-->
			
			<?php   $c=0;
		$sql="SELECT tx_nombres_apellidos, tx_foto_intro, tx_descripcion,  tx_breve_biografia FROM tbl_doctor";		
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
	?>
				
		<div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated slideInDown" style="margin-top:110px">
          <!-- Start welcome area -->
          <div class="welcome-area">
            <div class="title-area">
              <h2 class="tittle">Bienvenido <span> <?php echo $_SESSION['nombre']; ?></span></h2>
              <span class="tittle-line"></span>
            
            </div>
          </div>
          <!-- End welcome area -->
        </div>
      </div>
      
    </div>
		<?php   cierradatabase(); ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated slideInLeft" align="center" style="margin-top:100px">
				<form action="mod_buscar.php" >
				<div class="input-group input-group-lg" style="width:70vw" >
					<input name="buscar" id="buscar" type="text" class="form-control" placeholder="Empiece a buscar pacientes, servicios, publicaciones..." style="font-size:0.9em">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
					</span>
				</div>
				</form>
			</div>
		
	
</div>
 
 
<script>
	$('#buscar').focus();
</script>
<body>
<html>
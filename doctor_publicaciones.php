<?php  require_once('common.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" itemprop="description" content="Cirujano General, Cirujano Plástico Estético y Reconstructivo, con más de 15 años de experiencia" />
   
    <title itemprop="name">Dr. Heiro Pinto | Cirujano Plástico Estético y Reconstructivo</title>
    <!-- Favicon -->
    
	<link rel="shortcut icon" type="image/x-icon" href="img/logos/drheiro_icono.png" />
    <!-- Font Awesome -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css"/> 
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css"/>  
     <!-- Theme color -->
    <link id="switcher" href="assets/css/theme-color/green-theme.css" rel="stylesheet">

   

    <!-- Fonts -->
    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Raleway for Title -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- Pacifico for 404 page   -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="ism/css/my-slider.css"/>
<script src="ism/js/ism-2.2.min.js"></script>
 <!-- Main Style -->
    <link href="style.css" rel="stylesheet">
	<style>
		div.avatar {
			
			/* cambia estos dos valores para definir el tamaño de tu círculo */
			height: 100px;
			width: 100px;
			/* los siguientes valores son independientes del tamaño del círculo */
			background-repeat: no-repeat;
			background-position: 50%;
			border-radius: 50%;
			background-size: 100% auto;
		}
	</style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php  require_once('common.php'); ?>
  <!-- BEGAIN PRELOADER -->
  
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start menu section -->
  <?php include_once ('encabezado.php'); ?>
  <!-- End menu section -->

	<?php   $c=0;
		$sql="SELECT tx_nombres_apellidos, tx_foto_intro, tx_descripcion,  tx_breve_biografia FROM tbl_doctor";		
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
	?>
  <!-- Start about section -->
  <section id="service">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- Start welcome area -->
          <div class="welcome-area">
            <div class="title-area">
              <h2 class="tittle">Bienvenido soy el <span>Dr. <?php echo $row['tx_nombres_apellidos']; ?></span></h2>
              <span class="tittle-line"></span>
            
            </div>
          </div>
          <!-- End welcome area -->
        </div>
      </div>
      
    </div>
  </section> 
  <!-- End about section -->

  <?php  
		$sql="SELECT to_char(fecha_creacion,'DD/MM/YYYY') as fecha_creacion, titulo, publicacion FROM publicaciones WHERE id_publicacion=".$_GET['id'];		
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
	?>
	<div class="row">
	<div class="container">
	
		<div align="right" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px; font-size:12px">
			Fecha de Publicación: <?php echo $row['fecha_creacion']; ?>
		</div>
		
		<div align="center" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="margin-top:10px; background-color:#ccc  ">
			<h2 class="tittle"> <?php echo $row['titulo']; ?> </h2>
			
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
			<hr>
			<?php echo $row['publicacion']; ?>
		</div>
	</div>
	</div>
	<?php  cierradatabase(); ?>

  <!-- Start Footer -->    
  <footer id="footer" style="margin-top:10px">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-top-area">             
                <a class="footer-logo" href="#"><img src="img/logos/logo.png" alt="Logo"></a>              
              <div class="footer-social">
                <a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
                <a class="twitter" href="#"><span class="fa fa-twitter"></span></a>
                <a class="google-plus" href="#"><span class="fa fa-google-plus"></span></a>
                <a class="youtube" href="#"><span class="fa fa-youtube"></span></a>
                <a class="linkedin" href="#"><span class="fa fa-linkedin"></span></a>
                <a class="dribbble" href="#"><span class="fa fa-instagram"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>Dr. Heiro Daniel Pinto Oliveira. <span>Todos los Derechos Reservados. Caracas, Venezuela 2016</span></p>
      <p>Diseñado por <a href="#">Sistemas y Comunicaciones S&C</a></p>
    </div>
  </footer>
  <!-- End Footer -->
  
  <!-- sección de inicio de la aplicación -->
  <div class="modal fade" tabindex="-1" id="myModal_sesion" role="dialog" style="color:#999">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title" style="color:#ccc">Inicio de Sesión de Usuario</h2>
		  </div>
		  <div class="modal-body" >
		   <div style="width:80%; margin-left:40px">
				<p style="margin-top:25px">Correo Electronico o Nombre de Usuario</p>
				<input type="textbox"  id="correo_usuario" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
				<p style="margin-top:25px">Clave de Acceso</p>
				<input type="password" id="clave_usuario" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
				<p style="margin-top:25px"></p>
			</div>
		  </div>
		  <div class="modal-footer"  style="text-align:center">
				  
			<div class="row" id="inicio_sesion" > </div>
			<button type="button" class="btn btn-success btn-lg" id="iniciar">Iniciar</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
  <!-- End Footer -->

  <!-- initialize jQuery Library --> 
  <script src="assets/js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- Slick Slider -->
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <!-- Counter -->
  <script type="text/javascript" src="assets/js/waypoints.js"></script>
  <script type="text/javascript" src="assets/js/jquery.counterup.js"></script>
  <!-- mixit slider -->
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="assets/js/wow.js"></script> 

  <!-- Custom js -->
  <script type="text/javascript" src="assets/js/custom.js"></script>
   <script>
		$( "#iniciar" ).click(function() {
		
			$( "#inicio_sesion" ).load( "modulos/login.php", { correo: $('#correo_usuario').val(),clave: $('#clave_usuario').val(), envio:"1"  } );
		});
	</script>
	
  </body>
</html>
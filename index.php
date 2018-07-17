<?php  require_once('common.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"  content="Cirujano General, Cirujano Plástico Estético y Reconstructivo, con más de 15 años de experiencia" />
   
    <title >Dr. Heiro Pinto | Cirujano Plástico Estético y Reconstructivo</title>
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

    <!-- Main Style -->
    <link href="style.css" rel="stylesheet">

    <!-- Fonts -->
    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Raleway for Title -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- Pacifico for 404 page   -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<!-- componente slider estilos -->
	<link rel="stylesheet" href="ism/css/my-slider.css"/>
	<!-- componente slider libreria js  -->
	<script src="ism/js/ism-2.2.min.js"></script>

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
	
	<!-- initialize jQuery Library --> 
  <script src="lib/js/jquery.min1.11.2.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <!-- Session de Consultorio y Telefonos -->
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#146E85; padding-top:8px; padding-bottom:8px; color:#fff; font-size:12px"> 
	<?php 
		$sql="SELECT id_consultorio,tx_nombre_consultorio, (tx_direccion || ',' || tx_ciudad || ',' || tx_estado) as direccion, tx_telefono, tx_horario,tx_ubicacion FROM tbl_consultorio WHERE n_estatus=1 ORDER BY id_consultorio";		
		$res=abredatabase(g_BaseDatos,$sql);
		while ($row=dregistro($res)){
	 ?>
	 <div align="center" class="col-lg6 col-md-6 col-sm-6 col-xs-6">
		<i class="fa fa-h-square" ></i> <?php echo $row["tx_nombre_consultorio"]; ?> | <i class="fa fa-phone"></i> <?php echo $row["tx_telefono"]; ?> 
	 </div>
		<?php } ?>

</div>
  <!-- BEGAIN PRELOADER -->
  <div id="preloader">
    <div class="loader" ></div>
  </div>
<!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->  
  <header id="header">
    <div class="header-inner">
     <div class="ism-slider" data-transition_type="fade" data-play_type="loop"  id="my-slider">
		  <ol>
			<li>
				<img src="ism/image/slides/tres-cirujanos-operando.jpg">
				<div class="carousel-caption">
					<div class="caption-wrapper">
						<div class="caption-info" style="text-align:left">
						<div id="nombre_doctor" class="animated bounceInUp" style=" color:#fff; font-weight:normal">DR. HEIRO PINTO</div>
						<div id="titulo_doctor" class="animated bounceInLeft" style=" color:#166E86; ">CIRUJANO PLÁSTICO ESTÉTICO <BR>Y RECONSTRUCTIVO</div>
						<p id="especialidad_doctor" class="animated fadeInDown">Especialista en Cirugía Plástica, Reconstructiva, <br> Maxilofacial y Estética. Cirugía Postbariátrica.</p>
						<div id="boton_mas_informacion" class="scroll animated fadeInUp"><a href="#works" class="btn btn-info"><i class="fa fa-user-md" style="font-size:120%"></i>  Mas información</a> </div>
						</div>
					</div>
				</div>    
			</li>
			<li style="text-align:left">
			  <img src="ism/image/slides/estetica.jpg">
				
				<div class="scroll animated fadeInUp"  >
					<a href="#team" >
						<div id="boton_cita" class="btn btn-lg" style="background-color:#166E86; color:#fff; margin-left:10vh; margin-top:25vh">
							 <i class="fa fa-calendar" style="font-size:120%;"></i>  Agenda tu cita. 
						</div>
					</a>
				</div>
				 
			</li>
			<li>
			  <img src="ism/image/slides/rinoplastia.jpg">
					<div class="carousel-caption">
						<div class="caption-wrapper">
							<div class="caption-info" align="right">
								
								<div class="scroll animated fadeInUp"  >
									<a href="#team" >
										<div class="btn btn-lg" style="background-color:#166E86; color:#fff; ">
											 <i class="fa fa-calendar" style="font-size:120%;"></i>  Agenda tu cita. 
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
			</li>
		  </ol>
		</div>
      </div>      
    </div>
  </header>
  <!-- End header section -->

  <!-- Start menu section -->
   <?php include_once ('encabezado.php'); ?>
  <!-- End menu section -->
<?php 
	//determina los servicios
	$servicios="";
	$sql="SELECT nombre FROM cfg_maestro WHERE id_nivel_maestro=2 ";		
	$res=abredatabase(g_BaseDatos,$sql);
	while ($row=dregistro($res)){
		$servicios.=','.$row['nombre'];
	}
	cierradatabase();
	date_default_timezone_set('America/Caracas');
	$fecha_actual=date('Y');
	//obtine los datos del doctor
	$sql="SELECT tx_nombres_apellidos, tx_foto_intro, tx_descripcion,  tx_breve_biografia FROM tbl_doctor";		
	$res=abredatabase(g_BaseDatos,$sql);
	$row=dregistro($res);
	$doctor=$row['tx_nombres_apellidos'];
	$description=$row['tx_descripcion'];
	cierradatabase();
	?>
  
  <!-- Start about section -->
  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Start welcome area -->
          <div class="welcome-area">
            <div class="title-area">
              <h2 class="tittle">Bienvenido soy el <span>Dr. <?php echo $doctor; ?></span></h2>
			  
              <span class="tittle-line"></span>
              <p><?php echo $description; ?></p>
            </div>
            
          </div>
          <!-- End welcome area -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="about-area">
            <div class="row">
              <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="about-left wow fadeInLeft">
                  <img src="modulos/uploads/<?php echo $row['tx_foto_intro']; ?>" alt="img">
                  <a class="introduction-btn" href="biografia_doctor.php">Introducción</a>
                </div>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="about-right wow fadeInRight">
                  <div class="title-area">
                    <h2 class="tittle">Todo <span>sobre</span> <?php echo $row['tx_nombres_apellidos']; ?></h2>
                    <span class="tittle-line"></span>
                    <p><?php echo $row['tx_breve_biografia']; ?></p>
                    <div class="about-btn-area">
                      <a href="biografia_doctor.php" class="button button-default" data-text="ABRIR"><span>LEER MÁS</span></a>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </di
    </div>
  </section> 
  <!-- End about section -->

  

  

  <!-- Start service section -->
  <section id="service">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="service-area">
            <div class="title-area">
              <h2 class="tittle">SERVICIOS</h2>
              <span class="tittle-line"></span>
              <p>Aquí encontraras el mejor servicio, tranquilidad y calidad humana para que tu cuerpo se sienta mejor</p>
            </div>
            <!-- service content -->
            
                
				<?php   
						
						$c=0;
						$sql="SELECT id_maestro,nombre, breve_descripcion, imagen_archivo FROM cfg_maestro WHERE id_nivel_maestro=2 ";		
						$res=abredatabase(g_BaseDatos,$sql);
						while ($row=dregistro($res)){
						if ($c==0){ 
							echo ' <div class="service-content">
              <ul class="service-table">'; 
						}
						
				?>
                <li class="col-md-3 col-sm-6">
				  <a href="servicios_publicaciones.php?id=<?php echo $row['id_maestro']; ?>">
                  <div class="single-wc-content wow fadeInUp">
                    <div align="center"> <div class="avatar" style="background-image: url('lib/images/<?php echo $row['imagen_archivo']; ?>');"></div></div>
                    <h4 class="wc-tittle" style="font-size:100%"><?php echo $row['nombre']; ?></h4>
                    <?php echo $row['breve_descripcion']; ?>
                  </div>
				  </a>
                </li>
				<?php 	$c++;
						if ($c==4){ $c=0; echo "</ul> </div>"; } 
						
						} cierradatabase();
					
						
				?>
         
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End service section -->

  <!-- Start galeria section -->
  <section id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="portfolio-area">
            <div class="title-area">
              <h2 class="tittle">GALERIA</h2>
              <span class="tittle-line"></span>
              <p>Muestra del trabajo, calidad, garántia y satisfacción de mis pacientes...</p>
            </div>
            <!-- Portfolio content -->
            <div class="portfolio-content">
                <!-- portfolio menu -->
               <div class="portfolio-menu">
                 <ul>
                   <li class="filter" data-filter="all">TODOS</li>
                   <li class="filter" data-filter=".RINOPLASTIA">RINOPLASTIA</li>
                   <li class="filter" data-filter=".CIRUJIA_RECONSTRUCTIVA">CIRUGÍA RECONSTRUCTIVA</li>
                   <li class="filter" data-filter=".MAMOPLASTIA">MAMOPLASTIA</li>
                   <li class="filter" data-filter=".OTRAS">OTRAS</li>
                 </ul>
               </div>
               <!-- Portfolio container -->
               <div id="mixit-container" class="portfolio-container">
					<?php 
						$sql="SELECT id_galeria,tx_foto, tx_descripcion, tx_categoria FROM tbl_galeria WHERE id_estatus=1 ORDER BY id_galeria DESC LIMIT 10  ";		
						$res=abredatabase(g_BaseDatos,$sql);
						while ($row=dregistro($res)){
					?>
				 <div class="single-portfolio mix <?php echo $row['tx_categoria']; ?>">
                   <div class="single-item">
                     <img src="img/galeria/<?php echo $row['tx_foto']; ?>" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="img/galeria/<?php echo $row['tx_foto']; ?>"><i class="fa fa-eye"></i></a>
                        
                        </div>
                        <div class="portfolio-title">
                          <h4><?php echo $row['tx_categoria']; ?></h4>
                          <span><?php echo $row['tx_descripcion']; ?></span>
                        </div>
                     </div>
                   </div>
                 </div>
				 
						<?php } cierradatabase(); ?>
                
               </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Portfolio section -->

 
 <!-- Start from publicaciones section -->
  <section id="from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="from-blog-area">
            <div class="title-area">
              <h2 class="tittle">PUBLICACIONES</h2>
              <span class="tittle-line"></span>
              <p>Aquí te dejo varios articulos para su interes...</p>
            </div>
            <!-- From Blog content -->
            <div class="from-blog-content">
			 
              <div class="row">
			   <?php 
				$sql="SELECT id_publicacion,imagen, titulo, descripcion, to_char(fecha_creacion,'DD/MM/YYYY') as fecha FROM publicaciones WHERE estatus=1 ORDER BY id_publicacion DESC LIMIT 3";		
				$res=abredatabase(g_BaseDatos,$sql);
				while ($row=dregistro($res)){
			  ?>
                <div class="col-md-4">
                  <article class="single-from-blog">
                    <figure>
                      <a href="doctor_publicaciones.php?id=<?php echo $row['id_publicacion']; ?>">
						<img src="img/publicaciones/<?php echo $row['imagen']; ?>" alt="img">
					  </a>
                    </figure>
                    <div class="blog-title">
                      <h2><a href="blog-single.html"><?php echo $row['titulo']; ?></a></h2>
                      <p>Publicado por <a class="blog-admin" href="#">admin</a> en <span class="blog-date"><?php echo $row['fecha']; ?></span></p>
                    </div>
                    <p><?php echo $row['descripcion']; ?></p>
                    <div class="blog-footer">
                      <!--
					  <a href="#"><span class="fa fa-comment"></span>18 Comments</a>
                      <a href="#"><span class="fa fa-thumbs-o-up"></span>35 Likes</a>
					  -->
                    </div>
                  </article>
                </div>
                <?php } cierradatabase(); ?>
              </div>    
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End from blog section -->
 
  <!-- Start from contactos section -->
  <section id="team" >
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="contact-left wow fadeInLeft">
            <div class="title-area">
              <h2 class="tittle" style="margin-top:30px">¿DONDE PUEDES ATENDERTE?</h2>
              <span class="tittle-line"></span>
              <p>Aquí podrás ubicarme...</p>
            </div>
           
              <div class="row" >
			   <?php 
				$sql="SELECT id_consultorio,tx_nombre_consultorio, (tx_direccion || ',' || tx_ciudad || ',' || tx_estado) as direccion, tx_telefono, tx_horario,tx_ubicacion FROM tbl_consultorio WHERE n_estatus=1 ORDER BY id_consultorio";		
				$res=abredatabase(g_BaseDatos,$sql);
				while ($row=dregistro($res)){
			  ?>
                <div class="col-md-6" >
                  <article class="single-from-blog" style="border:1px solid #ccc; height:450px">
                     <div class="blog-title">
                      <h2><i class="fa fa-hospital-o"></i> <?php echo $row['tx_nombre_consultorio']; ?></h2>
                    </div>
                    <p><i class="fa fa-map-marker"></i> <label>Dirección</label><br><?php echo $row['direccion']; ?></p>
                    <p><i class="fa fa-clock-o"></i> <label>Horarios</label><br><?php echo $row['tx_horario']; ?></p>
                    <p><i class="fa fa-phone"></i> <label>Teléfono(s)</label><br><?php echo $row['tx_telefono']; ?></p>
                    <div class="blog-footer">
					  <button class="btn btn-info" id="mapa_boton<?php echo $row['id_consultorio']; ?>" >Ver el Mapa</button>
					   <button class="btn btn-info" id="Cita<?php echo $row['id_consultorio']; ?>" Onclick="javascript:solicitar_cita(<?php echo $row['id_consultorio']; ?>);" >Solicitar Cita</button>
					    <button class="btn btn-info" id="mensaje<?php echo $row['id_consultorio']; ?>" Onclick="" >Contactar</button>
                      <!--
					  <a href="#"><span class="fa fa-comment"></span>18 Comments</a>
                      <a href="#"><span class="fa fa-thumbs-o-up"></span>35 Likes</a>
					  -->
                    </div>
					<script>
						
						$( "#mapa_boton<?php echo $row['id_consultorio']; ?>" ).click(function() {
							$url="<?php echo $row['tx_ubicacion']; ?>";
							$('#mapa').attr('src',$url);
							$('#myModal_mapa').modal('show');
			
						});
					</script>
                  </article>
                </div>
                <?php } cierradatabase(); ?>
				
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End contactos section -->

 
 

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
	   <form id="form1" action="javascript:iniciar();">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title" style="color:#ccc"> <i class="fa fa-user"></i> Inicio de Sesión de Usuario</h2>
		  </div>
		  <form id="form1" action="javascript:iniciar();">
		  <div class="modal-body" >
		  
		   <div style="width:80%; margin-left:40px">
				<p style="margin-top:25px">Correo Electrónico</p>
				<input type="textbox"  id="correo_usuario" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
				<p style="margin-top:25px">Clave de Acceso</p>
				<input type="password" id="clave_usuario" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
				<p style="margin-top:25px"></p>
			</div>
			
		  </div>
		  <div class="modal-footer"  style="text-align:center">
				  
			<div class="row" id="inicio_sesion" > </div>
			<button type="submit" class="btn btn-info btn-lg" id="iniciar">Iniciar</button>
		  </div>
		  </form>
		</div><!-- /.modal-content -->
		</form>
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Modal visualizar mapa-->
	<div class="modal fade" id="myModal_mapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document" style="width:98%">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Mapa de Ubicación</h4>
		  </div>
		  <div class="modal-body" style="height:60vh">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<iframe id="mapa" src="" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				
				
				
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>
	
 <!-- Modal Solicitar Cita -->
	<div class="modal fade" id="myModal_cita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document" >
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar" ></i> Solicitar Cita </h4>
		  </div>
		  <div id="datos_cita" class="modal-body" >
			 <div class="row">
				 <div class="col-md-6">
							
					<span id="consultorio_datos"></span>
					
					
				</div>
				 <div class="col-md-6">
						 <h3><i class="fa fa-user"></i> Datos del Paciente</h3>
						<p style="margin-top:25px">Nombres y Apellidos</p>
						<input type="textbox" id="nombre_paciente" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
					
						<p style="margin-top:25px">Correo Electrónico</p>
						<input type="textbox"  id="correo_paciente" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
						
						<p style="margin-top:25px">N° de Télefono</p>
						<input type="textbox"  id="correo_paciente" style="width:100%; border-top:none; border-left:none; border-right:none; border-bottom:solid 1px #999" >
					
						<p style="margin-top:25px; text-align:center"> <button type="button" class="btn btn-info" data-dismiss="modal">Enviar</button></p>
				 </div>
			</div>
		  </div>
		  
		</div>
	  </div>
	</div>
 
  
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
		function iniciar(){
				$( "#inicio_sesion" ).load( "modulos/login.php", { correo: $('#correo_usuario').val(),clave: $('#clave_usuario').val(), envio:"1"  } );
		}
		$( "#iniciar" ).click(function() {
		
			$( "#inicio_sesion" ).load( "modulos/login.php", { correo: $('#correo_usuario').val(),clave: $('#clave_usuario').val(), envio:"1"  } );
			
		});
		
		function solicitar_cita(id) {
			$('#myModal_cita').modal('show');
			//url="mod_contactos.php?empresa="+id+"&f=1";
			$('#consultorio_datos').load( "consultorio_datos.php", { id: id  } );
	    }
		
		
 </script>
  </body>
</html>
<?php  require_once('common.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
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
	cierradatabase();
	?>
	<meta name="keywords" content="Cirugía Plástica, cirujano plastico, miss venezuela, heiro pinto <?php echo $servicios; ?>" />
	<meta name="rights" content="© <?php echo $fecha_actual; ?> Todos los Derechos Reservados por el Dr. <?php echo $doctor; ?> ι  Creado y Administrado por: Sistemas y Comunicaciones S&C" />
	<meta name="description" content="Miembro Activo de las Sociedades de Cirugía Plástica Venezolana e Ibero Latinoamericana SVCPREM y FILACP y Cirujano Plástico Oficial de la Organización Miss Venezuela" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dr. <?php echo $doctor; ?> </title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="lib/images/favicon.ico"/>
      <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
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
    <link id="switcher" href="assets/css/theme-color/lite-blue-theme.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="style.css" rel="stylesheet">

    <!-- Fonts -->
    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Raleway for Title -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <!-- Pacifico for 404 page   -->
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="ism/css/my-slider.css"/>
	<script src="ism/js/ism-2.1.js"></script>
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

  <!-- BEGAIN PRELOADER -->
  <div id="preloader">
    <div class="loader">&nbsp;</div>
  </div>
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header section -->  
  <header id="header">
    <div class="header-inner">
      <div class="ism-slider" data-transition_type="fade" data-play_type="once-rewind" data-image_fx="zoompan" data-radios="false" data-radio_type="thumbnail" id="my-slider">
  <ol>
    <li>
      <img src="ism/image/slides/tres-cirujanos-operando.jpg">
      <div class="ism-caption ism-caption-0 ">My slide caption text</div>
    </li>
    <li>
      <img src="ism/image/slides/estetica.jpg">
      
    </li>
    <li>
      <img src="ism/image/slides/apertura-cita-medico-movil.jpg">
     
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

	<?php   $c=0;
		$sql="SELECT tx_nombres_apellidos, tx_foto_intro, tx_descripcion,  tx_breve_biografia FROM tbl_doctor";		
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
	?>
  <!-- Start about section -->
  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Start welcome area -->
          <div class="welcome-area">
            <div class="title-area">
              <h2 class="tittle">Bienvenido soy el <span>Dr. <?php echo $row['tx_nombres_apellidos']; ?></span></h2>
              <span class="tittle-line"></span>
              <p><?php echo $row['tx_descripcion']; ?></p>
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
                  <a class="introduction-btn" href="#">Introducción</a>
                </div>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="about-right wow fadeInRight">
                  <div class="title-area">
                    <h2 class="tittle">Todo <span>sobre</span> <?php echo $row['tx_nombres_apellidos']; ?></h2>
                    <span class="tittle-line"></span>
                    <p><?php echo $row['tx_breve_biografia']; ?></p>
                    <div class="about-btn-area">
                      <a href="#" class="button button-default" data-text="ABRIR"><span>LEER MÁS</span></a>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End about section -->

  <!-- Start call to action -->
  <section id="call-to-action">
    <img src="lib/images/call-to-action-bg.jpg" alt="img">
    <div class="call-to-overlay">
      <div class="container">
        <div class="call-to-content wow fadeInUp">
          <h2>Dejame ayudarte a encotrar la belleza que a en tí</h2>
          <a href="#" class="button button-default" data-text="Ahora" data-toggle="modal" data-target="#myModal_citas"><span>Solicita una Cita</span></a>
        </div>
      </div>
    </div> 
  </section>
  <!-- End call to action -->

  

  <!-- Start service section -->
  <section id="service">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="service-area">
            <div class="title-area">
              <h2 class="tittle">Servicios</h2>
              <span class="tittle-line"></span>
              <p>Aquí encontraras el mejor servicio, tranquilidad y calidad humana para que tu cuerpo se sienta mejor</p>
            </div>
            <!-- service content -->
            
                
				<?php   
						cierradatabase();
						$c=0;
						$sql="SELECT id_maestro,nombre, breve_descripcion, imagen_archivo FROM cfg_maestro WHERE id_nivel_maestro=2 ";		
						$res=abredatabase(g_BaseDatos,$sql);
						while ($row=dregistro($res)){
						if ($c==0){ 
							echo '<div class="welcome-content"><ul class="wc-table" style="width:100%">'; 
						}
						
				?>
                <li>
				  <a href="servicios_publicaciones.php?id=<?php echo $row['id_maestro']; ?>">
                  <div class="single-wc-content wow fadeInUp">
                    <div align="center"> <div class="avatar" style="background-image: url('lib/images/<?php echo $row['imagen_archivo']; ?>');"></div></div>
                    <h4 class="wc-tittle"><?php echo $row['nombre']; ?></h4>
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

    <!-- Start Portfolio section -->
  <section id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="portfolio-area">
            <div class="title-area">
              <h2 class="tittle">Recent portfolio</h2>
              <span class="tittle-line"></span>
              <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</p>
            </div>
            <!-- Portfolio content -->
            <div class="portfolio-content">
                <!-- portfolio menu -->
               <div class="portfolio-menu">
                 <ul>
                   <li class="filter" data-filter="all">All</li>
                   <li class="filter" data-filter=".branding">Branding</li>
                   <li class="filter" data-filter=".design">Design</li>
                   <li class="filter" data-filter=".development">Development</li>
                   <li class="filter" data-filter=".photography">Photography</li>
                 </ul>
               </div>
               <!-- Portfolio container -->
               <div id="mixit-container" class="portfolio-container">
                 <div class="single-portfolio mix branding">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small1.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big1.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix design">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small2.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big2.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix development">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small3.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big3.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix photography">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small4.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big4.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix photography">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small5.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big5.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix photography">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small6.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big6.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix photography">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small7.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big7.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="single-portfolio mix photography">
                   <div class="single-item">
                     <img src="assets/images/portfolio-img-small2.jpg" alt="img">
                     <div class="single-item-content">
                        <div class="portfolio-social-icon">
                          <a class="fancybox" data-fancybox-group="gallery" href="assets/images/portfolio-img-big2.jpg"><i class="fa fa-eye"></i></a>
                          <a class="link-btn" href="#"><i class="fa fa-link"></i></a>
                        </div>
                        <div class="portfolio-title">
                          <h4>Mobile application</h4>
                          <span>UI Design</span>
                        </div>
                     </div>
                   </div>
                 </div>
               </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Portfolio section -->

   

  <!-- Start Testimonial section -->
  <section id="testimonial" style="margin-top:20px">
    <img src="lib/images/testimonial-bg.jpg" alt="img">
    <div class="counter-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Start Testimonial area -->
            <div class="testimonial-area">
              <div class="title-area">
                <h2 class="tittle">Que dicen los pacientes</h2>
                <span class="tittle-line"></span>              
              </div>
              <div class="testimonial-conten">
                <!-- Start testimonial slider -->
                <div class="testimonial-slider">
                  <!-- single slide -->
                  <div class="single-slide">
                    <p>Excelente doctor se los recomiendo a todos, la mejor experiencia que me ha pasado</p>
                    <div class="single-testimonial">
						<i class="fa fa-twitter"></i>
                       <!-- <img class="testimonial-thumb" src="lib/images/testimonial-image1.png" alt="img"> -->
                      <p>Maria Alejandra Gonzalez</p>
                      <span>Paciente</span>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </section>
  <!-- End Testimonial section -->

  <!-- Start from blog section -->
  <section id="from-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="from-blog-area">
            <div class="title-area">
              <h2 class="tittle">Publicaciones</h2>
              <span class="tittle-line"></span>
              <p>Aquí te dejo varios articulos para tu interes, temas de interes que todo paciente, asi como, colegas deben tener en su saberes.</p>
            </div>
            <!-- From Blog content -->
            <div class="from-blog-content">
              <div class="row">
                <div class="col-md-4">
                  <article class="single-from-blog">
                    <figure>
                      <a href="blog-single.html"><img src="lib/images/the-sky.jpg" alt="img"></a>
                    </figure>
                    <div class="blog-title">
                      <h2><a href="blog-single.html">Here is the post title</a></h2>
                      <p>Posted by <a class="blog-admin" href="#">admin</a> on <span class="blog-date">23rd july 2015</span></p>
                    </div>
                    <p>Sed ut perspiciatis unde mnis is te natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis </p>
                    <div class="blog-footer">
                      <a href="#"><span class="fa fa-comment"></span>18 Comments</a>
                      <a href="#"><span class="fa fa-thumbs-o-up"></span>35 Likes</a>
                    </div>
                  </article>
                </div>
                <div class="col-md-4">
                  <article class="single-from-blog">
                    <figure>
                      <a href="blog-single.html"><img src="lib/images/photographer.jpg" alt="img"></a>
                    </figure>
                    <div class="blog-title">
                      <h2><a href="blog-single.html">Here is the post title</a></h2>
                      <p>Posted by <a class="blog-admin" href="#">admin</a> on <span class="blog-date">23rd july 2015</span></p>
                    </div>
                    <p>Sed ut perspiciatis unde mnis is te natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis </p>
                    <div class="blog-footer">
                      <a href="#"><span class="fa fa-comment"></span>18 Comments</a>
                      <a href="#"><span class="fa fa-thumbs-o-up"></span>35 Likes</a>
                    </div>
                  </article>
                </div>
                <div class="col-md-4">
                  <article class="single-from-blog">
                    <figure>
                      <a href="blog-single.html"><img src="lib/images/sealand.jpg" alt="img"></a>
                    </figure>
                    <div class="blog-title">
                      <h2><a href="blog-single.html">Here is the post title</a></h2>
                      <p>Posted by <a class="blog-admin" href="#">admin</a> on <span class="blog-date">23rd july 2015</span></p>
                    </div>
                    <p>Sed ut perspiciatis unde mnis is te natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis </p>
                    <div class="blog-footer">
                      <a href="#"><span class="fa fa-comment"></span>18 Comments</a>
                      <a href="#"><span class="fa fa-thumbs-o-up"></span>35 Likes</a>
                    </div>
                  </article>
                </div>
              </div>    
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End from blog section -->

  
  
  <!-- Start Contact section -->
  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="contact-left wow fadeInLeft">
            <h2>Contact with us</h2>
            <address class="single-address">
              <h4>Postal address:</h4>
              <p>PO Box 16122 Collins Street West Victoria 8007 Australia</p>
            </address>
             <address class="single-address">
              <h4>Headquarters:</h4>
              <p>121 King Street, Melbourne Victoria 3000 Australia</p>
            </address>
             <address class="single-address">
              <h4>Phone</h4>
              <p>Phone Number: (123) 456 7890</p>
              <p>Fax Number: (123) 456 7890</p>
            </address>
             <address class="single-address">
              <h4>E-Mail</h4>
              <p>Support: Support@example.com</p>
              <p>Sales: sales@example.com</p>
            </address>
          </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
          <div class="contact-right wow fadeInRight">
            <h2>Send a message</h2>
            <form action="" class="contact-form">
              <div class="form-group">                
                <input type="text" class="form-control" placeholder="Name">
              </div>
              <div class="form-group">                
                <input type="email" class="form-control" placeholder="Enter Email">
              </div>              
              <div class="form-group">
                <textarea class="form-control"></textarea>
              </div>
              <button type="submit" data-text="SUBMIT" class="button button-default"><span>SUBMIT</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact section -->
  

  <!-- Start Footer -->    
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-top-area" >             
                <a class="footer-logo" href="#"><img src="lib/images/logo.jpg" alt="Logo"></a>              
              <div class="footer-social">
                <a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
                <a class="twitter" href="#"><span class="fa fa-twitter"></span></a>
                <a class="google-plus" href="#"><span class="fa fa-google-plus"></span></a>
                <a class="youtube" href="#"><span class="fa fa-youtube"></span></a>
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
	
	
	<!-- sección de citas -->
  <div class="modal fade" tabindex="-1" id="myModal_citas" role="dialog" style="color:#999">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title" style="color:#ccc"> <i class="fa fa-calendar"></i> Sistema de Citas</h2>
		  </div>
		  <div class="modal-body" >
		   <div  style="width:80%; margin-left:40px">
				<p>EL sistema de citas le permitirá establecer contacto directo con el doctor, tener una día y hora de atención por servicio y contactar con un sistema de notificación continua sobre su solictud de cita. </p>
				<p></p>
				<div class="input-group">
					<span class="input-group-addon" ><i class="fa fa-user"></i></span>
					<input type="text" class="form-control" placeholder="Correo Electronico" >
				</div>	
				<div >
					<p style="margin-top:25px">Seleccione un Consultorio</p>
					<select class="form-control" >
						<option value="0">---Seleccione---</option>
						<option value="1">---Seleccione---</option>
					</select>
				</div>
				<div >
				<p style="margin-top:25px">Fecha</p>
				<input id="fecha_consulta" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
				</div>
				
				<p></p>
			</div>
		  </div>
		  <div class="modal-footer"  style="text-align:center">
				  
			<div class="row" id="inicio_sesion" > </div>
			<button type="button" class="btn btn-success btn-lg" id="iniciar">Solicitar</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
  <!-- End Footer -->

 <!-- initialize jQuery Library --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
		
		<!-- bootstrap-daterangepicker -->
   
      $(document).ready(function() {
        $('#fecha_consulta').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    
    <!-- /bootstrap-daterangepicker -->
	</script>
  </body>
</html>
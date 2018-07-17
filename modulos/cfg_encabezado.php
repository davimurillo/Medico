<link rel="stylesheet" href="../lib/css/animate.css" >
<?php require_once('common.php'); checkUser(); //chequeo de usuario entrante 
//selecciona los modulos segun el tipo de usuario y asignaciones
	$sql="SELECT (tx_nombre_apellido) as nombre, tx_foto_usuario FROM cfg_usuario a WHERE id_usuario=".$_SESSION['id_usuario']." and id_estatu=1";
	$res=abredatabase(g_BaseDatos,$sql);
	$row=dregistro($res);
	$nombre_usuario=$row['nombre'];
	$foto=$row['tx_foto_usuario'];
	cierradatabase();
	
	if ($foto==""){
		$foto="../img/fotos/img.jpg";	
	}else{
		$foto="repositorio/fotos_usuario/".$foto;
	}
	
	$sql="SELECT  tx_motivo,tx_nombres_apellidos, tx_foto, tx_nombre_consultorio, tx_tipo, to_char(fe_cita,'DD/MM/YYYY') as fe_cita FROM vie_tbl_cita WHERE fe_cita :: date=NOW() ::date ORDER BY fe_cita";
	$res=abredatabase(g_BaseDatos,$sql);
	if (dnumerofilas($res)==0){
		$n_notificacion=0;
	}
	else{
		$n_notificacion=dnumerofilas($res);
	}
	cierradatabase();
?>
<style>
		body { padding-top: 50px; height:100% }
		#contenedor {
			height:100vh;
		}
		#contenedor_data {
			height:80vh;
		}
		.user-profile{
			height:49px
		}
		.user-profile img {
			width: 20px;
			height: 20px;
			border-radius: 50%;
			margin-right: 10px;
		}
	</style>
<div class="container-fluid">

	<!-- 
					
		##################################################################################   
		## +---------------------------------------------------------------------------+##
		## | 1. Menu Principal							                               |## 
		## +---------------------------------------------------------------------------+##
		##################################################################################
					
			-->
			
		
		
		<nav class="navbar navbar-default navbar-fixed-top" style="height:49px">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" style="margin-top:-15px">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  
				</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
			
		  
			  <ul class="nav navbar-nav navbar-left">
				
				<li >
				
					  <img src="../img/logos/logo.jpg" width="48px" height="48px" data-toggle="dropdown" aria-expanded="false" onclick="location.href='index.php';">
				
					
				
				</li>
			</ul>
			 
			 
			 <ul class="nav navbar-nav navbar-right">
				 
				<li  ><a href="index.php"><span class="fa fa-home"></span></a></li>
				
			<li class="">
					<a href="javascript:;" class="" title="Módulos" data-toggle="dropdown" aria-expanded="false">
					   <span class=" fa fa-user"></span>
					</a>
					
					<ul class="dropdown-menu dropdown-usermenu animated fadeIn">
						<li><a href="mod_paciente.php"><span class="fa fa-list"></span> Pacientes</a> </li>
						<!--
						<li><a href="#"><span class="fa fa-book"></span> Citas</a> </li>
						<li><a href="#"><span class="fa fa-cube"></span> Facturación</a> </li>
						<li><a href="#"><span class="fa fa-calendar"></span> Presupuesto</a> </li>
						<li><a href="#"><span class="fa fa-print"></span> Reportes</a> </li>
						-->
					</ul>
				
				</li>
				
				<li class="">
					<a href="javascript:;" class="" title="Módulos" data-toggle="dropdown" aria-expanded="false">
					   <span class=" fa fa-hospital-o"></span>
					</a>
					
					<ul class="dropdown-menu dropdown-usermenu animated fadeIn">
						<li><a href="cfg_consultorio.php"><span class="fa fa-list"></span> Consultorio</a> </li>
						<li><a href="#"><span class="fa fa-list"></span> Gastos</a> </li>
						<li><a href="#"><span class="fa fa-list"></span> Personas</a> </li>
						
					</ul>
				
				</li>
				
					<li class="">
					<a href="javascript:;" class="" title="Módulos" data-toggle="dropdown" aria-expanded="false">
					   <span class=" fa fa-user-md"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="mod_doctor_perfil.php"><span class="fa fa-user-md"></span> Mi Perfil</a> </li>
						<li><a href="mod_doctor_publicaciones.php"><span class="fa fa-file-picture-o"></span> Publicaciones</a> </li>
						<li><a href="mod_doctor_galeria.php"><span class="fa fa-file-picture-o"></span> Galeria de Fotos</a> </li>
						<!--
						<li role="separator" class="divider"></li>
						<li><a href="#"><span class="fa fa-phone"></span> Citas</a> </li>
						-->
					</ul>
					
					</li>
				<li  ><a href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-bell"></i><span class="badge" style="font-size:8px; margin-top:-15px; margin-left:-8px; background:#ccc"><?php echo $n_notificacion; ?> </span></a></li>
				
			  <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="<?php echo $nombre_usuario; ?>">
                  <img src="<?php echo $foto; ?>" >
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeIn">
                  <li>
				  <li ><a href="configurar.php"><span class="fa fa-cog"></span> Configuración</a></li>
                  <li>
                    <a href="javascript:;"><span class="fa fa-book"></span> Ayuda</a>
                  </li>
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
                  </li>
				  
                </ul>
				
              </li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
	</nav>
	
	 <script src="../lib/js/jquery.min.js"></script>
	<script src="../lib/js/bootstrap.min.js"></script>
		<!-- 
					
		##################################################################################   
		## +---------------------------------------------------------------------------+##
		## | 2. Ventana de Notificacione
		## +---------------------------------------------------------------------------+##
		##################################################################################
					
			-->
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document" style="width:98%">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Notificaciones</h4>
		  </div>
		  <div id="notificaciones" class="modal-body" style="height:60vh">
				
				
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>
	<script>
		$('#notificaciones').load('mod_notificaciones.php');
	</script>
	
	
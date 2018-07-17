<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gentallela Alela! | </title>

  <!-- Bootstrap core CSS -->

  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="../css/custom.css" rel="stylesheet">
  <link href="../css/icheck/flat/green.css" rel="stylesheet">

  <link href="../css/estilos.css" rel="stylesheet">
  <script src="../js/jquery.min.js"></script>
  
  <?php 	require_once('common.php');	checkUser(); 
  
  // configuración de los tickets
  $numero_ticket="000000";
  $array_color_estatus=array("1269"=>"bg-blue","1270"=>"bg-green", "1271"=>"bg-orange", "1272"=>"bg-purple", "1273"=>"bg-red"  );
  $array_color_prioridad=array("1275"=>"bg-blue","1276"=>"bg-green", "1222"=>"bg-orange", "1274"=>"bg-purple", "1221"=>"bg-red"  );
  
  ?>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

		
        <div class="">
		 
          <div class="page-title">
            <div class="title_left">
               <div class="col-md-12 col-sm-12"  style=" width:100%; font-size:18px; color:#888; padding-top:5px" >
				<h3>TICKETS <small>Mesa de Ayuda </small><img class="ayuda" src="../img/botones/ayuda.png" title="Ayuda del Modulo de Tickets" style="margin-left:8px; margin-top:-2px" /></h3> 
			</div>
			
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input id="buscar" type="text" class="form-control" placeholder="Buscar aquí...">
                  <span class="input-group-btn">
                            <a href="javascript:location.href='Ticket_inbox.php?buscar='+$('#buscar').val();"><button class="btn btn-default" type="button">Ir!</button></a>
                        </span>
                </div>
              </div>
            </div>
		
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
				<div class="row">
					<div class="col-md-10 col-sm-10 col-xs-10">
					<?php if ($_SESSION['rol']==4){?>
					<div class="left">
					   <div class="btn-group">
							  <div class="col-md-12 boton_activo dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" width:140px; ">
								Todos Tickets <span class="fa fa-chevron-down" style="color:#fff "></span>
							  </div>
							  <ul class="dropdown-menu">
								<li>
									<a href="Ticket_inbox.php"><div style="float:left">Todos</div><div style="float:right" class="badge" style="color:#fff"></div><div style="clear:both"></div></a> </li>
								</li>
								<?php 
										$sql="(SELECT id_maestro,nombre, (SELECT  count(a.id_ticket) as n FROM tickets a WHERE  clasificacion_ticket=1 and (select estatus FROM tickets where id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=b.id_maestro) FROM maestro b WHERE id_nivel_maestro=1268) UNION ( SELECT '0','Sin Asignar', count(a.id_ticket) as n FROM tickets a WHERE  clasificacion_ticket=1 and (select estatus FROM tickets where id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) IS NULL) order by id_maestro";
										$res=abredatabase(g_BaseDatos,$sql);
										while ($row=dregistro($res))
										{
							    ?>
								<li>
										
										<a href="Ticket_inbox.php?estatus=<?php echo $row['id_maestro']; ?>">
										  <div style="float:left"><?php echo $row['nombre']; ?></div>
										  <div style="float:right" class="badge <?php  if ($row['id_maestro']==0) {  }else{ echo $array_color_estatus[$row['id_maestro']];} ; ?>" style="color:#fff"><?php echo $row['n']; ?></div>
										  <div style="clear:both"></div>
										</a>
								</li>
										<?php } ?>
									
							  </ul>
							</div>
					</div>
					<?php } ?>
					<div class="left">
						<div class="btn-group">
							  <div class="col-md-12 boton_activo dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style=" width:140px; ">
								Mis Tickets <span class="fa fa-chevron-down" style="color:#fff "></span>
							  </div>
							  <ul class="dropdown-menu">
							  <li>
									<a href="Ticket_inbox.php?usuario=<?php echo $_SESSION['id_usuario']; ?>"><div style="float:left">Todos</div><div style="float:right" class="badge" style="color:#fff"></div><div style="clear:both"></div></a> </li>
								</li>
								<?php 
										$sql="(SELECT id_maestro,nombre, (SELECT  count(a.id_ticket) as n FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." AND clasificacion_ticket=1 and (select estatus FROM tickets where id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=b.id_maestro) FROM maestro b WHERE id_nivel_maestro=1268) UNION ( SELECT '0','Sin Asignar', count(a.id_ticket) as n FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." AND clasificacion_ticket=1 and (select estatus FROM tickets where id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) IS NULL) order by id_maestro";
										$res=abredatabase(g_BaseDatos,$sql);
										while ($row=dregistro($res))
										{
							    ?>
								<li>
										
										<a href="Ticket_inbox.php?usuario=<?php echo $_SESSION['id_usuario']; ?>&estatus=<?php echo $row['id_maestro']; ?>">
										  <div style="float:left"><?php echo $row['nombre']; ?></div>
										  <div style="float:right" class="badge <?php  if ($row['id_maestro']==0) {  }else{ echo $array_color_estatus[$row['id_maestro']];} ; ?>" style="color:#fff"><?php echo $row['n']; ?></div>
										  <div style="clear:both"></div>
										</a>
								</li>
										<?php } ?>
									
							  </ul>
							</div>
					 
					</div>
					<div class="left">
					<a href="javascript:abrir_tabla_tickets();" >
						<div class="col-md-12 boton_activo btn-success  " style=" width:140px">
							 Tablero de Tickets 
						</div>
					</a>
					</div>
					
					</div>
					
					
					<div class="col-md-2 col-xs-2">
					  <a href="Javascript:abrir_nuevo_ticket();" >
						<div class="col-md-12 col-xs-12 boton_sucesos" >
							 + Nuevo Ticket
						</div>
					</a>
					</div>
				</div>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">


                  <div id="contenido_ticket" class="row">
				   <div id="lista_tickets" class="col-md-4 col-sm-4 col-lg-4" >
					 <div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-ticket"></i> <?php if (isset($_REQUEST['usuario'])){ echo "Mis Tickets"; }else { echo "Todos los Tickets"; } ?> <small>Sintomas </small></h2>
                         <div class="clearfix"></div>
					</div>
					<div id="lista_tickets_x"class="x_content" style="overflow-y: scroll; width: 100%; ">
						<?php $select="SELECT id_ticket,  ultima_actualizacion, to_char(ultima_actualizacion,'HH:MI:SS AM') as hora, titulo,(SELECT nombre FROM maestro WHERE id_maestro=a.tipo_ticket) as tipo_ticket,(SELECT nombre FROM maestro c WHERE c.id_maestro=a.estatus) as estatus_ticket_padre, (SELECT nombre FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) as estatus, (SELECT b.estatus FROM tickets b WHERE  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)  as id_estatus, (SELECT count(id_ticket) FROM tickets WHERE id_ticket_padre=a.id_ticket) as respuestas, (SELECT nombre FROM maestro WHERE id_maestro=a.prioridad) as txt_prioridad, prioridad, (SELECT (nombres || ' ' || apellidos) as nombre_usuario FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as nombre_usuario, responsive   FROM tickets a WHERE  clasificacion_ticket=1  " ;
						 if (isset($_REQUEST['usuario'])){
							   $select.=" and id_usuario_emisor=".$_SESSION['id_usuario'];
						 }
						 
						  if (isset($_REQUEST['estatus'])){
							   $select.=" and  (SELECT b.estatus FROM tickets b WHERE  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=".$_REQUEST['estatus'];
						 }
					   if ($_SESSION['rol']<4){
						  $select.=" and (id_usuario_emisor=".$_SESSION['id_usuario']." or id_usuario_receptor=".$_SESSION['id_usuario'].")  ";
					   }
					  if (isset($_REQUEST['buscar'])){
						  $select.=" and (CAST(id_ticket AS TEXT) LIKE '".$_REQUEST['buscar']."%' or titulo LIKE '%".$_REQUEST['buscar']."%' or (SELECT (nombres || ' ' || apellidos) as nombre_usuario FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) LIKE '%".$_REQUEST['buscar']."%' or descripcion LIKE '%".$_REQUEST['buscar']."%' ) ";
					  }
					  $c=1;
					   $select.="ORDER BY id_ticket DESC";
										  $sql = $select;
										$res=abredatabase(g_BaseDatos,$sql);
										while ($row=dregistro($res))
										{
											if ($c==1){
											$ticket_seleccionado=$row['id_ticket'];
											$c=2;
											}
					?>
                      <div class="mail_list" onclick="javascript:abrir('<?php echo $row['id_ticket']; ?>');">
                       
                        <div class="col-md-12">
						<div class="right" style="width:25%; text-align:center; background:#999; color:#fff;   font-size:9px; height:20px ">				
                          # <?php echo substr($numero_ticket,1,strlen($numero_ticket)-strlen($row['id_ticket'])).$row['id_ticket']; ?>    
						  </div>
						  
						  <div class="right <?php  if ($row['responsive']==0) {  } else{ if (is_null($row['estatus'])){ echo  $array_color_estatus['1269']; }else{ echo $array_color_estatus[$row['id_estatus']];}} ; ?>" style=" width:30%; text-align:center;  font-size:9px; height:20px; margin-left:2px; " > <?php  if ($row['responsive']==0) { echo 'Sin Asignar'; } else{ if (is_null($row['estatus'])){ echo $row['estatus_ticket_padre'];}else{echo $row['estatus'];}} ; ?> 
						  </div>
						  
						  <div class="right <?php echo $array_color_prioridad[$row['prioridad']]; ?>" style="width:20%; text-align:center;  color:#fff; margin-left:2px;   font-size:9px; height:20px ">				
                          <?php echo $row['txt_prioridad']; ?>    
						  </div>
						  
						  <div class="right time" style="width:20%;text-align:center; font-size:9px; height:20px; margin-top:5px ">				
                         <?php 
						date_default_timezone_set('America/Caracas');
												$datetime1 = new DateTime("now");
												$datetime2 = new DateTime($row['ultima_actualizacion']);
												$interval = date_diff($datetime2, $datetime1);
												$dia=$interval->format('%D');
												$hora=$interval->format('%H');
												$min=$interval->format('%I');
												if ($dia!=0){ echo $dia.' Día'; } elseif ($hora!=0){ echo $hora.' Hora'; } elseif ($min!=0){ echo $min.' Min'; }
						
					  ?>
						  </div>
						   
						  <div class="right" style="margin-top:5px">
						  <h3>
							<span style="font-size:12px; font-weight:bold">
								<?php echo $row['nombre_usuario']; ?>
							<span> 
						  </h3> 
                          <p style="font-size:10px"> <?php echo $row['titulo']; ?></p>
						  </div>
                        </div>
                      </div>
										<?php } cierradatabase();?>

						
					</div>
				</div>
				</div>
				 <div id="Vista_tickets" class="col-md-8 col-sm-8 col-lg-8" >
					 <div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-edit"></i> Ticket <span id="edit_ticket"></span> <small> </small></h2>
                         <div class="clearfix"></div>
					</div>
					<div id="Vista_tickets_x" class="x_content" style="overflow-y: scroll; width: 100%; height: 310px;">
						<div id="vista_registro" style="height:300px"></div>
					</div>
				 </div>
				 </div>
					
					
                   
                    <!-- /CONTENT MAIL -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       

    


  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="../js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="../js/icheck/icheck.min.js"></script>
  <!-- pace -->
  <script src="../js/pace/pace.min.js"></script>
  <script src="../js/custom.js"></script>
  
  <!-- genera correo de ticket --->
  
  <div id="carga_correo"></div>
  
  <!-- generar ticket --->
  
  <div class="modal fade" tabindex="-1" id="myModal" role="dialog" style="color:#999">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title">Generar Ticket</h2>
		  </div>
		  <div class="modal-body" >
		   <div style="width:90%; margin-left:40px">
				
				<p style="margin-top:5px">Prioridad</p>
				<select id="tipo_prioridad" class="form-control">
					<option value="0">--- Seleccione ---</option>
					<?php $select="SELECT id_maestro, nombre FROM maestro WHERE id_nivel_maestro=1220 ORDER BY nombre";
							$sql = $select;
							$res=abredatabase(g_BaseDatos,$sql);
							while ($row=dregistro($res))
							{
							?>
                  <option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
                  <?php 
							}
							cierradatabase($res);
							
							
							?>
				</select>
				<p style="margin-top:15px">Tipo de Ticket</p>
				<select id="tipo_ticket" class="form-control">
					<option value="0">--- Seleccione ---</option>
					<?php $select="SELECT id_maestro, nombre FROM maestro WHERE id_nivel_maestro=1265 ORDER BY nombre";
							$sql = $select;
							$res=abredatabase(g_BaseDatos,$sql);
							while ($row=dregistro($res))
							{
							?>
                  <option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
                  <?php 
							}
							cierradatabase($res);
							
							
							?>
				</select>
				
				<p style="margin-top:15px">Titulo</p>
				
				<input type="text" id="titulo" class="form-control">
				
				<p style="margin-top:15px">Sintoma</p>
				
           
                <textarea name="descr" id="descripcion" class="form-control"  ></textarea>
                
				
				<p style="margin-top:5px"></p>
             
            </div>
          </div>
				
			
		 
		  <div class="modal-footer"  style="text-align:center">
				  
			<div class="row" id="sesion_registro" > </div>
			<button type="button" class="btn btn-success btn-lg" id="registrar">Enviar</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
	<!--- respuestas --->
	
	
	 <div class="modal fade" tabindex="-1" id="myModal_respuesta" role="dialog" style="color:#999">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h2 class="modal-title">Respuesta a Ticket</h2>
		  </div>
		  <div class="modal-body" >
		   <div style="width:90%; margin-left:40px">
				<input type="hidden" id="id_padre">
				<input type="hidden" id="tipo_prioridad_respuesta">
				<input type="hidden" id="tipo_ticket_respuesta">
				
				
				<?php if($_SESSION['rol']>=3){ ?>
				<p style="margin-top:15px">Estatus</p>
				<select id="estatus_respuesta" class="form-control">
					<option value="0">--- Seleccione ---</option>
					<?php $select="SELECT id_maestro, nombre FROM maestro WHERE id_nivel_maestro=1268 ORDER BY nombre";
							$sql = $select;
							$res=abredatabase(g_BaseDatos,$sql);
							while ($row=dregistro($res))
							{
							?>
                  <option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
                  <?php 
							}
							cierradatabase($res);
							
							
							?>
				</select>
				<?php } else { ?>
					<input type="hidden" id="estatus_respuesta">
				
				<?php } ?>
				<p style="margin-top:15px">Respuesta</p>
				
           
                <textarea name="descr" id="descripcion_respuesta" class="form-control"   style="height:200px"></textarea>
                
				
				<p style="margin-top:5px"></p>
             
            </div>
          </div>
				
			
		 
		  <div class="modal-footer"  style="text-align:center">
				  
			<div class="row" id="sesion_registro_respuesta" > </div>
			<button type="button" class="btn btn-success btn-lg" id="registrar_respuesta">Enviar</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<script>
	function enviar_correo_ticket($sento,$ticket,$fecha,$prioridad,$titulo,$nombre,$mensaje){
		
		$('#carga_correo').load('correo.php', {'tipo_correo':'2','sento':$sento, 'numero_ticket':$ticket, 'fecha':$fecha, 'prioridad':$prioridad,'titulo':$titulo, 'autor':$nombre,'mensaje_ticket':$mensaje});
	}
	function abrir(id){
		
		$('#edit_ticket').html('# 00000'+id);
		$('#vista_registro').load('registro_ticket.php',{'id_padre':id, 'id':'3'});
		
	}
	
	function abrir_tabla_tickets(){
		$('#vista_registro').load('T_menu_principal.php');
		
	}
	$( "#registrar" ).click(function() {
				$error="";
				if ($("#tipo_prioridad").val()==0){ $error+="Debe Seleccionar el campo de Prioridad del Ticket para continuar<br>"; }
				if ($('#tipo_ticket').val()==0){ $error+="Debe Seleccionar el campo de tipo de ticket  para continuar<br>"; }
				if ($('#descripcion').val()==""){ $error+="Debe Seleccionar colocar una descripcion del Ticket para continuar"; }
				
				
				if ($error==""){
					
					$( "#sesion_registro" ).load( "registro_ticket.php", { id:"1", tipo_prioridad: $('#tipo_prioridad').val(),tipo_ticket: $('#tipo_ticket').val(),titulo:$('#titulo').val(), descripcion:$('#descripcion').val()  } );
				}else{
					$("#sesion_registro").html('<span style="color=#red">'+$error+'</span><p>');
				}
			
		});
		
			$( "#registrar_respuesta" ).click(function() {
				$error="";
				if ($("#tipo_prioridad_respuesta").val()==0){ $error+="Debe Seleccionar el campo de Prioridad del Ticket para continuar<br>"; }
				if ($('#tipo_ticket_respuesta').val()==0){ $error+="Debe Seleccionar el campo de tipo de ticket  para continuar<br>"; }
				if ($('#descripcion_respuesta').val()==""){ $error+="Debe Seleccionar colocar una descripcion del Ticket para continuar"; }
				
				
				if ($error==""){
					
					$( "#sesion_registro_respuesta" ).load(  "registro_ticket.php", {id_padre:$('#id_padre').val(),estatus:$('#estatus_respuesta').val(), id:"2", tipo_prioridad: $('#tipo_prioridad_respuesta').val(),tipo_ticket: $('#tipo_ticket_respuesta').val(),descripcion:$('#descripcion_respuesta').val()  } );
				}else{
					$("#sesion_registro_respuesta").html('<span style="color=#red">'+$error+'</span><p>');
				}
			
		});
		
		function abrir_nuevo_ticket(){
			
		$('#myModal').modal('show', function (){
			
			
		});
		$("#tipo_prioridad").val('');
		$("#tipo_ticket").val('');
		$("#estatus").val('');
		$("#titulo").val('');
		$("#descripcion").val('');
		$("#sesion_registro_respuesta").html('');
		
		}
		
		
		
		
		function abrir_respuesta(id,prioridad,tipo_ticket,estatus){
			
		$('#myModal_respuesta').modal('show', function (){
			
			
		});
		$("#id_padre").val(id);
		$("#tipo_prioridad_respuesta").val(prioridad);
		$("#tipo_ticket_respuesta").val(tipo_ticket);
		$("#estatus_respuesta").val(estatus);
		$("#descripcion_respuesta").val('');
		$("#sesion_registro_respuesta").html('');
		}
		
		
  </script>
  <?php if (isset($_REQUEST['id'])) {
		
		echo "<script>abrir(".$_REQUEST['id'].");</script>";
  }
  ?>
	<script>
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
  document.getElementById('lista_tickets').style.height=(myHeight-180) + "px";
   document.getElementById('Vista_tickets').style.height=(myHeight-180) + "px";
   document.getElementById('lista_tickets_x').style.height=(myHeight-280) + "px";
   document.getElementById('Vista_tickets_x').style.height=(myHeight-280) + "px";
  //document.getElementById('frames').style.height=(myHeight-150) + "px";
  
  
}

alertSize();

function Resize()
{
alertSize();
}

window.onresize=Resize;
</script>
</body>

</html>

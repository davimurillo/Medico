<?php 	require_once('common.php');	checkUser(); ?>
<?php 
$dir="";
if(isset($lib)){ $dir.="../"; $lib="../"; }
require_once($dir."../lib/config.php"); 

if ($_REQUEST['id']==1){
			
			 $sql_3="INSERT INTO tickets (id_usuario_emisor,id_usuario_receptor,clasificacion_ticket,tipo_ticket,descripcion,estatus,id_ticket_padre,prioridad,titulo,responsive,id_usuario_creador) values(".$_SESSION['id_usuario'].",'1','1',".$_REQUEST['tipo_ticket'].",'".$_REQUEST['descripcion']."','1269','0','".$_REQUEST['tipo_prioridad']."','".$_REQUEST['titulo']."','0',".$_SESSION['id_usuario'].")";
			$res_3=abredatabase(g_BaseDatos,$sql_3);
			 $sql_3="SELECT (SELECT email FROM cfg_usuario WHERE id_usuario=a.id_usuario_receptor) as email, (SELECT (nombres || ' ' || apellidos) FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as nombre_emisor, id_ticket, to_char(ultima_actualizacion,'DD/MM/yyyy HH:MI:SS AM') as ultima_actualizacion, titulo, (SELECT nombre FROM maestro WHERE id_maestro=a.prioridad) as prioridad  FROM tickets a ORDER BY  id_ticket DESC LIMIT 1";
			$res_3=abredatabase(g_BaseDatos,$sql_3);
			$row=dregistro($res_3);
			echo "Registro de Exitoso";
			echo "<script>enviar_correo_ticket('".$row['email']."','".$row['id_ticket']."','".$row['ultima_actualizacion']."','".$row['prioridad']."','".$row['titulo']."','".$row['nombre_emisor']."','Nuevo Ticket');</script>";
			sleep(1);
			
			echo "<script>$('#myModal').modal('hide');</script>";
			

cierradatabase();
}


if ($_REQUEST['id']==2){

			 $sql_3="INSERT INTO tickets (id_usuario_emisor,id_usuario_receptor,clasificacion_ticket,tipo_ticket,descripcion,estatus,id_ticket_padre,prioridad,responsive) values(".$_SESSION['id_usuario'].",'1','2',".$_REQUEST['tipo_ticket'].",'".$_REQUEST['descripcion']."',".$_REQUEST['estatus'].",".$_REQUEST['id_padre'].",'".$_REQUEST['tipo_prioridad']."','0')";
			$res_3=abredatabase(g_BaseDatos,$sql_3);
			$sql_1="UPDATE tickets SET responsive=1 WHERE id_ticket=".$_REQUEST['id_padre'];
			$res_1=abredatabase(g_BaseDatos,$sql_1);
			$sql_3="SELECT (SELECT email FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as email, (SELECT (nombres || ' ' || apellidos) FROM cfg_usuario WHERE id_usuario=a.id_usuario_receptor) as nombre_emisor, (SELECT id_ticket FROM tickets WHERE id_ticket=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) as id_ticket, (SELECT to_char(ultima_actualizacion,'DD/MM/yyyy HH:MI:SS AM') FROM tickets WHERE  id_ticket=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) as ultima_actualizacion, titulo, (SELECT nombre FROM maestro WHERE id_maestro=a.prioridad) as prioridad, id_ticket_padre  FROM tickets a WHERE id_ticket=".$_REQUEST['id_padre']." ORDER BY  id_ticket DESC LIMIT 1";
			$res_3=abredatabase(g_BaseDatos,$sql_3);
			$row=dregistro($res_3);
			echo "Registro de Exitoso";
			echo "<script>enviar_correo_ticket('".$row['email']."','".$row['id_ticket_padre']."','".$row['ultima_actualizacion']."','".$row['prioridad']."','".$row['titulo']."','".$row['nombre_emisor']."','Respuesta de Ticket');</script>";
			echo "<script>abrir(".$_REQUEST['id_padre'].");</script>";
			sleep(1);
			
			echo "<script>$('#myModal_respuesta').modal('hide');</script>";
	

cierradatabase();
}

if ($_REQUEST['id']==3){

			// configuración de los tickets
			  $numero_ticket="000000";
			  $array_color_estatus=array("1269"=>"bg-blue","1270"=>"bg-green", "1271"=>"bg-orange", "1272"=>"bg-purpler", "1273"=>"bg-red"  );
			 $color_prioridad=array("1275"=>"bg-blue","1276"=>"bg-green", "1222"=>"bg-orange", "1274"=>"bg-purple", "1221"=>"bg-red"  );
  
			
			$sql_3="UPDATE tickets SET responsive=1 WHERE id_ticket=".$_REQUEST['id_padre'];
			$res_3=abredatabase(g_BaseDatos,$sql_3);
			
			$sql="SELECT id_ticket, to_char(ultima_actualizacion,'DD/MM/yyyy') as ultima_actualizacion, to_char(ultima_actualizacion,'HH:MI:SS AM') as hora, titulo,descripcion, (SELECT nombre FROM maestro WHERE id_maestro=a.tipo_ticket) as tipo_ticket,(SELECT nombre FROM maestro c WHERE c.id_maestro=a.estatus) as estatus_ticket_padre,(SELECT nombre FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) as estatus, (SELECT b.estatus FROM tickets b WHERE  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)  as id_estatus, (SELECT b.ultima_actualizacion FROM tickets b WHERE  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)  as ultima_fecha, (a.ultima_actualizacion) as fecha_creacion, (SELECT count(id_ticket) FROM tickets WHERE id_ticket_padre=a.id_ticket) as respuestas, (SELECT nombre FROM maestro WHERE id_maestro=a.prioridad) as prioridad, (a.prioridad) as id_prioridad, (SELECT (nombres || ' ' || apellidos) as nombre_usuario FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as nombre_usuario, (SELECT foto_usuario FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as foto, responsive, (tipo_ticket) as id_tipo_ticket   FROM tickets a WHERE id_ticket=".$_REQUEST['id_padre'];
			$res=abredatabase(g_BaseDatos,$sql);
			$row=dregistro($res);
			$foto_u=$row['foto'];
				 if ($foto_u==""){
						$foto_u="../img/fotos/img.jpg";	
					}else{
						$foto_u="repositorio/fotos_usuario/".$foto_u;
					}
					
					$color_estatus="";
					if (is_null($row['id_estatus'])){
						$id_estatus_respuesta=1269;
					}else{
						$id_estatus_respuesta=$row['id_estatus'];
					}
					$estatus="";
					if ($row['responsive']==0) {  } else{ if (is_null($row['estatus'])){  $color_estatus=$array_color_estatus['1269']; }else{ $color_estatus= $array_color_estatus[$row['id_estatus']];}} 
					if ($row['responsive']==0) { $estatus= 'Pendiente'; } else{ if (is_null($row['estatus'])){ $estatus= $row['estatus_ticket_padre'];}else{$estatus= $row['estatus'];}}
					 
						date_default_timezone_set('America/Caracas');
												$datetime1 = new DateTime($row['ultima_fecha']);
												$datetime2 = new DateTime($row['fecha_creacion']);
												$interval = date_diff($datetime2, $datetime1);
												$dia=$interval->format('%D');
												$hora=$interval->format('%H');
												$min=$interval->format('%I');
												$tiempo=' '.$dia.' Día - '.$hora.' Hora - '.$min.' Min';
												
												$datetime1 = new DateTime("now");
												$datetime2 = new DateTime($row['fecha_creacion']);
												$interval = date_diff($datetime2, $datetime1);
												$dia=$interval->format('%D');
												$hora=$interval->format('%H');
												$min=$interval->format('%I');
												$tiempo2=' '.$dia.' Día - '.$hora.' Hora - '.$min.' Min';
						
					  
					
				
			echo '
                          <div class="col-md-12">
                            <div class="compose-btn">';
							  if ($estatus!='Cerrado'){
                              echo '<button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Imprimir" class="btn  btn-sm tooltips"><i class="fa fa-print"></i> </button>
                              <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Eliminar" class="btn btn-sm tooltips"><i class="fa fa-trash-o"></i>
                              </button>
							  <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Enviar a Otro Equipo de Soporte" class="btn btn-sm tooltips"><i class="fa fa-exchange"></i>
                              </button>';
							  }
							  
                            echo  '</div>
						 </div>
							
                          <div class="col-md-12 col-xs-12 ">
						  <div class="panel panel-default">
						   <div class="panel-body">
						   <div class="col-md-12 col-xs-12">
								<div class="col-md-6 col-xs-6">
									<h2> <strong> Ticket #'.substr($numero_ticket,1,strlen($numero_ticket)-strlen($row["id_ticket"])).$row["id_ticket"].'</strong>  </h2>
								</div>
								<div class="col-md-offset-6 col-xs-offset-6" align="right" style="margin-top:10px">
									<span class="badge '.$color_prioridad[$row["id_prioridad"]].'">'.$row["prioridad"].'</span>  <span class="badge '.$color_estatus.'">'.$estatus.'</span> <span class="badge bg-green">Sintoma</span>
								</div>
							</div>
							<div class="col-md-12 col-xs-12" style="margin-top:-20px;">
								 <hr>
							</div>
							<div class="col-md-6 xol-xs-6">
								<div >
									<span class="image">
                                        <img src="'.$foto_u.'" alt="Imagen de Perfil del Usuario" width="48px" height="48px" style="margin-right:10px" />
                                    </span>
									<p><strong>'.$row["nombre_usuario"].'</strong></p>
								</div>
								
							</div>
							<div class="col-md-offset-6 col-xs-offset-6" align="right" style="font-size:11px">
								<span class="date"> Fecha Creación:'.$row['ultima_actualizacion'].' - '.$row["hora"].'</span>
								<br>
								<span class="date"> Tiempo Trasncurrido:'.$tiempo2.'</span>
								<br>
								<span class="date"> Ultima Respuesta:'.$tiempo.'</span>
							</div>
							<div class="col-md-12 col-xs-12" style="margin-top:-20px;">
								 <hr>
							</div>

							<div class="col-md-12 col-xs-12" style="margin-top:-20px;">
								 <h2><strong>'.$row['titulo'].'</strong></h2>
							</div>
							<div class="col-md-12 col-xs-12" style="margin-top:-20px;">
								 <hr>
							</div>
							<div class="col-md-12 col-xs-12">'.$row['descripcion'].'</div>
							</div>
							</div>
                          </div>
                        
						';
						 if ($estatus!='Cerrado'){
						echo ' <div class="col-md-12 col-xs-12"><a href="javascript:abrir_respuesta('.$_REQUEST['id_padre'].', '.$row['id_prioridad'].','.$row['id_tipo_ticket'].','.$id_estatus_respuesta.');"  ><div class="col-md-12 col-xs-12 btn btn-success"> Responder <i class="fa fa-question-circle"></i>
					</div></a>
					</div>
					<div class="col-md-12 col-xs-12">
						<hr>
					</div>';
						 }
						 $sql="SELECT id_ticket, to_char(ultima_actualizacion,'DD/MM/yyyy') as ultima_actualizacion, to_char(ultima_actualizacion,'HH:MI:SS AM') as hora, titulo,descripcion, (SELECT nombre FROM maestro WHERE id_maestro=a.tipo_ticket) as tipo_ticket, (a.estatus) as id_estatus,  (SELECT count(id_ticket) FROM tickets WHERE id_ticket_padre=a.id_ticket) as respuestas, (SELECT nombre FROM maestro WHERE id_maestro=a.prioridad) as prioridad, (SELECT (nombres || ' ' || apellidos) as nombre_usuario FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as nombre_usuario, (prioridad) as id_prioridad, tipo_ticket, responsive, (SELECT nombre FROM maestro c WHERE c.id_maestro=a.estatus) as estatus_ticket_padre, (SELECT foto_usuario FROM cfg_usuario WHERE id_usuario=a.id_usuario_emisor) as foto   FROM tickets a WHERE id_ticket_padre=".$_REQUEST['id_padre']." ORDER BY id_ticket DESC ";
						$res_3=abredatabase(g_BaseDatos,$sql);
						while ($row3=dregistro($res_3)){
							$foto_ur=$row3['foto'];
							if ($foto_ur==""){
								$foto_ur="../img/fotos/img.jpg";	
							}else{
								$foto_ur="repositorio/fotos_usuario/".$foto_ur;
							}
							$sql_4="UPDATE tickets SET responsive=1 WHERE id_ticket=".$row3['id_ticket'];
							$res_4=abredatabase(g_BaseDatos,$sql_4);
			
							$color_estatus="";
							$estatus="";
							 if (is_null($row3['id_estatus'])){  $color_estatus=$array_color_estatus['1269']; }else{ $color_estatus= $array_color_estatus[$row3['id_estatus']];}
							if ($row['responsive']==0) { $estatus= 'Pendiente'; } else{ if (is_null($row3['id_estatus'])){ $estatus= $row3['estatus_ticket_padre'];}else{$estatus= $row3['estatus_ticket_padre'];}}
							
							echo '
                          
							
                          <div class="col-md-12 col-xs-12 ">
							<div class="col-md-offset-2 col-xs-offset-2">
								<div class="panel panel-info">
								<div class="panel-body ">
									<div class="col-md-12 col-xs-12 ">
										
										<div class="col-md-6 col-xs-6" >
											<span class="date" style="font-size:9px"> '.$row3['hora'].' '.$row3['ultima_actualizacion'].'</span>
											<br>
											<span class="image">
												<img src="'.$foto_ur.'" alt="Imagen de Perfil del Usuario" width="24px" height="24px" style="margin-right:10px" />
											</span>
											<span>'.$row3['nombre_usuario'].'</span>
											
											
										</div>
										
										<div class="col-md-offset-6 col-xs-offset-6" style="text-align:right" >
											<span class="badge '.$color_prioridad[$row3["id_prioridad"]].'" style="font-size:9px">'.$row3["prioridad"].'</span>  
											<span class="badge '.$color_estatus.'" style="font-size:9px">'.$estatus.'</span> 
											';
											 
											if ($row3['id_estatus']==1273){
												echo '<span class="badge bg-red" style="font-size:9px">Solución</span>';
											}else{
												echo '<span class="badge bg-green" style="font-size:9px">Consulta</span>';
											}
								echo '
								
										</div>
										
									</div>
									
																	
									<div class="col-md-12 col-xs-12"><hr>'.$row3['descripcion'].'</div>
									</div>
								</div>
							</div>
                          </div>
                        
						';
				
						}
						
cierradatabase();
}
?>
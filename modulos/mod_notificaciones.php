<?php require_once('common.php'); checkUser(); //chequeo de usuario entrante ?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="panel panel-info">
								<div class="panel-heading">Citas para Hoy (<?php date_default_timezone_set('America/Caracas'); echo date('d/m/Y');?>)</div>
								<div class="panel-body">
									<?php 
										$sql="SELECT  id_paciente, id_cita, tx_motivo,tx_nombres_apellidos, tx_foto, tx_nombre_consultorio, tx_tipo, to_char(fe_cita,'DD/MM/YYYY') as fe_cita FROM vie_tbl_cita WHERE fe_cita :: date=NOW() ::date ORDER BY fe_cita";
										$res=abredatabase(g_BaseDatos,$sql);
										if (dnumerofilas($res)==0){
											echo "No hay citas pendientes";
										}
										else{
										$n_pacientes=dnumerofilas($res);
										echo "Nº de Paciente(s): ".$n_pacientes."<p>";
										while($row=dregistro($res)){
										$foto=$row['tx_foto'];
									    if ($foto==""){
										$foto="../img/fotos/img.jpg";	
										}else{
											$foto="uploads/foto_paciente/".trim($foto);
										}
										 
										
									?>
									<a href="mod_paciente_editar.php?id=<?php echo $row['id_paciente']; ?>&id_cita=<?php echo $row['id_cita']; ?>">
									<div class="row">
										<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"  >
											<img src="<?php echo $foto; ?>"  style="width:30px; height:30px"	> 
										</div>
										<div class="col-lg-11 col-md-11 col-sm-11 col-xs-11	" style="font-size:10px"  >
											
											<label>Paciente: </label><?php echo $row['tx_nombres_apellidos']; ?><br>
											<label>Consultorio: </label><?php echo $row['tx_nombre_consultorio']; ?>
											<label><?php echo $row['tx_tipo']; ?> :</label> <?php echo $row['tx_motivo']; ?>
										</div>
									</div>
									</a>
									<hr>
									
										<?php }} cierradatabase(); ?>
								</div>
						</div>
				</div>
				
				
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="panel panel-danger">
								<div class="panel-heading">Cirugías para Hoy</div>
								<div class="panel-body">
									No hay cirujías para hoy
								</div>
						</div>
				</div>

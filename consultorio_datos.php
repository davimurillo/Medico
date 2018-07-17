 <?php  require_once('common.php'); ?>
 <div class="row" >
			   <?php 
				$sql="SELECT id_consultorio,tx_nombre_consultorio, (tx_direccion || ',' || tx_ciudad || ',' || tx_estado) as direccion, tx_telefono, tx_horario,tx_ubicacion FROM tbl_consultorio WHERE n_estatus=1 and id_consultorio=".$_POST['id']." ORDER BY id_consultorio";		
				$res=abredatabase(g_BaseDatos,$sql);
				$row=dregistro($res);
			  ?>
                <div class="col-md-12" >
                  <article class="single-from-blog" style="border:1px solid #ccc; ">
					
                     <div class="blog-title">
                      <h2><i class="fa fa-hospital-o"></i> <?php echo $row['tx_nombre_consultorio']; ?></h2>
                    </div>
                    <p><i class="fa fa-map-marker"></i> <label>Dirección</label><br><?php echo $row['direccion']; ?></p>
                    <p><i class="fa fa-clock-o"></i> <label>Horarios</label><br><?php echo $row['tx_horario']; ?></p>
                    <p><i class="fa fa-phone"></i> <label>Teléfono(s)</label><br><?php echo $row['tx_telefono']; ?></p>
                    <input type="hidden" id="id_consultorio_datos" value="<?php echo $_POST['id']; ?>" >
					
                  </article>
                </div>
                <?php  cierradatabase(); ?>
				
             
            </div>
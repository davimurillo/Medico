<?php 	require_once('common.php');	checkUser(); 
// configuración de los tickets
			  $numero_ticket="000000";
			  $array_color_estatus=array( "1269"=>"bg-blue","1270"=>"bg-green", "1271"=>"bg-orange", "1272"=>"bg-purple", "1273"=>"bg-red"  );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Libreria CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	
	
  <!-- Custom styling plus plugins -->
   <link href="../fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/animate.min.css" rel="stylesheet">
  <link href="../css/custom.css" rel="stylesheet">
  <link href="../css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="../css/icheck/flat/green.css" rel="stylesheet">
	<script type='text/javascript' src='../lib/js/jquery.min1.11.2.js'></script> 
<!-- Bootstrap Core JavaScript -->
    <script src="../lib/js/bootstrap.min.js"></script>
  <link href="../css/estilos.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="src/bootstrap-wysihtml5.css"></link>
	
</head>


<body class="nav-md">


<div  id="cuerpo" class="container-fluid">
	
	<div class="col-md-12"  >
			<div class="title_left">
              <h3>Tabla de Control de Tickets  <img class="ayuda" src="../img/botones/ayuda.png" title="Ayuda al Usuario"  /></h3>
            </div>
			
	</div>
	<div class="col-md-12" style="margin-top:-20px"  >
		<hr>
	</div>
	<div class="col-md-12" style="margin-top:-10px" >
		<div class="col-md-2 " style=" padding:15px 0px 17px 0px;text-align:center; background-color:#333 "  >
			Pendiente
		</div>
		<?php 
			$sql="SELECT id_maestro,nombre FROM maestro WHERE id_nivel_maestro=1268";
			$res=abredatabase(g_BaseDatos,$sql);
			while($row=dregistro($res)){
		?>
		<div class="col-md-2 <?php echo $array_color_estatus[$row[0]]; ?>" style=" padding:15px 0px 15px 0px;text-align:center;"  >
			<?php echo $row['nombre']; ?>
		</div>
		<?php } ?>
		
	</div>
	<div class="col-md-12" style="margin-top:-10px"  >
		<hr>
	</div>
	<div class="col-md-12"  >
		<div class="col-md-2"  >
			<?php 
			$sql2="SELECT id_ticket FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." and estatus=1269 and responsive=0";
			$res2=abredatabase(g_BaseDatos,$sql2);
			while($row2=dregistro($res2)){
			$ticket="Ticket #".substr($numero_ticket,1,strlen($numero_ticket)-strlen($row2['id_ticket'])).$row2['id_ticket'];
			echo "<div class='col-md-12'><a href='Ticket_inbox.php?id=".$row2['id_ticket']."'>".$ticket."</a></div>"; 
			
			}?>
		</div>
		
		
		<div class="col-md-2"  >
			<?php 
			 $sql2="SELECT id_ticket FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." and (SELECT CASE WHEN (SELECT estatus FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) IS NULL THEN estatus ELSE (SELECT estatus FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1) END)=1269 and responsive=1 and clasificacion_ticket=1 ";
			$res2=abredatabase(g_BaseDatos,$sql2);
			while($row2=dregistro($res2)){
			$ticket="Ticket #".substr($numero_ticket,1,strlen($numero_ticket)-strlen($row2['id_ticket'])).$row2['id_ticket'];
			echo "<div class='col-md-12'><a href='Ticket_inbox.php?id=".$row2['id_ticket']."'>".$ticket."</a></div>"; 
			
			}?>
		</div>
		<div class="col-md-2"  >
			<?php 
			$sql2="SELECT id_ticket FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." and (SELECT estatus FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=1270 and clasificacion_ticket=1";
			$res2=abredatabase(g_BaseDatos,$sql2);
			while($row2=dregistro($res2)){
			$ticket="Ticket #".substr($numero_ticket,1,strlen($numero_ticket)-strlen($row2['id_ticket'])).$row2['id_ticket'];
			echo "<div class='col-md-12'><a href='Ticket_inbox.php?id=".$row2['id_ticket']."'>".$ticket."</a></div>";
			
			}?>
		</div>
		<div class="col-md-2"  >
			<?php 
			$sql2="SELECT id_ticket FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." and (SELECT estatus FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=1271 and clasificacion_ticket=1";
			$res2=abredatabase(g_BaseDatos,$sql2);
			while($row2=dregistro($res2)){
			$ticket="Ticket #".substr($numero_ticket,1,strlen($numero_ticket)-strlen($row2['id_ticket'])).$row2['id_ticket'];
			echo "<div class='col-md-12'><a href='Ticket_inbox.php?id=".$row2['id_ticket']."'>".$ticket."</a></div>";
			
			}?>
		</div>
		<div class="col-md-2"  >
			<?php 
			$sql2="SELECT id_ticket FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." and (SELECT estatus FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=1272 and clasificacion_ticket=1";
			$res2=abredatabase(g_BaseDatos,$sql2);
			while($row2=dregistro($res2)){
			$ticket="Ticket #".substr($numero_ticket,1,strlen($numero_ticket)-strlen($row2['id_ticket'])).$row2['id_ticket'];
			echo "<div class='col-md-12'><a href='Ticket_inbox.php?id=".$row2['id_ticket']."'>".$ticket."</a></div>"; 
			
			}?>
		</div>
		<div class="col-md-2"  >
			<?php 
			$sql2="SELECT id_ticket FROM tickets a WHERE id_usuario_emisor=".$_SESSION['id_usuario']." and (SELECT estatus FROM tickets b,maestro c WHERE c.id_maestro=b.estatus and  b.id_ticket_padre=a.id_ticket ORDER BY id_ticket DESC LIMIT 1)=1273 and clasificacion_ticket=1";
			$res2=abredatabase(g_BaseDatos,$sql2);
			while($row2=dregistro($res2)){
			$ticket="Ticket #".substr($numero_ticket,1,strlen($numero_ticket)-strlen($row2['id_ticket'])).$row2['id_ticket'];
			echo "<div class='col-md-12'><a href='Ticket_inbox.php?id=".$row2['id_ticket']."'>".$ticket."</a></div>";
			
			}?>
		</div>
			
		
	</div>
	
	
	<!-- richtext editor -->
<script src="lib/js/wysihtml5-0.3.0.js"></script>

<script src="lib/js/prettify.js"></script>
<script src="lib/js/bootstrap.min.js"></script>
<script src="src/bootstrap-wysihtml5.js"></script>

<script>
	$('#descripcion').wysihtml5();
</script>

  <script src="../lib/js/editor/external/jquery.hotkeys.js"></script>
 

  <!-- bootstrap progress js -->
  <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
  
  <!-- icheck -->
  <script src="../js/icheck/icheck.min.js"></script>
	<script src="../js/moment/moment.min.js"></script>
  <script src="../js/chartjs/chart.min.js"></script>
  <script src="../js/custom.js"></script>
  
  <!-- Datatables -->
  <script src="../js/datatables/js/jquery.dataTables.js"></script>
  <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

  <!-- pace -->
  <script src="../js/pace/pace.min.js"></script>
 
  

</body>
</html>
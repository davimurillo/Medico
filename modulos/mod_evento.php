<?php require_once('common.php'); checkUser(); //chequeo de usuario entrante 

if ($_POST['f']==1){
 $sql="UPDATE tbl_cita SET id_estatus=6 WHERE id_cita=".$_POST['id'];
$res=abredatabase(g_BaseDatos,$sql);
?>
<script> location.reload(); </script>
<?php

}
?>
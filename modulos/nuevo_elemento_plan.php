<?php require_once('common.php'); checkUser(); ?>
<?php if ($_GET['f']==1){ ?>
<?php if ($_GET['esquema']==1){ ?>
<script>
	document.getElementById('nombre').innerHTML="Crear Esquema -> Esquema";
</script>
<?php }else {
	$select2="SELECT id_maestro,id_nivel_maestro,nombre,tipo_arbol FROM maestro a,tipo_arbol b WHERE a.id_tipo_arbol=b.id_tipo_arbol and id_maestro=".$_GET['id']."   ORDER BY id_nivel_maestro, id_maestro ASC";
	$res2=abredatabase(g_BaseDatos,$select2);
	$row2=dregistro($res2);	
?>
<script>
	document.getElementById('nombre').innerHTML="Crear Esquema -> <?php echo utf8_encode($row2['tipo_arbol']); ?>";
</script>
<?php
}?>
<iframe id=frames  width="100%"  allowtransparency="1" frameborder="0" src="agregar_plan.php?id=<?php echo $_GET['id']; ?>&nodeidtree=<?php echo $_GET['nodeidtree']; ?>&padre=<?php echo $_GET['padre']; ?>"></iframe>
<?php } ?>

<?php require_once('common.php'); checkUser(); ?>
<?php $style = isset($_GET["style"]) ? $_GET["style"] : "default"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
   
   <!-- Libreria CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	
	
</head>


<body style=" font:normal 12px Trebuchet MS">

<table width="100%" id=tabla  border=0 cellpadding="1" cellspacing="0" >
<tr bgcolor="#006699" >
	<td width="373" height="46px" valign="center"  ><span  id="nombre" style="margin-left:15px; color:#fff; font-size:18px ">Crear Esquema</span></td>
	<td width="625" align="center" valign="center" ><span  style="color:#fff; font-size:18px">Descripción</span></td>
</tr>
<tr>
	<td valign="top" style="font-size:13px; color:#000000;" >
<div id=seleccion style=" OVERFLOW: auto; WIDTH: 100%; TOP: 48px;">		
		<?php
			define("TREEMENU_DIR",g_dir.'lib/tree/');
			include(TREEMENU_DIR."treemenu.class.php");
			$treeMenu = new TreeMenu();
  		    $treeMenu->SetStyle("vista");
		$treeMenu->ShowNumSubNodes(true);
   		    $treeMenu->SetPostBackMethod("GET");
   		    $treeMenu->SetDirection("ltr");
   		    $treeMenu->SetHttpVars(array("submission","style","direction","tabid1"));
            $treeMenu->SetId("tree");
			
				
				$id="treeMenu"; 
					eval('$n0 = $'.$id.'->AddNode("Esquema","nuevo_elemento_plan.php?id=0&f=1&padre=0&esquema=1");');
					
					$select2="SELECT DISTINCT id_maestro,id_nivel_maestro,nombre,tipo_arbol FROM maestro a,tipo_arbol b WHERE a.id_tipo_arbol=b.id_tipo_arbol   ORDER BY id_nivel_maestro, id_maestro, b.tipo_arbol ASC";
					$res2=abredatabase(g_BaseDatos,$select2);
					while($row2=dregistro($res2))
					{
						$valor=$row2[2];
						$valor=htmlspecialchars($valor, ENT_QUOTES);
						
						if ($row2[1]==0) 
						{ 
							$id="treeMenu"; 
							$valor="<label >".$valor."</label>";
							eval('$n'.$row2[0].' = $n0->AddNode("'.$valor.'","nuevo_elemento_plan.php?id=$row2[0]&f=1&padre=0&esquema=0");'); 
						}
						else 
						{ 
							$sql3="SELECT * FROM maestro WHERE id_nivel_maestro=".$row2[0]." ORDER BY id_maestro";
							$res3=abredatabase(g_BaseDatos,$sql3);
							if (dnumerofilas($res3)!=0)
							{
									$valor="<label >".$valor."</label>";
								   eval('$n'.$row2[0].' = $n'.$row2[1].'->AddNode("'.$valor.'","nuevo_elemento_plan.php?id=$row2[0]&f=1&padre=0&esquema=0");');
							}else
							{
									$valor="<label >".$valor."</label>";
							       eval('$n'.$row2[1].'->AddNode("'.$valor.'","nuevo_elemento_plan.php?id=$row2[0]&f=1&padre=1&esquema=0");');
							}
						}
					}
					
				
				

			$treeMenu->UseDefaultFileIcons(true);
            $treeMenu->AllowRefreshSelectedNodes(true);
   			$treeMenu->ShowTree();

		?>
</div>		
	</td>
	<td width="625" valign="top" style="padding:2px; font-size:13px; color:#222222;">
		
		<?php	$treeMenu->ShowContent();  ?>
		

	</td>
</tr>

</table>
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
  document.getElementById('tabla').style.height=(myHeight-20) + "px";
   document.getElementById('seleccion').style.height=(myHeight-120) + "px";
  document.getElementById('frames').style.height=(myHeight-150) + "px";
  
  
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






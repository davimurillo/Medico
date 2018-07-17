<?php require_once('common.php'); checkUser(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="pragma" content="no-cache"> 
	<title>Administrar - Modulo</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	
	<!-- Libreria CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
	
	 <!-- jQuery -->
    <script src="../lib/js/jquery.min1.11.2.js"></script>
	
	
</head>

<body>
<div class="container-fluid">
<!-- Cabecera del formulario -->

	
	<div class="row"  style=" width:100%; font-size:18px; color:#888; margin-top:10px; padding-top:5px" >
			<img src="../img/sistema/modulo.png" style="margin-top:-10px"> Estructura Organizativa <img class="ayuda" src="../img/botones/ayuda.png" title="Ayuda al Usuario" style="margin-left:8px; margin-top:-2px" />
	</div>
	

	<div class="row" style="font-size:12px" >
	
	<?php

	################################################################################   
	## +---------------------------------------------------------------------------+
	## | 1. Creating & Calling:                                                    | 
	## +---------------------------------------------------------------------------+
	##  *** only relative (virtual) path (to the current document)
	   define ("DATAGRID_DIR", g_dir."lib/datagrid/");
	  define ("PEAR_DIR", g_dir."lib/datagrid/pear/");
	  
	  require_once(DATAGRID_DIR.'datagrid.class.php');
	  require_once(PEAR_DIR.'PEAR.php');
	  require_once(PEAR_DIR.'DB.php');

	##  *** creating variables that we need for database connection 
	  $DB_BASE=g_TipoBaseDatos;
	  $DB_USER=g_User;            
	  $DB_PASS=g_Pass;      
	  $DB_PORT=g_Port;     
	  $DB_HOST=g_ServidorBaseDatos;       
	  $DB_NAME=g_BaseDatos;  
		 

	ob_start();
	  $db_conn = DB::factory($DB_BASE); 
	  $db_conn -> connect(DB::parseDSN($DB_BASE.'://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.':'.$DB_PORT.'/'.$DB_NAME));


	##  *** put a primary key on the first place 
	  $sql=" SELECT "
	  ."id_ente_direccion,cod_responsable, "
	   ."CASE WHEN a.estatus=1 THEN 'Activo' WHEN a.estatus=0 THEN 'Inactivo' END AS estatus, "
	   ."ente_direccion  "
	   ." FROM cfg_estructura_organizativa a"
	   ." WHERE  id_licencia=".$_SESSION['licencia'];
	   if ($_SESSION['rol']<3){
	if ($_SESSION['responsable']!="")
	{
	$sql.=" AND a.id_ente_direccion IN (".$_SESSION['responsable'].")";
	}}
	   
	##  *** set needed options
	  $debug_mode = false;
	  $messaging = true;
	  $unique_prefix = "f_";  
	  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
	##  *** set data source with needed options
	  $default_order_field = "cod_responsable,ente_direccion";
	//  $default_order_field = "direccion,primer_apellido";
	  $default_order_type = "ASC,ASC";
	  $dgrid->dataSource($db_conn, $sql, $default_order_field, $default_order_type);	    

	## +---------------------------------------------------------------------------+
	## | 2. General Settings:                                                      | 
	## +---------------------------------------------------------------------------+
	##  *** set encoding and collation (default: utf8/utf8_unicode_ci)
	 $dg_encoding = "utf8";
	 $dg_collation = "utf8_unicode_ci";
	 $dgrid->setEncoding($dg_encoding, $dg_collation);

	if ($_SESSION['rol']==3 or $_SESSION['rol']==4 ){
	$modes = array(
	  "add"     =>array("view"=>true, "edit"=>false, "type"=>"image"),
	  "edit"    =>array("view"=>true, "edit"=>true, "type"=>"image"),
	  "cancel"  =>array("view"=>true, "edit"=>true, "type"=>"image"),
	  "details" =>array("view"=>false, "edit"=>false, "type"=>"image"),
	  "delete"  =>array("view"=>true, "edit"=>false, "type"=>"image")
	);} else {
	$modes = array(
	  "add"     =>array("view"=>false, "edit"=>false, "type"=>"image"),
	  "edit"    =>array("view"=>true, "edit"=>true, "type"=>"image"),
	  "cancel"  =>array("view"=>true, "edit"=>true, "type"=>"image"),
	  "details" =>array("view"=>false, "edit"=>false, "type"=>"image"),
	  "delete"  =>array("view"=>false, "edit"=>false, "type"=>"image")
	);	
	}
	$dgrid->setModes($modes);



	$multirow_option = true;
	$dgrid->allowMultirowOperations($multirow_option);
	$multirow_operations = array(
	  "delete"  => array("view"=>true),
	  "details" => array("view"=>true)
	);
	$dgrid->setMultirowOperations($multirow_operations);  



	##  *** set interface language (default - English)
	##  *** (en) - English     (de) - German     (se) Swedish     (hr) - Bosnian/Croatian
	##  *** (hu) - Hungarian   (es) - Espanol    (ca) - Catala    (fr) - Francais
	##  *** (nl) - Netherlands/"Vlaams"(Flemish) (it) - Italiano  (pl) - Polish
	##  *** (ch) - Chinese     (sr) - Serbian
	 $dg_language = "es";  
	 $dgrid->setInterfaceLang($dg_language);

	 $css_class = "x-blue";
	 if($css_class == "") $css_class = "default"; 
	## "embedded" - use embedded classes, "file" - link external css file
	 $css_type = "embedded"; 
	 $dgrid->setCssClass($css_class, $css_type);
	## +---------------------------------------------------------------------------+
	## | 3. Printing & Exporting Settings:                                         | 
	## +---------------------------------------------------------------------------+
	##  *** set printing option: true(default) or false 
	 $printing_option = false;
	 $dgrid->allowPrinting($printing_option);
	##  *** set exporting option: true(default) or false 
	 $exporting_option = false;
	 $dgrid->allowExporting($exporting_option);
	##

	##
		## +---------------------------------------------------------------------------+
		## | 4. Sorting & Paging Settings:                                             | 
		## +---------------------------------------------------------------------------+
		##  *** set sorting option: true(default) or false 

	$paging_option = true;
	$rows_numeration = false;
	$numeration_sign = "N #";
	$dgrid->allowPaging($paging_option, $rows_numeration, $numeration_sign);
	$bottom_paging = array(
			 "results"=>true, "results_align"=>"left", 
			 "pages"=>true, "pages_align"=>"center", 
			 "page_size"=>true, "page_size_align"=>"right");
	$top_paging = array(
			 "results"=>true, "results_align"=>"left",
			 "pages"=>true, "pages_align"=>"center",
			 "page_size"=>true, "page_size_align"=>"right");
	$pages_array = array("5"=>"5","10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000", "2000"=>"2000");
	$default_page_size = 5;
	$paging_arrows = array("first"=>"|<<", "previous"=>"<<", "next"=>">>", "last"=>">>|");
	$dgrid->setPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size);



	##
	## +---------------------------------------------------------------------------+
	## | 5. Filter Settings:                                                       | 
	## +---------------------------------------------------------------------------+
	##  *** set filtering option: true or false(default)

	
		
	
		
		
		
		
	  
	 
		
		
		
		
	 $filtering_option = true;
	 $dgrid->allowFiltering($filtering_option);
	##  *** set aditional filtering settings
	  $filtering_fields = array(
		
		"Nombre de la Unidad / Ente"     =>array("table"=>"a", "field"=>"ente_direccion", "source"=>"self","operator"=>true, "default_operator"=>"%like%", "type"=>"textbox", "autocomplete"=>true, "case_sensitive"=>false,  "comparison_type"=>"string")
	  );
	  $dgrid->setFieldsFiltering($filtering_fields);
	##
	## 


	## +---------------------------------------------------------------------------+
	## | 6. View Mode Settings:                                                    | 
	## +---------------------------------------------------------------------------+
	##  *** set columns in view mode
	   //$dgrid->setAutoColumnsInViewMode(true);  
	   
	  
	  
	 $vm_colimns = array(
		
		//"id_ente_direccion"  =>array("header"=>"ID","type"=>"label", "width"=>"10%", "align"=>"center",   "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		"cod_responsable"  =>array("header"=>"Código", "type"=>"label", "width"=>"10%", "align"=>"center",   "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
		//"sector"  =>array("header"=>"SECTOR", "type"=>"label", "width"=>"10%", "align"=>"left",   "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
		//"organizacion"  =>array("header"=>"Organización", "type"=>"label", "width"=>"10%", "align"=>"left",   "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
		"ente_direccion"  =>array("header"=>"Nombre del Responsable","type"=>"label", "width"=>"60%", "align"=>"left",   "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		"estatus"  =>array("header"=>"Estatus","type"=>"label", "width"=>"10%", "align"=>"center",   "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal")
	  );
	  $dgrid->setColumnsInViewMode($vm_colimns);
	## +---------------------------------------------------------------------------+
	## | 7. Add/Edit/Details Mode settings:                                        | 
	## +---------------------------------------------------------------------------+
	##  ***  set settings for edit/details mode
	  
	  $estatus_array=array('0'=>'Inactivo','1'=>'Activo');
	  
	  //*****ARREGLO PARA CAMPO TIPO NIVEL ORGANIZACION ******//
		$tema_array_sql = "SELECT nivel_org,id_nivel_org FROM nivel_organizacional";
		$especial_array_str = crearArregloDataGrid2($tema_array_sql,"nivel_organizacional_array",g_BaseDatos);
		eval($especial_array_str);		
		//******FIN DE ARREGLO PARA TIPO NIVEL ORGANIZACION *****///
	  
	  $table_name = "cfg_estructura_organizativa";
	  $primary_key = "id_ente_direccion";
	  $condition = "";
	  $dgrid->setTableEdit($table_name, $primary_key, $condition);
	  $dgrid->setAutoColumnsInEditMode(false);
	  $estatus_array=array("1"=>"Activo","0"=>"Inactivo");
	   $em_columns = array(
		 //"id_ministerio" =>array("header"=>"Ministerio",  "type"=>"enum",     "source"=>$ministerio_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>"Ministerio al Cual pertenece el Ente Adscrito o Dirección"),
		
		 
		  "id_nivel_org" =>array("header"=>"Nivel en la Organización",  "type"=>"enum",     "source"=>$nivel_organizacional_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>"Nivel de la Orgnanización del Ente o Dirección"),
		  
		   "cod_responsable" =>array("header"=>"Código", "type"=>"textbox", "width"=>"210px", "req_type"=>"sy", "title"=>"Código Interno", "unique"=>false),
		  
		   "ente_direccion" =>array("header"=>"Nombre del Ente o Dirección", "type"=>"textbox", "width"=>"410px", "req_type"=>"ry", "title"=>"Nombre del Ente o Dirección", "unique"=>false),
		   "estatus" =>array("header"=>"Estatus",  "type"=>"enum",     "source"=>$estatus_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>"estatus", "default"=>"1"),
		   "id_licencia" =>array("header"=>"Licencia", "type"=>"hidden", "width"=>"120px", "req_type"=>"rn", "title"=>"", "unique"=>false, "default"=>$_SESSION['licencia'])
	  );

	  $dgrid->setColumnsInEditMode($em_columns);
	##  *** set auto-genereted eName_1.FieldName > 'a' AND TableName_1.FieldName < 'c'"
	##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"

	  
	## +---------------------------------------------------------------------------+
	## | 8. Bind the DataGrid:                                                     | 
	## +---------------------------------------------------------------------------+
	##  *** set debug mode & messaging options
		/*echo "<b>Usuario:</b>".$_SESSION['nombre']."<br>";
		echo "<b>Unidad:</b>".$_SESSION['unidad'];
		echo "<br>";*/
		//hide_grid_before_search = "true";
		
		$dgrid->bind();        
		//$dgrid->"autocomplete"=>"on";
		ob_end_flush();
	 
	?>

  
   </div>
  </div>
   <script>
$('.ayuda').click(function() {
			alert("Modulo de Unidad Ejecutora / Ente Adscrito: Este modulo tiene el proposito de registrar las unidades ejecutoras o los entes adscritos con todos sus datos esenciales para el funcionamiento del aplicativo. Para mayor información consulte el Manual de Usuario del Sistema");
		});
</script>
</body>  
</html>




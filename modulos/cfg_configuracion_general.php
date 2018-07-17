<?php require_once('common.php'); checkUser(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="pragma" content="no-cache"> 
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
	
	<!-- Libreria CSS -->
     <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
	 <link href="../lib/fonts/css/font-awesome.min.css" rel="stylesheet">
     <link href="../lib/css/animate.min.css" rel="stylesheet">
	
     <link rel="stylesheet" type="text/css" href="../lib/css/progressbar/bootstrap-progressbar-3.3.0.css">
		
</head>

<div class="container-fluid">
	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"  style=" width:100%; font-size:18px; color:#888; padding-top:5px" >
				<i class="fa fa-edit"></i> Modulos de Configuración General <img class="ayuda" src="../img/botones/ayuda.png" title="Ayuda al Usuario" style="margin-left:8px; margin-top:-2px" />
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<hr>
			</div>
 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
	   ."id_configuracion, "
	   ."tx_tipo_configuracion, tx_nombre,tx_valor"
	   ." FROM cfg_configuracion_general";

	   
	##  *** set needed options
	  $debug_mode = false;
	  $messaging = true;
	  $unique_prefix = "f_";  
	  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
	##  *** set data source with needed options
	  $default_order_field = "tx_tipo_configuracion";
	//  $default_order_field = "direccion,primer_apellido";
	  $default_order_type = "ASC";
	  $dgrid->dataSource($db_conn, $sql, $default_order_field, $default_order_type);	    

	## +---------------------------------------------------------------------------+
	## | 2. General Settings:                                                      | 
	## +---------------------------------------------------------------------------+
	##  *** set encoding and collation (default: utf8/utf8_unicode_ci)
	  $postback_method = "get";
	  $dgrid->SetPostBackMethod($postback_method);
		
		$dgrid->firstFieldFocusAllowed = "true";
		$dg_encoding = "utf8";
		$dg_collation = "utf8_unicode_ci";
		$dgrid->setEncoding($dg_encoding, $dg_collation);
	 


	$modes = array(
	  "add"     =>array("view"=>1, "edit"=>0, "type"=>"image"),
	  "edit"    =>array("view"=>true, "edit"=>true, "type"=>"image"),
	  "cancel"  =>array("view"=>true, "edit"=>true, "type"=>"image"),
	  "details" =>array("view"=>false, "edit"=>false, "type"=>"image"),
	  "delete"  =>array("view"=>true, "edit"=>false, "type"=>"image")
	);
	$dgrid->setModes($modes);



	$multirow_option = true;
	$dgrid->allowMultirowOperations($multirow_option);
	$multirow_operations = array(
	  "delete"  => array("view"=>true),
	  "details" => array("view"=>true),
	  //"edit" => array("view"=>true),
	  
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
	$pages_array = array("10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000", "2000"=>"2000");
	$default_page_size = 10;
	$paging_arrows = array("first"=>"|<<", "previous"=>"<<", "next"=>">>", "last"=>">>|");
	$dgrid->setPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size);

	##
	## +---------------------------------------------------------------------------+
	## | 5. Filter Settings:                                                       | 
	## +---------------------------------------------------------------------------+
	##  *** set filtering option: true or false(default)

		
	##  *** set filtering option: true or false(default)

		$filtering_option = true;

	 $dgrid->allowFiltering($filtering_option);
	##  *** set aditional filtering settings
	  $filtering_fields = array(
		 
	 "tipo"  =>array("table"=>"cfg_configuracion_general", "field"=>"tx_tipo_configuracion", "source"=>"self","operator"=>true, "default_operator"=>"%like%", "type"=>"textbox", "autocomplete"=>true, "case_sensitive"=>true,  "comparison_type"=>"string")
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
	 "id_configuracion"  =>array("header"=>"ID",      "type"=>"label", "width"=>"5%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
	 "tx_tipo_configuracion"  =>array("header"=>"tipo",      "type"=>"label", "width"=>"30%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
		"tx_nombre"  =>array("header"=>"Elemento",      "type"=>"label", "width"=>"40%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
		"tx_valor"  =>array("header"=>"Valor",      "type"=>"label", "width"=>"25%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal")
	  );
	  $dgrid->setColumnsInViewMode($vm_colimns);
	## +---------------------------------------------------------------------------+
	## | 7. Add/Edit/Details Mode settings:                                        | 
	## +---------------------------------------------------------------------------+
	##  ***  set settings for edit/details mode
	 
	 
	  $table_name = "cfg_configuracion_general";
	  $primary_key = "id_configuracion";
	  $condition = "";
	  $dgrid->setTableEdit($table_name, $primary_key, $condition);
	  $dgrid->setAutoColumnsInEditMode(false);
	   $em_columns = array(
	   												
		"tx_tipo_configuracion" =>array("header"=>"tipo", 
													"type"=>"textbox", 
													"width"=>"210px", 
													"req_type"=>"ry", 
													"title"=>"", 
													"unique"=>false),
		"tx_nombre" =>array("header"=>"Elemento", 
													"type"=>"textbox", 
													"width"=>"210px", 
													"req_type"=>"ry", 
													"title"=>"", 
													"unique"=>false),
		"tx_valor" =>array("header"=>"Valor", 
													"type"=>"textbox", 
													"width"=>"210px", 
													"req_type"=>"ry", 
													"title"=>"", 
													"unique"=>false),
		
		"tx_icono" =>array("header"=>"Icono", 
													"type"=>"textbox", 
													"width"=>"210px", 
													"req_type"=>"sy", 
													"title"=>"", 
													"unique"=>false)
													
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
			alert("Modulo de Modulos del Sistema: Este modulo tiene el proposito de registrar los modulos operativos del sistema, estos son lo que se le asignan a los usuario para accesar a los distintos procesos del sistema a través del menu principal y son asignados a cada usuario. Para mayor información consulte el Manual de Usuario del Sistema");
		});
</script>
</body>
</html>

	





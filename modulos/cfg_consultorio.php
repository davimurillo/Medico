<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	<link href="../lib/css/font-awesome.css" rel="stylesheet">
	
	
</head>
<body>

<div class="container-fluid">
			
	
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
<?php 
################################################################################   
## +---------------------------------------------------------------------------+
## | 1. Creating & Calling:                                                    | 
## +---------------------------------------------------------------------------+
##  *** only relative (virtual) path (to the current document)

##  *** creating variables connection 
  require_once('common.php'); checkUser(); 
  $mode = (isset($_GET['f_mode'])) ? $_GET['f_mode'] : ""; 
  $rid = (isset($_GET['f_rid'])) ? $_GET['f_rid'] : ""; 

  define ("DATAGRID_DIR", g_dir."lib/datagrid/");
  define ("PEAR_DIR", g_dir."lib/datagrid/pear/");
  
  require_once(DATAGRID_DIR.'datagrid.class.php');
  require_once(PEAR_DIR.'PEAR.php');
  require_once(PEAR_DIR.'DB.php');

##  *** creating variables that we need for database connection 
  $DB_BASE=g_TipoBaseDatos;
  $DB_USER=g_User;            
  $DB_PASS=g_Pass;           
  $DB_HOST=g_ServidorBaseDatos;       
  $DB_NAME=g_BaseDatos;  
     

ob_start();
  $db_conn = DB::factory($DB_BASE); 
  $db_conn -> connect(DB::parseDSN($DB_BASE.'://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));


##  *** put a primary key on the first place 

  	$sql=" SELECT id_consultorio, tx_nombre_consultorio, tx_telefono, n_paciente, '<i class=\"fa fa-external-link\" style=\" font-size:18px\" ><i>' as ver_datos FROM tbl_consultorio";
  
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "tx_nombre_consultorio";
//  $default_order_field = "direccion,primer_apellido";
  $default_order_type = "ASC";
  $dgrid->dataSource($db_conn, $sql, $default_order_field, $default_order_type);	    

## +---------------------------------------------------------------------------+
## | 2. General Settings:                                                      | 
## +---------------------------------------------------------------------------+
##  *** set encoding and collation (default: utf8/utf8_unicode_ci)

$postback_method = "GET";
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
  "delete"  =>array("view"=>1, "edit"=>0, "type"=>"image")
);

$dgrid->setModes($modes);



 $multirow_option = false;
 $dgrid->allowMultirowOperations($multirow_option);
 $multirow_operations = array(
    "delete"  => array("view"=>false),
    "details" => array("view"=>false),
	"edit" => array("view"=>true)
 );
 $dgrid->setMultirowOperations($multirow_operations); 



##  *** set interface language (default - English)
##  *** (en) - English     (de) - German     (se) Swedish     (hr) - Bosnian/Croatian
##  *** (hu) - Hungarian   (es) - Espanol    (ca) - Catala    (fr) - Francais
##  *** (nl) - Netherlands/"Vlaams"(Flemish) (it) - Italiano  (pl) - Polish
##  *** (ch) - Chinese     (sr) - Serbian
 $dg_language = "es";  
 $dgrid->setInterfaceLang($dg_language);

#
##  *** set layouts: "0" - tabular(horizontal) - default, "1" - columnar(vertical), "2" - customized
#
  $layouts = array("view"=>"0", "edit"=>"1", "details"=>"1", "filter"=>"1");
#
  $dgrid->SetLayouts($layouts);
  
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

$paging_option = false;
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
 $filtering_option = false;
 $dgrid->allowFiltering($filtering_option);
##  *** set aditional filtering settings
 
  $filtering_fields = array(
    "Nombre"     =>array("table"=>"desarrollo", "field"=>"desarrollo", "source"=>"self","operator"=>true, "default_operator"=>"%like%", "type"=>"textbox", "autocomplete"=>true, "case_sensitive"=>false,  "comparison_type"=>"string")
  );
  $dgrid->setFieldsFiltering($filtering_fields);
##
## 


## +---------------------------------------------------------------------------+
## | 6. View Mode Settings:                                                    | 
## +---------------------------------------------------------------------------+
##  *** set columns in view mode
   //$dgrid->setAutoColumnsInViewMode(true);  
	$vm_table_properties = array("width"=>"100%","sortable"=>false);
	$dgrid->SetViewModeTableProperties($vm_table_properties); 
	
 	$vm_colimns = array(
		"tx_nombre_consultorio"  =>array("header"=>"Consultorio","header_align"=>"center","type"=>"label", "width"=>"70%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		
		"tx_telefono"  =>array("header"=>"Teléfono(s)","header_align"=>"center","type"=>"label", "width"=>"15%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		"n_paciente"  =>array("header"=>"Pacientes / Día","header_align"=>"center","type"=>"label", "width"=>"15%", "align"=>"center",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		
		
	 );
	$dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
 
 
 
		
	$table_name = "tbl_consultorio";
	$primary_key = "id_consultorio";
	$condition = "";
	$dgrid->setTableEdit($table_name, $primary_key, $condition);
	$dgrid->setAutoColumnsInEditMode(false);
	$em_columns = array(

		"tx_nombre_consultorio" =>array("header"=>"Nombre del Consultorio", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
		"tx_direccion" =>array("header"=>"Dirección", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
		"tx_estado" =>array("header"=>"Provincia/Estado", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
		"tx_ciudad" =>array("header"=>"Ciudad/Población", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
		"tx_telefono" =>array("header"=>"Teléfonos", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
		
		"tx_email" =>array("header"=>"Email", "type"=>"textbox", "width"=>"100%", "req_type"=>"rey", "title"=>"", "unique"=>false),
		"tx_sitio_web" =>array("header"=>"URL", "type"=>"textbox", "width"=>"100%", "req_type"=>"ruy", "title"=>"", "unique"=>false),
		
		
		"tx_descripcion" =>array("header"=>"Descripción", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"Nombres y Apellidos", "unique"=>false),
		
		
		"tx_horario" =>array("header"=>"Horario", "type"=>"textarea", "width"=>"100%", "req_type"=>"ry", "title"=>"Horario", "unique"=>false),
		
		"n_paciente" =>array("header"=>"N° de Pacientes por Día", "type"=>"textbox", "width"=>"100px", "req_type"=>"ry", "title"=>"", "unique"=>false),
		
		"tx_ubicacion" =>array("header"=>"Ubicación en Google Maps", "type"=>"textarea", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
		
		
		"n_estatus" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>"1", "visible"=>"false", "unique"=>false),
		"id_usuario" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$_SESSION['id_usuario'], "visible"=>"false", "unique"=>false)
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


 <!-- Include JS files. -->
  <script src="../lib/js/jquery.min.js"></script>
<script src="../lib/js/bootstrap.min.js"></script>	
 

  
</body>
</html>







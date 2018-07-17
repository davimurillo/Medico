

<?php
	require_once('../lib/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Unidades de Medida</title>
   <script type="text/javascript" src="libreria/func_js/combos.js"></script>
   <link href="css/style.css" rel="stylesheet" type="text/css">
    <meta name="keywords" content="php, datagrid" />
    <meta name="description" content="php datagrid" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
</style>

</head>

<body>
 <div id="cabecera" style="padding-top:15px" >Unidad de Medida para Compras</div>
 <div style="float:left; margin-top:20px; width:95%">
<?php
################################################################################   
## +---------------------------------------------------------------------------+
## | 1. Creating & Calling:                                                    | 
## +---------------------------------------------------------------------------+
##  *** only relative (virtual) path (to the current document)
  define ("DATAGRID_DIR",  g_dir."lib/datagrid/");
  define ("PEAR_DIR",  g_dir."lib/datagrid/pear/");
  
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
  $sql=" SELECT "
   ."id_unidad_medida, "
   ."unidad_medida "
   ." FROM unidad_medida_compra";

   
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "unidad_medida";
//  $default_order_field = "direccion,primer_apellido";
  $default_order_type = "ASC";
  $dgrid->dataSource($db_conn, $sql, $default_order_field, $default_order_type);	    

## +---------------------------------------------------------------------------+
## | 2. General Settings:                                                      | 
## +---------------------------------------------------------------------------+
##  *** set encoding and collation (default: utf8/utf8_unicode_ci)
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
$pages_array = array("5"=>"5","10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000", "2000"=>"2000");
$default_page_size = 5;
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
  $unidades_array = array("1"=>"Politica", "2"=>"Prensa", "3"=>"Cultura", "4"=>"Energia", "5"=>"Despacho");
  $filtering_fields = array(
    "Nombre"     =>array("table"=>"poblacion", "field"=>"primer_nombre", "source"=>"self","operator"=>true, "default_operator"=>"%like%", "type"=>"textbox", "autocomplete"=>true, "case_sensitive"=>false,  "comparison_type"=>"string"),
	"Apellido"     =>array("table"=>"poblacion", "field"=>"primer_apellido", "source"=>"self","operator"=>true, "default_operator"=>"%like%", "type"=>"textbox", "autocomplete"=>"true", "case_sensitive"=>false,  "comparison_type"=>"string"),
    //"Date"        =>array("table"=>"countries", "field"=>"independent_date", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),      
    "Unidad"  =>array("table"=>"poblacion", "field"=>"id_unidad", "source"=>$unidades_array, "order"=>"DESC", "operator"=>true, "type"=>"dropdownlist", "case_sensitive"=>false, "comparison_type"=>"numeric")
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
	"unidad_medida"  =>array("header"=>"Unidad de Medida",      "type"=>"label", "width"=>"100%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal")
	//"objetivo"  =>array("header"=>"Objetivo",      "type"=>"label", "width"=>"70%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal")
  );
  $dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
  
  
   $estatus_array = array(""=>"-Seleccione-","1"=>"Abierto", "0"=>"Cerrado");
   // $evalua_array = array(""=>"-Seleccione-","1"=>"Si", "0"=>"No");
  $table_name = "unidad_medida_compra";
  $primary_key = "id_unidad_medida";
  $condition = "";
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $dgrid->setAutoColumnsInEditMode(false);
   $em_columns = array(
    "unidad_medida" =>array("header"=>"Unidad de Medida", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Año Fiscal", "unique"=>true),
	"estatus_unidad_medida" =>array("header"=>"Estatus",  "type"=>"enum",     "source"=>$estatus_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>"Estatus", "default"=>"1"),
												
												
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
<!--<div align="center" style="margin-top:20px"><input type="button" name="button" id="botones" value="Cerrar" onClick="window.close();"></div> -->
</div>

</body>   

</html>





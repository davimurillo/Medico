<style>
body{
	font:normal 12px Trebuchet MS;
}
.Estilo1 {
	color:#999999;
	font-weight: bold;
	font-size:24px;
}
.Estilo2 {
	color:#999999;
	font-weight: bold;
	font-size:12px;
}
#cabecera{
		background: #ffffff; /* Old browsers */
		background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#e5e5e5)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #ffffff 0%,#e5e5e5 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #ffffff 0%,#e5e5e5 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #ffffff 0%,#e5e5e5 100%); /* IE10+ */
		background: linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */
	}
#botones{
	width:170px;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff;	
	}
#botones:hover{
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
}
</style>
<div id=cabecera class="Estilo1">DEFINIR TIPO DE ARBOL</div>
<?php
	
require_once('../lib/config.php');

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
  $DB_HOST=g_ServidorBaseDatos;       
  $DB_NAME=g_BaseDatos;  
     

ob_start();
  $db_conn = DB::factory($DB_BASE); 
  $db_conn -> connect(DB::parseDSN($DB_BASE.'://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));

 

##  *** put a primary key on the first place 
  $sql=" SELECT "
   ."id_tipo_arbol, "
   ."tipo_arbol "
   ." FROM tipo_arbol";

   
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "id_tipo_arbol";
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



$multirow_option = false;
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
	"id_tipo_arbol"  =>array("header"=>"ID",      "type"=>"label", "width"=>"30%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
	"tipo_arbol"  =>array("header"=>"Tipo de Arbol",      "type"=>"label", "width"=>"30%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal")
  );
  $dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
  
  
   $estatus_array = array(""=>"-Seleccione-","1"=>"Activo", "2"=>"Inactivo");
   // $evalua_array = array(""=>"-Seleccione-","1"=>"Si", "0"=>"No");
  $table_name = "tipo_arbol";
  $primary_key = "id_tipo_arbol";
  $condition = "";
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $dgrid->setAutoColumnsInEditMode(false);
   $em_columns = array(
    "tipo_arbol" =>array("header"=>"Descripción del Tipo Arbol", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", 
	"title"=>"Descripción del Tipo Arbol", "unique"=>false),
	"id_estatus" =>array(
												"header"=>"Estatus",
												"type"=>"enum",     
												"source"=>$estatus_array, 
												"view_type"=>"dropdownlist",  
												"width"=>"139px", 
												"req_type"=>"rn", 
												"title"=>"estatus"
												)
												
												
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
<div align="center" style="margin-top:20px"><input type="button" name="button" id="botones" value="Cerrar" onClick="window.close();"></div>
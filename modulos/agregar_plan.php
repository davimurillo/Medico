<?php require_once('common.php'); checkUser(); ?>
<script>
function abrir(url){
		newwindow=window.open(url,'Atributos','height=580,width=620');
	if (window.focus) {newwindow.focus()}

}
</script>
<style>

#boton{
	
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
#boton:hover{
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
}
</style>
<div style="margin-left:25px; margin-bottom:10px; float:left"><a href="javascript:abrir('definir_atributos.php');" id="boton" >Agregar Atributo</a></div>
<div style="margin-left:25px; margin-bottom:10px; float:left"><a href="javascript:abrir('tipo_arbol.php');" id="boton" >Agregar Tipo de Arbol</a></div>

<div style="float:left; width:100%; margin-top:10px "><?php
echo "Id Elemento: (".$_GET["id"].") <p>";
$mode = (isset($_GET['f_mode'])) ? $_GET['f_mode'] : ""; 
$rid = (isset($_GET['f_rid'])) ? $_GET['f_rid'] : ""; 
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

if(isset($_REQUEST['f_mode']) && 
		($_REQUEST['f_mode'] == "add")){ 
	$sql=" SELECT DISTINCT	id_maestro, nombre, ('<img src=\"../img/botones/atributo.png\" border=\"0\" />') as etiqueta  
			FROM maestro WHERE id_maestro=0";

}else{

  	$sql=" SELECT DISTINCT	id_maestro, nombre, valor_usuario, ('<img src=\"../img/botones/atributo.png\" border=\"0\" />') as etiqueta   					
	FROM maestro WHERE id_maestro=".$_GET["id"];
   }
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "id_maestro";
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


if ($_REQUEST['padre']==0){
$modes = array(
  "add"     =>array("view"=>1, "edit"=>0, "type"=>"image"),
  "edit"    =>array("view"=>true, "edit"=>true, "type"=>"image"),
  "cancel"  =>array("view"=>true, "edit"=>true, "type"=>"image"),
  "details" =>array("view"=>false, "edit"=>false, "type"=>"image"),
  "delete"  =>array("view"=>0, "edit"=>0, "type"=>"image")
);
}else{
$modes = array(
  "add"     =>array("view"=>1, "edit"=>0, "type"=>"image"),
  "edit"    =>array("view"=>true, "edit"=>true, "type"=>"image"),
  "cancel"  =>array("view"=>true, "edit"=>true, "type"=>"image"),
  "details" =>array("view"=>false, "edit"=>false, "type"=>"image"),
  "delete"  =>array("view"=>1, "edit"=>0, "type"=>"image")
);
}
$dgrid->setModes($modes);



 $multirow_option = false;
 $dgrid->allowMultirowOperations($multirow_option);
 $multirow_operations = array(
    "delete"  => array("view"=>false),
    "details" => array("view"=>false),
	"edit" => array("view"=>true)
 );
 $dgrid->setMultirowOperations($multirow_operations); 

$http_get_vars = array("id","nodeidtree","padre","ano");
$dgrid->SetHttpGetVars($http_get_vars);

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
  
 $css_class = "x-gray";
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
  $vm_table_properties = array("width"=>"90%","sortable"=>false);
		$dgrid->SetViewModeTableProperties($vm_table_properties); 
		
  if ($_REQUEST['padre']==0){
 	$vm_colimns = array(
	"nombre"  =>array("header"=>"ELEMENTO","header_align"=>"center","type"=>"label", "width"=>"90%", "align"=>"center",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
	//"eliminar"  =>array("header"=>"ELIMINAR","header_align"=>"center","type"=>"label", "width"=>"10%", "align"=>"center",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal")
  );
  }else{
   $vm_colimns = array(
  	"nombre"  =>array("header"=>"ELEMENTO","header_align"=>"center","type"=>"label", "width"=>"90%", "align"=>"center",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
	"valor_usuario"  =>array("header"=>"VALOR","header_align"=>"center","type"=>"label", "width"=>"90%", "align"=>"center",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
	"etiqueta"  =>array("header"=>"ATRIBUTO","header_align"=>"center","type"=>"link", "width"=>"10%", "align"=>"center",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal", "visible"=>"true", "on_js_event"=>"","field_key"=>"id_maestro",  
	"field_data"=>"etiqueta", "rel"=>"", "title"=>"", "target"=>"atributos", "href"=>"atributos.php?id={0}")
	
	
	);
  }
  $dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
 
//*****ARREGLO PARA CAMPO tipo_arbol ******//
	$tema_array_sql = "SELECT tipo_arbol,id_tipo_arbol FROM tipo_arbol ";
	$especial_array_str = crearArregloDataGrid($tema_array_sql,"tipo_arbol_array",g_BaseDatos);
	eval($especial_array_str);		
	//******FIN DE ARREGLO PARA tipo_arbol *****///	
	
	//*****ARREGLO PARA CAMPO responsable ******//
	$tema_array_sql = "SELECT ente_direccion,id_ente_direccion FROM cfg_estructura_organizativa ORDER BY ente_direccion";
	$especial_array_str = crearArregloDataGrid($tema_array_sql,"responsables_array",g_BaseDatos);
	eval($especial_array_str);		
	//******FIN DE ARREGLO PARA responsable *****///	
	
	
	
	$select2="SELECT id_nivel_maestro,esquema FROM maestro WHERE id_maestro=".$_GET['id'];
	$sql2 = $select2;
	$res2=abredatabase(g_BaseDatos,$sql2);
	$row2=dregistro($res2);
	if ($row2['id_nivel_maestro']!=0)
	{
		 $select2="SELECT id_nivel_maestro,esquema FROM maestro WHERE id_maestro=".$row2['id_nivel_maestro'];
		$sql2 = $select2;
		$res2=abredatabase(g_BaseDatos,$sql2);
		$row2=dregistro($res2);
		$esquema=",".$_GET['id'].",".$row2['esquema'];
	}else
	{
		$esquema=",".$_GET['id'].",0,";
	}

if(isset($_REQUEST['f_mode']) && 
		($_REQUEST['f_mode'] == "add"))
{

	
	
	
 $table_name = "maestro";
  $primary_key = "id_maestro";
  $condition = "maestro.id_maestro=".$_GET['f_rid'];
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $dgrid->setAutoColumnsInEditMode(false);
   $em_columns = array(
 
	"id_tipo_arbol" =>array("header"=>"Tipo",  "type"=>"enum",     "source"=>$tipo_arbol_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>""),
	   "valor_usuario" =>array("header"=>"Valor del Usuario", "type"=>"textbox", "width"=>"40px", "req_type"=>"nty", "title"=>"", "unique"=>false),
	"nombre" =>array("header"=>"Nombre", "type"=>"textarea", "width"=>"410px", "rows"=>"2", "cols"=>"150", "req_type"=>"sy", "title"=>"Nombre del Elemento", "unique"=>false),
	"descripcion" =>array("header"=>"Descripción", "type"=>"textarea", "width"=>"410px", "rows"=>"2", "cols"=>"150", "req_type"=>"sy", "title"=>"Descripción del Elemento", "unique"=>false),
	"etiqueta" =>array("header"=>"etiqueta", "type"=>"textbox", "width"=>"100%", "req_type"=>"sty", "title"=>"", "unique"=>false),
	
	
	"id_estatus" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>"1", "visible"=>"false", "unique"=>false),
	"id_nivel_maestro" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$_GET['id'], "visible"=>"false", "unique"=>false),
	"esquema" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$esquema, "visible"=>"false", "unique"=>false),
												
												
  );
$dgrid->setColumnsInEditMode($em_columns);
   }	
   else {
   $estatus_array = array(""=>"-Seleccione-","1"=>"Activo", "0"=>"Inactivo");
	    $table_name = "maestro";
  $primary_key = "id_maestro";
  $condition = "maestro.id_maestro=".$_GET['id'];
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $dgrid->setAutoColumnsInEditMode(false);
   $em_columns = array(
   
   
	"id_tipo_arbol" =>array("header"=>"Tipo",  "type"=>"enum",     "source"=>$tipo_arbol_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>""),
	"valor_usuario" =>array("header"=>"Valor del Usuario", "type"=>"textbox", "width"=>"40px", "req_type"=>"nty", "title"=>"", "unique"=>false),
	"nombre" =>array("header"=>"Nombre", "type"=>"textarea", "width"=>"410px", "rows"=>"5", "cols"=>"150", "req_type"=>"sy", "title"=>"Nombre del Elemento", "unique"=>false),
	"descripcion" =>array("header"=>"Descripción", "type"=>"textarea", "width"=>"410px", "rows"=>"5", "cols"=>"150", "req_type"=>"sy", "title"=>"Descripción del Elemento", "unique"=>false),
	"valor" =>array("header"=>"Valor del Elemento", "type"=>"textbox", "width"=>"80px", "req_type"=>"sty", "title"=>"", "unique"=>false),
	"imagen_archivo"  =>array("header"=>"Imagen", "type"=>"image",      "req_type"=>"st", "width"=>"210px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "target_path"=>"assets/images/", "allow_image_updating"=>"false", "max_file_size"=>"2M", "image_width"=>"128px", "image_height"=>"128px", "resize_image"=>"true", "resize_width"=>"128px", "resize_height"=>"128px", "magnify"=>"false", "magnify_type"=>"lightbox", "magnify_power"=>"2", "file_name"=>"", "host"=>"local", "allow_downloading"=>"false", "allowed_extensions"=>""),
	"etiqueta" =>array("header"=>"etiqueta", "type"=>"textbox", "width"=>"100%", "req_type"=>"sty", "title"=>"", "unique"=>false),
	"esquema" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$esquema, "visible"=>"false", "unique"=>false),
	"id_estatus" =>array("header"=>"Estatus",  "type"=>"enum",  "default"=>"1",  "source"=>$estatus_array, "view_type"=>"dropdownlist",  "width"=>"20px", "req_type"=>"rt", "title"=>"")
												
												
  );
	$dgrid->setColumnsInEditMode($em_columns);   
   }
   

  
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








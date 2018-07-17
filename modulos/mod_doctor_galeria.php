<?php require_once('common.php'); checkUser(); ?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="../lib/css/bootstrap.min.css">
	<link href="../lib/css/font-awesome.css" rel="stylesheet">
	<script src="../lib/ckeditor/ckeditor.js"></script>

<head>

<body>
<div class="container-fluid">
<!-- Start menu section -->
  <?php include_once ('cfg_encabezado.php'); ?>
  <!-- End menu section -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc">
		<h3><i class="fa fa-edit"></i> Galeria de Fotos</h3>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="color:#ccc; margin-top:-20px">
		<hr>
	</div>
	<div id="contenedor" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
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
  $sql="SELECT "
   ."id_galeria, tx_categoria, "
   ."tx_descripcion, to_char(fecha_actualizada,'DD/MM/YYYY') AS fecha, tx_foto, "
   ."CASE WHEN id_estatus=1 THEN 'Abierto' WHEN id_estatus=2 THEN 'Cerrado' END AS estatus, tx_foto "
   
   ." FROM tbl_galeria";

   
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "id_galeria";
//  $default_order_field = "direccion,primer_apellido";
  $default_order_type = "DESC";
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
     
 "Descripción"  =>array("table"=>"tbl_galeria", "field"=>"tx_descripcion", "source"=>"self","operator"=>true, "default_operator"=>"=", "type"=>"textbox", "autocomplete"=>true, "case_sensitive"=>true,  "comparison_type"=>"string")
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
	"tx_foto"=>array("header"=>"Foto", "type"=>"image",      "align"=>"left", "width"=>"10%", "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>"false", "sort_type"=>"string", "sort_by"=>"", "visible"=>"true", "on_js_event"=>"", "target_path"=>"../img/galeria/", "default"=>"", "image_width"=>"50px", "image_height"=>"30px", "linkto"=>"", "magnify"=>"true", "magnify_type"=>"lightbox", "magnify_power"=>"2"),
	"tx_categoria"  =>array("header"=>"Categoria",      "type"=>"label", "width"=>"10%", "align"=>"left",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
	"tx_descripcion"  =>array("header"=>"Descripción",      "type"=>"label", "width"=>"60%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
	"fecha"  =>array("header"=>"Fecha",      "type"=>"label", "width"=>"10%", "align"=>"center",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
	"estatus"  =>array("header"=>"Estatus",      "type"=>"label", "width"=>"10%", "align"=>"center",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal")
  );
  $dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
  
  date_default_timezone_set('America/Caracas');
  $fecha=date('Y-m-d H:i:s');
   $estatus_array = array(""=>"-Seleccione-","1"=>"Abierto", "2"=>"Cerrado");
    $categoria_array = array(""=>"-Seleccione-","RINOPLASTIA"=>"RINOPLASTIA", "CIRUJIA_RECONSTRUCTIVA"=>"CIRUJIA RECONSTRUCTIVA", "MAMOPLASTIA"=>"MAMOPLASTIA", "OTRAS"=>"OTRAS");
  $table_name = "tbl_galeria";
  $primary_key = "id_galeria";
  $condition = "";
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $dgrid->setAutoColumnsInEditMode(false);
   $em_columns = array(
   "tx_foto"  =>array("header"=>"Imagen", "type"=>"image",      "req_type"=>"st", "width"=>"210px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "target_path"=>"../img/galeria/", "allow_image_updating"=>"true", "max_file_size"=>"2M",  "resize_image"=>"false", "resize_width"=>"128px", "resize_height"=>"128px", "magnify"=>"true", "magnify_type"=>"lightbox", "magnify_power"=>"2", "file_name"=>"", "host"=>"local", "allow_downloading"=>"false", "allowed_extensions"=>""),
	"tx_categoria" =>array(
												"header"=>"Categoria",
												"type"=>"enum",     
												"source"=>$categoria_array, 
												"view_type"=>"dropdownlist",  
												"width"=>"139px", 
												"req_type"=>"sty", 
												"title"=>""
												),
	"tx_descripcion" =>array("header"=>"Descripción", "type"=>"textarea", "width"=>"100%", "rows"=>"6", "req_type"=>"ry", "title"=>"", "maxlength"=>"140",  "unique"=>false),
	"id_estatus" =>array(
												"header"=>"Estatus",
												"type"=>"enum",     
												"source"=>$estatus_array, 
												"view_type"=>"dropdownlist",  
												"width"=>"139px", 
												"req_type"=>"rn", 
												"title"=>"estatus",
												"default"=>"1"
												),
										
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

<!-- Include jQuery. -->
  

<script>
$('.ayuda').click(function() {
			alert("Modulo de publicaciones");
		});
</script>
 <!-- Initialize the editor. -->
 <?php if ($_POST['f_mode']=='edit'){ ?>
  <script>
     
	  CKEDITOR.replace( 'ryytx_descripcion', {
			// Define the toolbar groups as it is a more accessible solution.
		toolbarGroups: [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'about', groups: [ 'Image' ] }
	],

	removeButtons: 'Superscript,PasteFromWord,PasteText,Redo,Undo,Link,Unlink,Anchor,WidgetbootstrapAlert,WidgetbootstrapThreeCol,WidgetbootstrapTwoCol,Glyphicons,WidgetbootstrapLeftCol,WidgetbootstrapRightCol,SpecialChar,Youtube,Source,Strike,Subscript,Outdent,Indent,Blockquote,Styles,Format,About,Paste,Copy,Cut,Scayt,AutoCorrect,HorizontalRule,RemoveFormat,NumberedList,BulletedList'
		} );
	
	
  </script>
 <?php } ?>
</body>
</html>







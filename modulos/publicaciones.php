<?php require_once('common.php'); checkUser(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <!-- Include Font Awesome. -->
  	<link href="fonts/css/font-awesome.css" rel="stylesheet">

  
<head>

<body>
<div class="container">
<div class="row"  style=" width:100%; font-size:18px; color:#888; margin-top:10px; padding-top:5px" >
		<img src="../img/sistema/modulo.png" style="margin-top:-10px"> Publicaciones <img class="ayuda" src="../img/botones/ayuda.png" title="Ayuda al Usuario" style="margin-left:8px; margin-top:-2px" />
</div>
<div class="row" style="margin-top:10px">
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
   ."id_publicacion, "
   ."titulo, "
   ."CASE WHEN estatus=1 THEN 'Abierto' WHEN estatus=2 THEN 'Cerrado' END AS estatus "
   
   ." FROM publicaciones";

   
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "id_publicacion";
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
     
 "Titulo "  =>array("table"=>"publicaciones", "field"=>"titulo", "source"=>"self","operator"=>true, "default_operator"=>"=", "type"=>"textbox", "autocomplete"=>true, "case_sensitive"=>true,  "comparison_type"=>"string")
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
	"id_publicacion"  =>array("header"=>"ID",      "type"=>"label", "width"=>"10%", "align"=>"center",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
	"titulo"  =>array("header"=>"Titulo",      "type"=>"label", "width"=>"70%", "align"=>"center",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
	"estatus"  =>array("header"=>"Estatus",      "type"=>"label", "width"=>"20%", "align"=>"center",    "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal")
  );
  $dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
  
  date_default_timezone_set('America/Caracas');
  $fecha=date('Y-m-d H:i:s');
   $estatus_array = array(""=>"-Seleccione-","1"=>"Abierto", "2"=>"Cerrado");
    $evalua_array = array(""=>"-Seleccione-","1"=>"Si", "0"=>"No");
  $table_name = "publicaciones";
  $primary_key = "id_publicacion";
  $condition = "";
  $dgrid->setTableEdit($table_name, $primary_key, $condition);
  $dgrid->setAutoColumnsInEditMode(false);
   $em_columns = array(
    "titulo" =>array("header"=>"Titulo", "type"=>"textbox", "width"=>"100%", "req_type"=>"ry", "title"=>"", "unique"=>false),
	"descripcion" =>array("header"=>"descripcion", "type"=>"textarea", "width"=>"100%", "rows"=>"20", "req_type"=>"ry", "title"=>"", "unique"=>false),
	"estatus" =>array(
												"header"=>"Estatus",
												"type"=>"enum",     
												"source"=>$estatus_array, 
												"view_type"=>"dropdownlist",  
												"width"=>"139px", 
												"req_type"=>"rn", 
												"title"=>"estatus",
												"default"=>"1"
												),
	 "etiquetas" =>array("header"=>"Tags", "type"=>"textbox", "width"=>"100%", "req_type"=>"sy", "title"=>"", "unique"=>false),
												
	"fecha_creacion" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$fecha, "visible"=>"false", "unique"=>false),
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
<script>
$('.ayuda').click(function() {
			alert("Modulo de publicaciones");
		});
</script>
<!-- Include jQuery. -->
  <script type="text/javascript" src="js/jquery.min1.11.2.js"></script>

  <!-- Include JS files. -->
  <script type="text/javascript" src="js/froala_editor.min.js"></script>

  <!-- Include Code Mirror. -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>

  <!-- Include Plugins. -->
  <script type="text/javascript" src="js/plugins/align.min.js"></script>
  <script type="text/javascript" src="js/plugins/char_counter.min.js"></script>
  <script type="text/javascript" src="js/plugins/code_beautifier.min.js"></script>
  <script type="text/javascript" src="js/plugins/code_view.min.js"></script>
  <script type="text/javascript" src="js/plugins/colors.min.js"></script>
  <script type="text/javascript" src="js/plugins/emoticons.min.js"></script>
  <script type="text/javascript" src="js/plugins/entities.min.js"></script>
  <script type="text/javascript" src="js/plugins/file.min.js"></script>
  <script type="text/javascript" src="js/plugins/font_family.min.js"></script>
  <script type="text/javascript" src="js/plugins/font_size.min.js"></script>
  <script type="text/javascript" src="js/plugins/fullscreen.min.js"></script>
  <script type="text/javascript" src="js/plugins/image.min.js"></script>
  <script type="text/javascript" src="js/plugins/image_manager.min.js"></script>
  <script type="text/javascript" src="js/plugins/inline_style.min.js"></script>
  <script type="text/javascript" src="js/plugins/line_breaker.min.js"></script>
  <script type="text/javascript" src="js/plugins/link.min.js"></script>
  <script type="text/javascript" src="js/plugins/lists.min.js"></script>
  <script type="text/javascript" src="js/plugins/paragraph_format.min.js"></script>
  <script type="text/javascript" src="js/plugins/paragraph_style.min.js"></script>
  <script type="text/javascript" src="js/plugins/quick_insert.min.js"></script>
  <script type="text/javascript" src="js/plugins/quote.min.js"></script>
  <script type="text/javascript" src="js/plugins/table.min.js"></script>
  <script type="text/javascript" src="js/plugins/save.min.js"></script>
  <script type="text/javascript" src="js/plugins/url.min.js"></script>
  <script type="text/javascript" src="js/plugins/video.min.js"></script>

  <!-- Include Language file if we want to use it. -->
  <script type="text/javascript" src="js/languages/ro.js"></script>

  <!-- Initialize the editor. -->
  <script>
     
	  
	 $(function() {
    $('#ryydescripcion').froalaEditor({
      // Set the image upload URL.
      imageUploadURL: 'upload_imagen.php',
	  	  
      imageUploadParams: {
        id: 'my_editor'
      },
	   fileUploadURL: 'upload_file.php',
	  fileUploadParams: {
        id: 'my_editor'
      }
    })
  });
  </script>
</body>
</html>







<!DOCTYPE html>
<?php require_once('common.php'); checkUser(); //chequeo de usuario entrante 

	
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../lib/css/bootstrap.min.css" >
	<link href="../lib/css/font-awesome.css" rel="stylesheet">
	<script src="../lib/ckeditor/ckeditor.js"></script>
</head>
<body>

<div class="container-fluid">
<?php include('cfg_encabezado.php');

//selecciona los modulos segun el tipo de usuario y asignaciones
	$sql="SELECT tx_documento, (tx_nombres_apellidos) as nombre, CASE WHEN nu_sexo=12 THEN 'Femenino' ELSE 'Masculino' END AS nu_sexo, tx_foto, to_char(fe_actualizacion,'DD  Mon YYYY') as fecha_actualizacion, to_char(now()-fe_nacimiento, 'yy')  as fe_nacimiento, fe_nacimiento as fecha_nacimiento, tx_ocupacion, (SELECT tx_nombre FROM cfg_configuracion_general WHERE id_configuracion=a.n_pais) AS pais, tx_provincia, tx_direccion, tx_telefono, tx_otro_telefono, tx_correo, CASE WHEN n_pais=14 THEN 'V' ELSE 'E' END AS nacionalidad, (SELECT tx_nombre FROM cfg_configuracion_general WHERE id_configuracion=a.id_tipo_documento) AS tipo_documento   FROM tbl_paciente a WHERE id_paciente=".$_GET['id']." and id_estatus=1";
		$res=abredatabase(g_BaseDatos,$sql);
		$row=dregistro($res);
		$row['nombre'];
		$foto=$row['tx_foto'];
	
	
	if ($foto==""){
		$foto="../img/fotos/img.jpg";	
	}else{
		$foto="uploads/foto_paciente/".trim($foto);
	}
?> 
		
<div class="panel panel-default" style="margin-top:20px">
  <div class="panel-heading" style="font-size:18px; color:#ccc;"><i class="fa fa-file-text-o"></i> Facturas del Cliente</div>
  <div class="panel-body">
	 <?php
			date_default_timezone_set('America/Caracas');
			$datetime1 = new DateTime("now");
			$datetime2 = new DateTime($row['fecha_nacimiento']);
			$interval = date_diff($datetime2, $datetime1);
			$años=$interval->format('%Y');
		  ?>
	
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="color:#CCC" >
	       
			
			<a href="mod_paciente_editar.php?id=<?php echo $_GET['id']; ?>" title="haga click para volver al menu paciente"> <img src="<?php echo $foto; ?>" width="18px" height="20px" " > <label style="color:#37c6f5"> <?php echo $row['nombre']." (".$años." años)"; ?> </label></a>
		
	</div>
	<div align="right" class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="color:#CCC" >
		
			<label style="font-size:10px"> Ultima Actualización: </label> <?php echo $row['fecha_actualizacion']; ?>
		
	</div>
	<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:-10px">
		<hr>
	</div>
	<div align="right"  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<a href="mod_paciente_factura.php?id=<?php echo $_GET['id']; ?>&f_mode=add&f_rid=-1&f_page_size=10&f_p=1"> <button type="button" class="btn btn-info" id="factura"  onclick="">+ Factura</button></a>
	</div>
	
	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px" >
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

  	$sql="SELECT id_factura, tx_documento_factura,to_char(fe_creacion,'DD/MM/YYYY') AS fecha_factura,nu_monto, ('<button class=\"btn btn-danger\" ><i class=\"fa fa-ban\"></i> </button>') as anular, ('<button class=\"btn btn-success\" ><i class=\"fa fa-share\"></i>  </button>') as reenviar, ('<button class=\"btn btn-primary\" ><i class=\"fa fa-print\"></i>  </button>') as imprimir FROM tbl_factura WHERE id_paciente=".$_GET['id'];
  
##  *** set needed options
  $debug_mode = false;
  $messaging = true;
  $unique_prefix = "f_";  
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
##  *** set data source with needed options
  $default_order_field = "id_factura";
//  $default_order_field = "direccion,primer_apellido";
  $default_order_type = "DESC";
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


$direction = "ltr";
$dgrid->SetDirection($direction);

$layouts = array("view"=>"0", "edit"=>"1", "filter"=>"1"); 
$dgrid->SetLayouts($layouts);

$view_mode_template = array("header"=>"", "body"=>"", "footer"=>"");
$edit_mode_template = array("header"=>"", "body"=>"", "footer"=>"");
$details_template = array("header"=>"", "body"=>"", "footer"=>"");

$view_mode_template["body"]  = '
<table>
<tr>
<td>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<label>Tipo de Diagnóstico</label>
		{tx_descripcion}
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<label>Breve Descripción</label>
		{fecha_diagnostico}
	</div>

</td>
</tr>
</table>
';
	
$edit_mode_template["body"]  = '
<table><tr><td>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<label>Tipo de Diagnóstico</label>
	{n_tipo_diagnostico}
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<label>Breve Descripción</label>
	{tx_descripcion}
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<label>Diagnóstico</label>
	{tx_diagnostico}
</div>
</td></tr></table>
';

$dgrid->SetTemplates($view_mode_template,$edit_mode_template,"");


$modes = array(
  "add" => array("view"=>true, "edit"=>false, "type"=>"image", "show_button"=>true, "show_add_button"=>"inside"),
  "edit" => array("view"=>true, "edit"=>true, "type"=>"image", "show_button"=>true, "byFieldValue"=>""),
  "cancel" => array("view"=>true, "edit"=>true, "type"=>"image", "show_button"=>true),
  "details" => array("view"=>false, "edit"=>false, "type"=>"image", "show_button"=>true),
  "delete" => array("view"=>false, "edit"=>false, "type"=>"image", "show_button"=>true)
);
$dgrid->SetModes($modes);




 $multirow_option = false;
 $dgrid->allowMultirowOperations($multirow_option);
 $multirow_operations = array(
    "delete"  => array("view"=>false),
    "details" => array("view"=>false),
	"edit" => array("view"=>true)
 );
 $dgrid->setMultirowOperations($multirow_operations); 

$http_get_vars = array("id");
$dgrid->SetHttpGetVars($http_get_vars);

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
		"id_factura"  =>array("header"=>"N° de Factura","header_align"=>"center","type"=>"label", "width"=>"5%", "align"=>"center",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		"tx_documento_factura"  =>array("header"=>"Concepto","header_align"=>"center","type"=>"label", "width"=>"55%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		"fecha_factura"  =>array("header"=>"Fecha","header_align"=>"center","type"=>"label", "width"=>"20%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal"),
		"nu_monto"  =>array("header"=>"Monto Bs.","header_align"=>"center","type"=>"money", "sign"=>"Bs.", "decimal_places"=>"2",
		"dec_separator"=>",","thousands_separator"=>".","width"=>"20%", "align"=>"left",    "wrap"=>"wrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>"true"),
		"anular"=>array("header"=>"Anular", "type"=>"link",       
							"align"=>"center", "width"=>"5%", "wrap"=>"wrap", "text_length"=>"-1", "tooltip"=>"true", 
							"tooltip_type"=>"floating", "case"=>"normal", "summarize"=>"false", "sort_type"=>"numeric", "sort_by"=>"", 
							"visible"=>"true", "on_js_event"=>"", "field_key"=>"id_cita",  
							"field_data"=>"anular", "rel"=>"", "title"=>"Anular Cita", "target"=>"", "href"=>"javascript:abrir_grupo({0});"),
		"reenviar"=>array("header"=>"Reenviar", "type"=>"link", 			
							"align"=>"center", "width"=>"5%", "wrap"=>"wrap", "text_length"=>"-1", "tooltip"=>"true", 
							"tooltip_type"=>"floating", "case"=>"normal", "summarize"=>"false", "sort_type"=>"numeric", "sort_by"=>"", 
							"visible"=>"true", "on_js_event"=>"", "field_key"=>"id_cita",  
							"field_data"=>"reenviar", "rel"=>"", "title"=>"Anular Cita", "target"=>"", "href"=>"javascript:abrir_grupo({0});"),
		"imprimir"=>array("header"=>"Imprimir", "type"=>"link", 			
							"align"=>"center", "width"=>"5%", "wrap"=>"wrap", "text_length"=>"-1", "tooltip"=>"true", 
							"tooltip_type"=>"floating", "case"=>"normal", "summarize"=>"false", "sort_type"=>"numeric", "sort_by"=>"", 
							"visible"=>"true", "on_js_event"=>"", "field_key"=>"id_cita",  
							"field_data"=>"imprimir", "rel"=>"", "title"=>"Anular Cita", "target"=>"", "href"=>"javascript:abrir_grupo({0});"),
	 );
	$dgrid->setColumnsInViewMode($vm_colimns);
## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        | 
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
 
	//*****ARREGLO PARA CAMPO TIPO estatus******//
	 $tema_array_sql = "SELECT tx_descripcion,id_diagnostico FROM tbl_diagnostico WHERE id_paciente=".$_GET['id'];
	 if (isset($_GET['id_diagnostico'])){
		 $tema_array_sql.=" AND id_diagnostico=".$_GET['id_diagnostico'];
	 }
	 
	$especial_array_str = crearArregloDataGrid2($tema_array_sql,"diagnosticos_array",g_BaseDatos);
	eval($especial_array_str);		
	//******FIN DE ARREGLO******///
	
	$table_name = "tbl_factura";
	$primary_key = "id_factura";
	$condition = "";
	$dgrid->setTableEdit($table_name, $primary_key, $condition);
	$dgrid->setAutoColumnsInEditMode(false);
	$em_columns = array(
		"fe_creacion" =>array("header"=>"Fecha Factura",	"type"=>"datedmy","req_type"=>"rt","width"=>"100px","title"=>"","readonly"=>"false","maxlength"=>"-1","default"=>date('d-m-Y'),"unique"=>"false","unique_condition"=>"","visible"=>"true","on_js_event"=>"", "calendar_type"=>"floating"),
		"id_diagnostico" =>array("header"=>"Diagnostico", "type"=>"enum",  "source"=>$diagnosticos_array, "view_type"=>"dropdownlist", "width"=>"210px", "req_type"=>"sny", "title"=>"", "unique"=>false),
		"tx_documento_factura" =>array("header"=>"Descripción", "type"=>"textbox", "width"=>"100%", "req_type"=>"rty", "title"=>"", "unique"=>false),
		"nu_monto" =>array("header"=>"Monto Bs.", "type"=>"textbox", "width"=>"100%", "req_type"=>"rny", "title"=>"", "unique"=>false),
				
		"id_estatus" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>"7", "visible"=>"false", "unique"=>false),
		"id_usuario" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$_SESSION['id_usuario'], "visible"=>"false", "unique"=>false),
		"id_paciente" =>array("header"=>"",       "type"=>"hidden",    "req_type"=>"st", "default"=>$_GET['id'], "visible"=>"false", "unique"=>false)
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
	</div>
	</div>
	
</div>
<?php cierradatabase(); ?>
 <script src="../lib/js/jquery.min.js"></script>
<script src="../lib/js/bootstrap.min.js" ></script>
 
<body>
<html>
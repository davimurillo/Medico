<?php
    session_start();    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>PHP DataGrid :: Sample #1-2 (code)</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name='keywords' content='php grid, php datagrid, php data grid, datagrid sample, datagrid php, datagrid, grid php, datagrid in php, data grid in php, free php grid, free php datagrid, pear datagrid, datagrid paging' />
    <meta name='description' content='Advanced Power of PHP - using PHP DataGrid Pro for displaying some statistical data' />
    <meta content='Advanced Power of PHP' name='author'></meta>
  </head>

<body>
<?php
    
    $mode = isset($_REQUEST['f_mode']) ? $_REQUEST['f_mode'] : "";
    $rid = isset($_REQUEST['f_rid']) ? $_REQUEST['f_rid'] : "0";
    
    ## +---------------------------------------------------------------------------+
    ## | 1. Creating & Calling:                                                    | 
    ## +---------------------------------------------------------------------------+
    ##  *** define a relative (virtual) path to datagrid.class.php file
    ##  *** (relatively to the current file)
    ##  *** RELATIVE PATH ONLY ***     
      define ("DATAGRID_DIR", "../");                     /* Ex.: "datagrid/" */ 
      define ("PEAR_DIR", "../pear/");                    /* Ex.: "datagrid/pear/" */
    
      require_once(DATAGRID_DIR.'datagrid.class.php');
      require_once(PEAR_DIR.'PEAR.php');
      require_once(PEAR_DIR.'DB.php');
    ##
    ##  *** creating variables that we need for database connection       

      // includes database connection parameters
      include_once('install/config.inc.php');
      
      //$DB_USER='username';            
      //$DB_PASS='password';           
      //$DB_HOST='localhost';       
      //$DB_NAME='database_name';    
    
      ob_start();
    ##  *** (example of ODBC connection string)
    ##  *** $result_conn = $db_conn->connect(DB::parseDSN('odbc://root:12345@test_db'));
    ##  *** (example of Oracle connection string)
    ##  *** $result_conn = $db_conn->connect(DB::parseDSN('oci8://root:12345@localhost:1521/mydatabase)); 
    ##  *** (example of PostgreSQL connection string)
    ##  *** $result_conn = $db_conn->connect(DB::parseDSN('pgsql://root:12345@localhost/mydatabase)); 
    ##  === (Examples of connections to other db types see in "docs/pear/" folder)
    
      $db_conn = DB::factory('mysql');  /* don't forget to change on appropriate db type */
      $result_conn = $db_conn->connect(DB::parseDSN('mysql://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));
      if(DB::isError($result_conn)){ die($result_conn->getDebugInfo()); }  
    ##  *** put a primary key on the first place 
      $sql=" SELECT "
       ."demo_countries.id, "
       ."demo_countries.region_id, "
       ."demo_regions.name as region_name, "
       ."demo_countries.name as country_name, "
       ."demo_countries.description, "
       ."demo_countries.picture_url, "
       ."demo_countries.independent_date, "
       ."FORMAT(demo_countries.population, 0) as population, "   
       ."(SELECT COUNT(demo_presidents.id) FROM demo_presidents WHERE demo_presidents.country_id = demo_countries.id) as presidents, "
       ." CASE WHEN demo_countries.is_democracy = 1 THEN 'Yes' ELSE 'No' END as is_democracy "
       ."FROM demo_countries INNER JOIN demo_regions ON demo_countries.region_id=demo_regions.id ";
    ##  *** set needed options and create a new class instance 
      $debug_mode = false;        /* display SQL statements while processing */    
      $messaging = true;          /* display system messages on a screen */ 
      $unique_prefix = "f_";    /* prevent overlays - must be started with a letter */
      $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
    ##  *** set data source with needed options
      $default_order_field = "id";
      $default_order_type = "DESC";
      $dgrid->DataSource($db_conn, $sql, $default_order_field, $default_order_type);	    
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 2. General Settings:                                                      | 
    ## +---------------------------------------------------------------------------+
    ## +-- PostBack Submission Method ---------------------------------------------+
    ##  *** defines postback submission method for DataGrid: AJAX, POST(default) or GET
    /// $postback_method = "post";
    /// $dgrid->SetPostBackMethod($postback_method);
    ## +-- Cache Settings ---------------------------------------------------------+
    ## *** make sure your cache/ dir has 755 (write) permissions
    ## *** define caching parameters: 1st - allow caching or not, 2nd - caching lifetime in minutes
    /// $dgrid->SetCachingParameters(true, 5);
    ## *** delete all caching pages
    /// $dgrid->DeleteCache();
    ##  *** set encoding and collation (default: utf8/utf8_unicode_ci)
     $dg_encoding = "utf8";
     $dg_collation = "utf8_unicode_ci";
     $dgrid->SetEncoding($dg_encoding, $dg_collation);
    ##  *** set interface language (default - English)
    ##  *** (en) - English     (de) - German     (se) Swedish     (hr) - Bosnian/Croatian
    ##  *** (hu) - Hungarian   (es) - Espanol    (ca) - Catala    (fr) - Francais
    ##  *** (nl) - Netherlands/"Vlaams"(Flemish) (it) - Italiano  (pl) - Polish
    ##  *** (ch) - Chinese     (sr) - Serbian
     $dg_language = "en";  
     $dgrid->SetInterfaceLang($dg_language);
    ##  *** set direction: "ltr" or "rtr" (default - "ltr")
     $direction = "ltr";
     $dgrid->SetDirection($direction);
    ##  *** set layouts: 0 - tabular(horizontal) - default, 1 - columnar(vertical) 
     $layouts = array("view"=>0, "edit"=>1, "filter"=>1); 
     $dgrid->SetLayouts($layouts);
    ##  *** set modes for operations ("type" => "link|button|image") 
    ##  *** "byFieldValue"=>"fieldName" - make the field to be a link to edit mode page
     $modes = array(
        "add"	 =>array("view"=>true, "edit"=>false, "type"=>"link"),
        "edit"	 =>array("view"=>true, "edit"=>true,  "type"=>"link", "byFieldValue"=>""),
        "cancel"  =>array("view"=>true, "edit"=>true,  "type"=>"link"),
        "details" =>array("view"=>true, "edit"=>false, "type"=>"link"),
        "delete"  =>array("view"=>true, "edit"=>true,  "type"=>"image")
     );
     $dgrid->SetModes($modes);
    ##  *** allow scrolling on datagrid
    /// $scrolling_option = false;
    /// $dgrid->AllowScrollingSettings($scrolling_option);  
    ##  *** set scrolling settings (optional)
    /// $scrolling_height = "200px";
    /// $dgrid->SetScrollingSettings($scrolling_height);
    ##  *** allow mulirow operations
     $multirow_option = true;
     $dgrid->AllowMultirowOperations($multirow_option);
     $multirow_operations = array(
        "delete"  => array("view"=>true),
        "details" => array("view"=>true)
     );
     $dgrid->SetMultirowOperations($multirow_operations);  
    ##  *** set CSS class for datagrid
    ##  *** "default" or "blue" or "gray" or "green" or your css file relative path with name
     $css_class = "default";
     $dgrid->SetCssClass($css_class);
    ##  *** set variables that used to get access to the page (like: my_page.php?act=34&id=56 etc.) 
    /// $http_get_vars = array("act", "id");
    /// $dgrid->SetHttpGetVars($http_get_vars);
    ##  *** set other datagrid/s unique prefixes (if you use few datagrids on one page)
    ##  *** format (in wich mode to allow processing of another datagrids)
    ##  *** array("unique_prefix"=>array("view"=>true|false, "edit"=>true|false, "details"=>true|false));
     $anotherDatagrids = array("fp_"=>array("view"=>false, "edit"=>true, "details"=>true));
     $dgrid->SetAnotherDatagrids($anotherDatagrids);  
    ##  *** set DataGrid caption
     $dg_caption = '<b>Simple PHP DataGrid - <a href=index.php>Back to Index</a>';
     $dgrid->SetCaption($dg_caption);
    ##
    ## +---------------------------------------------------------------------------+
    ## | 3. Printing & Exporting Settings:                                         | 
    ## +---------------------------------------------------------------------------+
    ##  *** set printing option: true(default) or false 
     $printing_option = true;
     $dgrid->AllowPrinting($printing_option);
    ##  *** set exporting option: true(default) or false 
    /// $exporting_option = true;
    /// $exporting_directory = "export/";               
    /// $export_all = false;
    /// $dgrid->AllowExporting($exporting_option, $exporting_directory, $export_all);
    /// $exporting_types = array("excel"=>"true", "pdf"=>"true", "xml"=>"true");
    /// $dgrid->AllowExportingTypes($exporting_types);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 4. Sorting & Paging Settings:                                             | 
    ## +---------------------------------------------------------------------------+
    ##  *** set sorting option: true(default) or false 
     $sorting_option = true;
     $dgrid->AllowSorting($sorting_option);               
    ##  *** set paging option: true(default) or false 
     $paging_option = true;
     $rows_numeration = false;
     $numeration_sign = "N #";       
     $dgrid->AllowPaging($paging_option, $rows_numeration, $numeration_sign);
    ##  *** set paging settings
     $bottom_paging = array("results"=>true, "results_align"=>"left", "pages"=>true, "pages_align"=>"center", "page_size"=>true, "page_size_align"=>"right");
     $top_paging = array();
     $pages_array = array("10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000");
     $default_page_size = 10;
     $dgrid->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 5. Filter Settings:                                                       | 
    ## +---------------------------------------------------------------------------+
    ##  *** set filtering option: true or false(default)
     $filtering_option = true;
     $dgrid->AllowFiltering($filtering_option);
    ##  *** set aditional filtering settings
      $fill_from_array = array("10000"=>"10000", "250000"=>"250000", "5000000"=>"5000000", "25000000"=>"25000000", "100000000"=>"100000000");
      $filtering_fields = array(
        "Country"     =>array("table"=>"demo_countries", "field"=>"name", "source"=>"self", "operator"=>true, "default_operator"=>"like", "type"=>"textbox", "case_sensitive"=>true,  "comparison_type"=>"string"),
        "Region"      =>array("table"=>"demo_regions",   "field"=>"name", "source"=>"self", "order"=>"DESC", "operator"=>true, "type"=>"dropdownlist", "case_sensitive"=>false,  "comparison_type"=>"binary"),
        "Date"        =>array("table"=>"demo_countries", "field"=>"independent_date", "source"=>"self", "operator"=>true, "type"=>"textbox", "case_sensitive"=>false,  "comparison_type"=>"string"),      
        "Population"  =>array("table"=>"demo_countries", "field"=>"population", "source"=>$fill_from_array, "order"=>"DESC", "operator"=>true, "type"=>"dropdownlist", "case_sensitive"=>false, "comparison_type"=>"numeric")
      );
      $dgrid->SetFieldsFiltering($filtering_fields);
    ##
    ## 
    ## +---------------------------------------------------------------------------+
    ## | 6. View Mode Settings:                                                    | 
    ## +---------------------------------------------------------------------------+
    ##  *** set view mode table properties
    /// $vm_table_properties = array("width"=>"90%");
    /// $dgrid->SetViewModeTableProperties($vm_table_properties);  
    ##  *** set columns in view mode
    ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
    ##  ***      "barchart" : number format in SELECT SQL must be equal with number format in max_value
     $vm_colimns = array(
        "region_name"  =>array("header"=>"Region Name",      "type"=>"label", "width"=>"130px", "align"=>"left",   "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
        "country_name" =>array("header"=>"Country Name",     "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
        "population"   =>array("header"=>"Population",       "type"=>"label", "summarize"=>true, "align"=>"right",  "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
        "presidents"   =>array("header"=>"Presidents",       "type"=>"label", "summarize"=>true, "align"=>"right",  "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
        "description"  =>array("header"=>"Short Description","type"=>"label", "align"=>"left",   "wrap"=>"wrap",   "text_length"=>"30", "case"=>"lower"),
        "picture_url"  =>array("header"=>"Picture",          "type"=>"image", "align"=>"center", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>"", "target_path"=>"uploads/", "default"=>"", "image_width"=>"17px", "image_height"=>"17px"),
      );
      $dgrid->SetColumnsInViewMode($vm_colimns);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 7. Add/Edit/Details Mode Settings:                                        | 
    ## +---------------------------------------------------------------------------+
    ##  *** set add/edit mode table properties
     $em_table_properties = array("width"=>"70%");
     $dgrid->SetEditModeTableProperties($em_table_properties);
    ##  *** set details mode table properties
     $dm_table_properties = array("width"=>"70%");
     $dgrid->SetDetailsModeTableProperties($dm_table_properties);
    ##  ***  set settings for add/edit/details modes
      $table_name  = "demo_countries";
      $primary_key = "id";
      $condition   = "";
      $dgrid->SetTableEdit($table_name, $primary_key, $condition);
    ##  *** set columns in edit mode
    ##  *** first letter: r - required, s - simple (not required)
    ##  *** second letter: t - text(including datetime), n - numeric, a - alphanumeric, e - email, f - float, y - any, l - login name, z - zipcode, p - password, i - integer, v - verified
    ##  *** third letter (optional): 
    ##          for numbers: s - signed, u - unsigned, p - positive, n - negative
    ##          for strings: u - upper,  l - lower,    n - normal,   y - any
    ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
    ##  *** Ex.: type = textbox|textarea|label|date(yyyy-mm-dd)|datedmy(dd-mm-yyyy)|datetime(yyyy-mm-dd hh:mm:ss)|datetimedmy(dd-mm-yyyy hh:mm:ss)|image|password|enum|print|checkbox
    ##  *** make sure your WYSIWYG dir has 755 permissions
      $fill_from_array = array("10000"=>"10000", "250000"=>"250000", "5000000"=>"5000000", "25000000"=>"25000000", "100000000"=>"100000000");
      $em_columns = array(
        "region_id"        =>array("header"=>"Region",           "type"=>"textbox",  "width"=>"210px", "req_type"=>"rt", "title"=>"Region Name"),
        "name"             =>array("header"=>"Country",          "type"=>"textbox",  "width"=>"210px", "req_type"=>"ry", "title"=>"Country Name", "unique"=>true),
        "description"      =>array("header"=>"Short Descr.",     "type"=>"textarea", "width"=>"210px", "req_type"=>"rt", "title"=>"Short Description", "edit_type"=>"wysiwyg", "rows"=>"7", "cols"=>"50"),
        "population"       =>array("header"=>"Peoples",          "type"=>"enum",     "source"=>$fill_from_array, "view_type"=>"dropdownlist",  "width"=>"139px", "req_type"=>"ri", "title"=>"Population (Peoples)"),
        "picture_url"      =>array("header"=>"Image URL",        "type"=>"image",    "req_type"=>"st", "width"=>"210px", "title"=>"Picture", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "on_js_event"=>"", "target_path"=>"uploads/", "max_file_size"=>"100K", "image_width"=>"100px", "image_height"=>"100px", "file_name"=>"", "host"=>"local"),
        "is_democracy"     =>array("header"=>"Is Democracy",     "type"=>"checkbox", "req_type"=>"sy", "width"=>"210px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "true_value"=>"1", "false_value"=>"0"),        
        "independent_date" =>array("header"=>"Independence Day", "type"=>"date",     "req_type"=>"rt", "width"=>"187px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "calendar_type"=>"floating"),
      );
      $dgrid->SetColumnsInEditMode($em_columns);
    ##  *** set auto-genereted columns in edit mode
    //  $auto_column_in_edit_mode = false;
    //  $dgrid->SetAutoColumnsInEditMode($auto_column_in_edit_mode);
    ##  *** set foreign keys for add/edit/details modes (if there are linked tables)
    ##  *** Ex.: "condition"=>"TableName_1.FieldName > 'a' AND TableName_1.FieldName < 'c'"
    ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
     $foreign_keys = array(
        "region_id"=>array("table"=>"demo_regions", "field_key"=>"id", "field_name"=>"name", "view_type"=>"dropdownlist", "order_by_field"=>"name", "order_type"=>"ASC")
     ); 
     $dgrid->SetForeignKeysEdit($foreign_keys);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 8. Bind the DataGrid:                                                     | 
    ## +---------------------------------------------------------------------------+
    ##  *** bind the DataGrid and draw it on the screen
      $dgrid->Bind();        
      ob_end_flush();
    ##
    ################################################################################   
    
    // if we in EDIT mode of the first datagrid
    if(($mode == "edit") || ($mode == "details")){
        
        
        ## +---------------------------------------------------------------------------+
        ## | 1. Creating & Calling:                                                    | 
        ## +---------------------------------------------------------------------------+
    
          ob_start();
        ##  *** (example of ODBC connection string)
        ##  *** $result_conn = $db_conn->connect(DB::parseDSN('odbc://root:12345@test_db'));
        ##  *** (example of Oracle connection string)
        ##  *** $result_conn = $db_conn->connect(DB::parseDSN('oci8://root:12345@localhost:1521/mydatabase)); 
        ##  *** (example of PostgreSQL connection string)
        ##  *** $result_conn = $db_conn->connect(DB::parseDSN('pgsql://root:12345@localhost/mydatabase)); 
        ##  === (Examples of connections to other db types see in "docs/pear/" folder)
        //  $db_conn = DB::factory('mysql');  /* don't forget to change on appropriate db type */
        //  $result_conn = $db_conn->connect(DB::parseDSN('mysql://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));
        //  if(DB::isError($result_conn)){ die($result_conn->getDebugInfo()); }  
        ##  *** put a primary key on the first place 
          $sql=" SELECT "
           ."demo_presidents.id, "
           ."demo_presidents.country_id, "
           ."demo_presidents.name, "
           ."demo_presidents.birth_date, "
           ."demo_presidents.status "
           ."FROM demo_presidents INNER JOIN demo_countries ON demo_presidents.country_id=demo_countries.id "       
           ."WHERE demo_presidents.country_id = ".$dgrid->rid." ";
        ##  *** set needed options and create a new class instance 
          $debug_mode = false;        /* display SQL statements while processing */    
          $messaging = true;          /* display system messages on a screen */ 
          $unique_prefix = "fp_";    /* prevent overlays - must be started with a letter */
          $dgrid1 = new DataGrid($debug_mode, $messaging, $unique_prefix, DATAGRID_DIR);
        ##  *** set data source with needed options
          $default_order_field = "id";
          $default_order_type = "DESC";
          $dgrid1->DataSource($db_conn, $sql, $default_order_field, $default_order_type);	    
        ##
        ##
        ## +---------------------------------------------------------------------------+
        ## | 2. General Settings:                                                      | 
        ## +---------------------------------------------------------------------------+
        ## +-- PostBack Submission Method ---------------------------------------------+
        ##  *** defines postback submission method for DataGrid: AJAX, POST(default) or GET
        /// $postback_method = "post";
        /// $dgrid1->SetPostBackMethod($postback_method);
        ## +-- Cache Settings ---------------------------------------------------------+
        ## *** make sure your cache/ dir has 755 (write) permissions
        ## *** define caching parameters: 1st - allow caching or not, 2nd - caching lifetime in minutes
        /// $dgrid1->SetCachingParameters(true, 5);
        ## *** delete all caching pages
        /// $dgrid->DeleteCache();
        ##  *** set encoding and collation (default: utf8/utf8_unicode_ci)
         $dg_encoding = "utf8";
         $dg_collation = "utf8_unicode_ci";
         $dgrid1->SetEncoding($dg_encoding, $dg_collation);
        ##  *** set interface language (default - English)
        ##  *** (en) - English     (de) - German     (se) Swedish     (hr) - Bosnian/Croatian
        ##  *** (hu) - Hungarian   (es) - Espanol    (ca) - Catala    (fr) - Francais
        ##  *** (nl) - Netherlands/"Vlaams"(Flemish) (it) - Italiano  (pl) - Polish
        ##  *** (ch) - Chinese     (sr) - Serbian
         $dg_language = "en";  
         $dgrid1->SetInterfaceLang($dg_language);
        ##  *** set direction: "ltr" or "rtr" (default - "ltr")
         $direction = "ltr";
         $dgrid1->SetDirection($direction);
        ##  *** set layouts: 0 - tabular(horizontal) - default, 1 - columnar(vertical) 
         $layouts = array("view"=>0, "edit"=>0, "filter"=>1); 
         $dgrid1->SetLayouts($layouts);
        ##  *** set modes for operations ("type" => "link|button|image") 
        ##  *** "byFieldValue"=>"fieldName" - make the field to be a link to edit mode page
          if($mode == "edit"){    
            $modes = array(
                "add"=>array("view"=>true, "edit"=>false, "type"=>"link"),
                "edit"=>array("view"=>true, "edit"=>true, "type"=>"link", "byFieldValue"=>""),
                "cancel"=>array("view"=>true, "edit"=>true, "type"=>"link"),
                "details"=>array("view"=>false, "edit"=>false, "type"=>"link"),
                "delete"=>array("view"=>true, "edit"=>false, "type"=>"image")
            );
          }else{
            $modes = array(
                "add"=>array("view"=>false, "edit"=>false, "type"=>"link"),
                "edit"=>array("view"=>false, "edit"=>false, "type"=>"link", "byFieldValue"=>""),
                "cancel"=>array("view"=>false, "edit"=>true, "type"=>"link"),
                "details"=>array("view"=>false, "edit"=>false, "type"=>"link"),
                "delete"=>array("view"=>false, "edit"=>false, "type"=>"image")
            );
          }
          $dgrid1->SetModes($modes);
        ##  *** allow scrolling on datagrid
        /// $scrolling_option = false;
        /// $dgrid1->AllowScrollingSettings($scrolling_option);  
        ##  *** set scrolling settings (optional)
        /// $scrolling_width = "90%";
        /// $scrolling_height = "100%";
        /// $dgrid1->SetScrollingSettings($scrolling_width, $scrolling_height);
        ##  *** allow mulirow operations
          $multirow_option = true;
          $dgrid1->AllowMultirowOperations($multirow_option);
         $multirow_operations = array(
           "delete"  => array("view"=>true),
           "details" => array("view"=>true),
         );
         $dgrid1->SetMultirowOperations($multirow_operations);  
        ##  *** set CSS class for datagrid
        ##  *** "default" or "blue" or "gray" or "green" or your css file relative path with name
         $css_class = "default";
         $dgrid1->SetCssClass($css_class);
        ##  *** set variables that used to get access to the page (like: my_page.php?act=34&id=56 etc.) 
        /// $http_get_vars = array("act", "id");
        /// $dgrid1->SetHttpGetVars($http_get_vars);
        ##  *** set other datagrid/s unique prefixes (if you use few datagrids on one page)
        ##  *** format (in wich mode to allow processing of another datagrids)
        ##  *** array("unique_prefix"=>array("view"=>true|false, "edit"=>true|false, "details"=>true|false));
          $anotherDatagrids = array("f_"=>array("view"=>true, "edit"=>true, "details"=>true));
          $dgrid1->SetAnotherDatagrids($anotherDatagrids);  
        ##  *** set DataGrid caption
          $dg_caption = "Presidents";
          $dgrid1->SetCaption($dg_caption);
        ##
        ##
        ## +---------------------------------------------------------------------------+
        ## | 3. Printing & Exporting Settings:                                         | 
        ## +---------------------------------------------------------------------------+
        ##  *** set printing option: true(default) or false 
         $printing_option = false;
         $dgrid1->AllowPrinting($printing_option);
        ##  *** set exporting option: true(default) or false 
         $exporting_option = false;
         $dgrid1->AllowExporting($exporting_option);
        ##
        ##
        ## +---------------------------------------------------------------------------+
        ## | 4. Sorting & Paging Settings:                                             | 
        ## +---------------------------------------------------------------------------+
        ##  *** set sorting option: true(default) or false 
         $sorting_option = true;
         $dgrid1->AllowSorting($sorting_option);               
        ##  *** set paging option: true(default) or false 
         $paging_option = true;
         $rows_numeration = false;
         $numeration_sign = "N #";       
         $dgrid1->AllowPaging($paging_option, $rows_numeration, $numeration_sign);
        ##  *** set paging settings
         $bottom_paging = array("results"=>true, "results_align"=>"left", "pages"=>true, "pages_align"=>"center", "page_size"=>true, "page_size_align"=>"right");
         $top_paging = array();
         $pages_array = array("10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000");
         $default_page_size = 10;
         $dgrid1->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size);
        ##
        ##
        ## +---------------------------------------------------------------------------+
        ## | 5. Filter Settings:                                                       | 
        ## +---------------------------------------------------------------------------+
        ##  *** set filtering option: true or false(default)
         $filtering_option = false;
         $dgrid1->AllowFiltering($filtering_option);
        ##  *** set aditional filtering settings
        /// $fill_from_array = array("0"=>"No", "1"=>"Yes");  /* as "value"=>"option" */
        /// $filtering_fields = array(
        ///     "Caption_1"=>array("table"=>"tableName_1", "field"=>"fieldName_1", "source"=>"self"|$fill_from_array, "operator"=>false|true, "default_operator"=>"=|<|>|like|%like|like%|not like", "order"=>"ASC|DESC" (optional), "type"=>"textbox|dropdownlist", "case_sensitive"=>false|true, "comparison_type"=>"string|numeric|binary"),
        ///     "Caption_2"=>array("table"=>"tableName_2", "field"=>"fieldName_2", "source"=>"self"|$fill_from_array, "operator"=>false|true, "default_operator"=>"=|<|>|like|%like|like%|not like", "order"=>"ASC|DESC" (optional), "type"=>"textbox|dropdownlist", "case_sensitive"=>false|true, "comparison_type"=>"string|numeric|binary"),
        ///     "Caption_3"=>array("table"=>"tableName_3", "field"=>"fieldName_3", "source"=>"self"|$fill_from_array, "operator"=>false|true, "default_operator"=>"=|<|>|like|%like|like%|not like", "order"=>"ASC|DESC" (optional), "type"=>"textbox|dropdownlist", "case_sensitive"=>false|true, "comparison_type"=>"string|numeric|binary")
        /// );
        /// $dgrid1->SetFieldsFiltering($filtering_fields);
        ##
        ## 
        ## +---------------------------------------------------------------------------+
        ## | 6. View Mode Settings:                                                    | 
        ## +---------------------------------------------------------------------------+
        ##  *** set view mode table properties
         $vm_table_properties = array("width"=>"70%");
         $dgrid1->SetViewModeTableProperties($vm_table_properties);  
        ##  *** set columns in view mode
        ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
        ##  ***      "barchart" : number format in SELECT SQL must be equal with number format in max_value
         $vm_colimns = array(
              "name"       =>array("header"=>"Name",        "type"=>"label", "align"=>"left",  "wrap"=>"wrap",   "text_length"=>"20", "case"=>"normal"),
              "birth_date" =>array("header"=>"Birth Date",  "type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
              "status"     =>array("header"=>"Status",      "type"=>"label", "align"=>"center",  "wrap"=>"nowrap", "text_length"=>"30", "case"=>"normal")
         );
         $dgrid1->SetColumnsInViewMode($vm_colimns);
        ##  *** set auto-genereted columns in view mode
        //  $auto_column_in_view_mode = false;
        //  $dgrid1->SetAutoColumnsInViewMode($auto_column_in_view_mode);
        ##
        ##
        ## +---------------------------------------------------------------------------+
        ## | 7. Add/Edit/Details Mode Settings:                                        | 
        ## +---------------------------------------------------------------------------+
        ##  *** set add/edit mode table properties
         $em_table_properties = array("width"=>"70%");
         $dgrid1->SetEditModeTableProperties($em_table_properties);
        ##  *** set details mode table properties
         $dm_table_properties = array("width"=>"70%");
         $dgrid1->SetDetailsModeTableProperties($dm_table_properties);
        ##  ***  set settings for add/edit/details modes
          $table_name  = "demo_presidents";
          $primary_key = "id";
          $condition   = "demo_presidents.country_id = ".$dgrid->rid." ";
          $dgrid1->SetTableEdit($table_name, $primary_key, $condition);
        ##  *** set columns in edit mode
        ##  *** first letter: r - required, s - simple (not required)
        ##  *** second letter: t - text(including datetime), n - numeric, a - alphanumeric, e - email, f - float, y - any, l - login name, z - zipcode, p - password, i - integer, v - verified
        ##  *** third letter (optional): 
        ##          for numbers: s - signed, u - unsigned, p - positive, n - negative
        ##          for strings: u - upper,  l - lower,    n - normal,   y - any
        ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
        ##  *** Ex.: type = textbox|textarea|label|date(yyyy-mm-dd)|datedmy(dd-mm-yyyy)|datetime(yyyy-mm-dd hh:mm:ss)|datetimedmy(dd-mm-yyyy hh:mm:ss)|image|password|enum|print|checkbox
        ##  *** make sure your WYSIWYG dir has 777 permissions
        /// $fill_from_array = array("0"=>"No", "1"=>"Yes", "2"=>"Don't know", "3"=>"My be"); /* as "value"=>"option" */
         $em_columns = array(
            "country_id"  =>array("header"=>"Country",   "type"=>"foreign_key","req_type"=>"ri", "width"=>"210px", "title"=>"", "readonly"=>"false", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true"),
            "name"       =>array("header"=>"Name",       "type"=>"textbox",  "width"=>"140px", "req_type"=>"rt", "title"=>"Name"),
            "birth_date"  =>array("header"=>"Birth Date", "type"=>"date",     "req_type"=>"rt", "width"=>"80px", "title"=>"", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "calendar_type"=>"floating"),
            "status"     =>array("header"=>"Status",     "type"=>"enum",     "req_type"=>"st", "width"=>"210px", "title"=>"Status", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "on_js_event"=>"", "source"=>"self", "view_type"=>"dropdownlist")
         );
         $dgrid1->SetColumnsInEditMode($em_columns);
        ##  *** set auto-genereted columns in edit mode
        //  $auto_column_in_edit_mode = false;
        //  $dgrid1->SetAutoColumnsInEditMode($auto_column_in_edit_mode);
        ##  *** set foreign keys for add/edit/details modes (if there are linked tables)
        ##  *** Ex.: "condition"=>"TableName_1.FieldName > 'a' AND TableName_1.FieldName < 'c'"
        ##  *** Ex.: "on_js_event"=>"onclick='alert(\"Yes!!!\");'"
         $foreign_keys = array(
            "country_id"=>array("table"=>"demo_countries", "field_key"=>"id", "field_name"=>"name", "view_type"=>"dropdownlist", "radiobuttons_alignment"=>"horizontal|vertical", "condition"=>"id=".$rid, "order_by_field"=>"name", "order_type"=>"ASC|DESC", "on_js_event"=>""),      
            // "ForeignKey_1"=>array("table"=>"TableName_1", "field_key"=>"FieldKey_1", "field_name"=>"FieldName_1", "view_type"=>"dropdownlist(default)|radiobutton|textbox|label", "radiobuttons_alignment"=>"horizontal|vertical", "condition"=>"", "order_by_field"=>"", "order_type"=>"ASC|DESC", "on_js_event"=>""),      
         ); 
         $dgrid1->SetForeignKeysEdit($foreign_keys);
        ##
        ##
        ## +---------------------------------------------------------------------------+
        ## | 8. Bind the DataGrid:                                                     | 
        ## +---------------------------------------------------------------------------+
        ##  *** bind the DataGrid and draw it on the screen
          $dgrid1->Bind();        
          ob_end_flush();
        ##
        ################################################################################   
    }
?>  

</body>
</html>
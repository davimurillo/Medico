<?php require_once('common.php'); 

$error = '0';

if (isset($_POST['envio'])){
	// Get user input
	$username = isset($_POST['correo']) ? $_POST['correo'] : '';
	$password = isset($_POST['clave']) ? $_POST['clave'] : '';
	
        
	// Try to login the user

	$error = loginUser($username,$password);
}

?>

	<?php 
	function hasAccess($username,$result){
    	
	$indicesServer = array('PHP_SELF',
		'argv',
		'argc',
		'GATEWAY_INTERFACE',
		'SERVER_ADDR',
		'SERVER_NAME',
		'SERVER_SOFTWARE',
		'SERVER_PROTOCOL',
		'REQUEST_METHOD',
		'REQUEST_TIME',
		'REQUEST_TIME_FLOAT',
		'QUERY_STRING',
		'DOCUMENT_ROOT',
		'HTTP_ACCEPT',
		'HTTP_ACCEPT_CHARSET',
		'HTTP_ACCEPT_ENCODING',
		'HTTP_ACCEPT_LANGUAGE',
		'HTTP_CONNECTION',
		'HTTP_HOST',
		'HTTP_REFERER',
		'HTTP_USER_AGENT',
		'HTTPS',
		'REMOTE_ADDR',
		'REMOTE_HOST',
		'REMOTE_PORT',
		'REMOTE_USER',
		'REDIRECT_REMOTE_USER',
		'SCRIPT_FILENAME',
		'SERVER_ADMIN',
		'SERVER_PORT',
		'SERVER_SIGNATURE',
		'PATH_TRANSLATED',
		'SCRIPT_NAME',
		'REQUEST_URI',
		'PHP_AUTH_DIGEST',
		'PHP_AUTH_USER',
		'PHP_AUTH_PW',
		'AUTH_TYPE',
		'PATH_INFO',
		'ORIG_PATH_INFO') ;

$argumentos="";
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        $argumentos.=$arg.' => ' . $_SERVER[$arg] .PHP_EOL;
    }
    else {
        $argumentos.=$arg.PHP_EOL;
    }
}
	date_default_timezone_set('America/Caracas');
    //Write action to txt log
    $log  = "Fecha Acceso:".date("F j, Y, g:i a").PHP_EOL.
            "Attempt: ".($result=='1'?'Success':'Failed').PHP_EOL.
            "User: ".$username.PHP_EOL.
            "-------------------------".PHP_EOL.
			$argumentos.PHP_EOL;
    //-
    file_put_contents('../log/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);

   
	}
	
	
	
	
	if ($error != '') {
			}   
   			 if (isset($_POST['envio'])){ ?>
                <div style="float:left; margin:10px auto auto auto; width:100%; text-align:center">
               
                                  <?php
                                if ($error == '') {
                                    echo "Bienvenido $username! <br/>Tienes Acceso al Sistema!<br/><br/>";
                                    echo "<script>window.location.href='modulos/index.php';</script>";
									hasAccess($username,'1');
                                }
                                else { 
									echo "<label style='color:#FF0000'>".$error."</label>"; 
									hasAccess($username,'0');
								}
                    
                                ?>
                             
                            
                </div>
     	 <?php    }else{
				 echo "<script>window.location.href='../index.php';</script>";
				 hasAccess($username,'0');
		 } ?>
			
	</div>

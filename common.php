<?php
@session_start();
define("lib","");
require_once("lib/config.php");


function loginUser($user,$pass){
	$errorText = '';
	$validUser = false;
	$pwd='';
	$sql="SELECT id_usuario,tx_contrasena,tx_nombre_apellido,id_perfil, to_char(fe_ultimo_acceso, 'DD/MM/YYYY HH:MI:SS a.m.') as ultimo_acceso	
			FROM cfg_usuario
			WHERE tx_email='".$user."' or tx_usuario='".$user."'";		
	$res=abredatabase(g_BaseDatos,$sql);
	while ($row=$rs=dregistro($res))
	{
		$id_usuario=$row['id_usuario'];
		$pwd=$row['tx_contrasena'];
		$nb_usuario=$row['tx_nombre_apellido'];
		$rol=$row['id_perfil'];
		$acceso=$row['ultimo_acceso'];
	}
	cierradatabase();	
   
		if ($pwd!=""){
			if (trim($pwd) == trim(md5($pass)))
			{
					date_default_timezone_set('America/Caracas');
					$timestamp = date('Y-m-d G:i:s');
					$validUser= true;
					$_SESSION['id_usuario']=$id_usuario;
					$_SESSION['userName'] = $user;
					$_SESSION['nombre'] = $nb_usuario;
					$_SESSION['rol'] = $rol;
					$_SESSION['acceso'] = $acceso;
					$sql_registro="UPDATE cfg_usuario SET fe_ultimo_acceso='".$timestamp."' WHERE id_usuario=".$id_usuario."";		
					$res_r=abredatabase(g_BaseDatos,$sql_registro);
					cierradatabase();
				
			}
		}
   // fclose($pfile);
   
    if ($validUser != true) $errorText = "Usuario o Clave invalida";
    
    if ($validUser == true) $_SESSION['validUser'] = true;
    else $_SESSION['validUser'] = false;
	
	return $errorText;	
}

function logoutUser(){
	unset($_SESSION['validUser']);
	unset($_SESSION['userName']);
}

function checkUser(){
	
	if ((!isset($_SESSION['validUser'])) || ($_SESSION['validUser'] != true)){
		echo "<script>window.top.location='login.php';</script>";
	}
}

?>
<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../lib/mail/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "apicesolution@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "apices$$11";

//Set who the message is to be sent from
$mail->setFrom('apicesolution@gmail.com', 'APICES, Simplemente Facil');

//Set an alternative reply-to address
//mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to

if ($_REQUEST['tipo_correo']==1){
	$mail->addAddress($_REQUEST['sento']);
	$mail->Subject = 'Licencias';
	$url="modelos_correos/correo_licencia.php";
	$data=array("licencia_serial"=>$_REQUEST['licencia']);
}
if ($_REQUEST['tipo_correo']==2){
	$mail->addAddress($_REQUEST['sento']);
	$mail->Subject = 'Ticket';
	$url="modelos_correos/correo_tickets.php";
	$data=array("numero_ticket"=>$_REQUEST['numero_ticket'], "fcreado"=>$_REQUEST['fecha'], "pcreado"=>$_REQUEST['prioridad'], "titulo"=>$_REQUEST['titulo'], "autor"=>$_REQUEST['autor'], "pticket"=>$_REQUEST['mensaje_ticket']);
}
//procede del index.html - contactanos 
if ($_REQUEST['tipo_correo']==3){
	$mail->addAddress($_REQUEST['sento']);
	$mail->AddCC('apicesolution@gmail.com');
	$url="modelos_correos/correo_contactanos.php";
	$data=array("mensaje"=>$_REQUEST['mensaje']);
}
$mail->msgHTML(strtr(file_get_contents($url), $data), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'Este es un mensaje del Equipo de APICES';

//Attach an image file
//$mail->addAttachment('../img/logos/logo_apices.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mensaje No Enviado Vuelva a Intentar!";
} else {
    echo "Mensaje Enviado!";
}
?>
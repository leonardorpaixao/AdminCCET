<?php
require_once("../../phpmailer/class.phpmailer.php");
include("../../phpmailer/class.smtp.php");


//Modulo com funções para enviu de emails

//funcão envia mesg com elemetos html
function enviaEmail($destinatario,$assunto,$corpo){

	// Inicia a classe PHPMailer
	  $mail = new PHPMailer();

	  $mail->IsSMTP(); // telling the class to use SMTP
	  $mail->SMTPDebug  = false;// enables SMTP debug information (for testing)
	  // 1 = errors and messages
	  // 2 = messages only
	  $mail->CharSet = 'UTF-8';
	  $mail->SMTPAuth   = true;                  // enable SMTP authentication
	  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	  $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
	  $mail->Username   = "naoresponder@dcomp.ufs.br";  // GMAIL username
	  $mail->Password   = "Gr4nd3sP0d3r3sTr4z3mGr4nd3sR3sp0ns4b1l1d4d3s";            // GMAIL password
	  $mail->SetFrom('naoresponder@dcomp.ufs.br', 'Não Responder DCOMP');
	  $mail->isHTML(true);
	  $mail->Subject    = $assunto;
	  $mail->Body    = $corpo;
	  $mail->AddAddress($destinatario);
	  $enviado = $mail->Send();
	  // Limpa os destinatários e os anexos
	  $mail->ClearAllRecipients();
	  $mail->ClearAttachments();
	  if(!$enviado){

	          		echo "erro nessa :";
	          		echo $mail->ErrorInfo;

	          }
}
  ///






















?>
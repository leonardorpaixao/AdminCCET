<?php
class enviarEmail{
	public static function enviarEmailConfirmacao($nomeUser, $email){
	// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
	require_once("../../phpmailer/class.phpmailer.php");
	require("../../phpmailer/PHPMailerAutoload.php");
	include("../../phpmailer/class.smtp.php");
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
	$mail->Username   = "leonardorpaixao3@gmail.com";  // GMAIL username
	$mail->Password   = "leo152476389";            // GMAIL password
	$mail->SetFrom('leonardorpaixao3@gmail.com', 'Não Responder DCOMP');
	$mail->AltBody    = "Para visualizar esta mensagem é necessario ter um visualizador de e-mail compativel com HTML"; // optional, comment out and test
	//$mail->MsgHTML(file_get_contents('emailSenha.php'));
		$mail->Subject = "Você foi cadastrado no AdminCCET";
		$mail->MsgHTML(
		'<html>
			<head>
				<meta charset="utf-8">
				<title></title>
			</head>
			<body>
				<div class="box">
					<div class="topo">
						<table style="width: 50%;margin-bottom: 10px;" cellpadding="0" cellspacing="0">
						<tr>
							
							<td style="bold"align = "left" style="width: 500px;">
								<strong>
								Universidade Federal de Sergipe - UFS<br>
								Centro de Ciencias Exatas e Tecnologia - CCET
								</strong>
							</td>
						</tr>
						</table>
					</div>
					<div align = "justify">
						
						Olá '.$nomeUser.', você foi cadastrado no sistema <strong>AdminCCET</strong>, nele você poderá efetuar reserva de salas e equipamentos disponíveis neste centro. </br> 
						Acesse sua conta clicando <strong><a href="adminccet.ufs.br"> AQUI</a></strong>. Segue abaixo dados para o primeiro acesso:
						
						<br><br>Login: '.$email.' <b></b> 
						<br>Senha : ccet123456 <b></b> <br><br>
		
						<br><br>
						Atenciosamente,<br>
						Secretaria CCET.<br><br>
						<table class="rodape" cellpadding="0" cellspacing="0">
							<tr>
									Cidade Universitária “Prof. José Aloísio de Campos”<br>
									Av. Marechal Rondon, s/n – Jardim Rosa Elze – São Cristóvão-SE – CEP: 49100-000 <br>
									Telefone: (79) 2105-6678 – Endereço Eletrônico: computacao.ufs.br
							</tr>
						</table>
					</div>
				</div>
			</body>
		</html>');

	$mail->AddAddress($email, $nomeUser);
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	//$enviado = $mail->Send();
	if($mail->send()){
		echo "email enviado com sucesso!";
	}else echo"deu algum erro";
		
	

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
}
}
?>
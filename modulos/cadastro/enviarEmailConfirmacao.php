<?php
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
		$mail->MsgHTML('<html>
			<head>
				<meta charset="utf-8">
				<title></title>
			</head>
			<body>
				<div class="box">
					<div class="topo">
						<table style="width: 50%;margin-bottom: 10px;" cellpadding="0" cellspacing="0">
						<tr>
							<td style="width: 30px;"><img src="forms/dcomp.jpg" width="80" height="80"></td>
							<td style="width: 500px;">
								UNIVERSIDADE FEDERAL DE SERGIPE<br>
								DEPARTAMENTO DE COMPUTAÇÃO
							</td>
						</tr>
						</table>
					</div>
					<div>
						Olá '.$row['nomeUser'].', você foi cadastrado no AdminDCOMP acese sua conta no site admin.dcomp.ufs.br utilizando:
						<br><br>Login: <b></b> <br>Senha : <b></b> <br><br>
		
						Muito obrigado,<br><br>
						Att,<br>
						DCOMP.<br><br>
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

	$mail->AddAddress($row['email'], $row['nomeUser']);
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	//$enviado = $mail->Send();
	if($mail->send()){
		echo "email enviado com sucesso!";
	}else echo"deu algum erro";
		
	

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
<?php
	// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
	require_once("phpmailer/class.phpmailer.php");
	include("phpmailer/class.smtp.php");
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
	$mail->AltBody    = "Para visualizar esta mensagem é necessario ter um visualizador de e-mail compativel com HTML"; // optional, comment out and test
	//$mail->MsgHTML(file_get_contents('emailSenha.php'));
	if(!isset($_GET['login'])){
		$mail->Subject    = "Redefinicao de Senha no AdminDCOMP";
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
						Olá '.$_GET['nome'].', sua nova senha é: <b>'.$_GET['senha'].'</b> <br><br>
						Caso não tenha solicitado, favor nos informar clicando aqui.<br><br>
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
	}else{
		$mail->Subject = "Você foi cadastrado no AdminDCOMP";
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
						Olá '.$_GET['nome'].', você foi cadastrado no AdminDCOMP acesse sua conta no site admin.dcomp.ufs.br utilizando:
						<br><br>Login: <b>'.$_GET['login'].'</b> <br>Senha : <b>'.$_GET['senha'].'</b> <br><br>
						Sua conta te dar direito a logar no site e em qualquer computador do DCOMP com a mesmo login e senha e um e-mail particular '.$_GET['login'].'@dcomp.ufs.br já ativo que pode ser acessado no próprio site.<br><br>
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
	}
	$mail->AddAddress($_GET['email'], $_GET['nome']);
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	$enviado = $mail->Send();
	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
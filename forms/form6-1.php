<?php
	$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	include '../sessao.php';

    $db = Atalhos::getBanco();
    if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
              FROM tbrequerimentos a
              inner join tbusuario b on a.idUser = b.idUser 
              inner join tbafiliacao c on b.idAfiliacao = c.idAfiliacao
              inner join tbmatricula e on b.idUser = e.idUser
              WHERE a.idReq = ?")){
    $query->bind_param('si', $_SESSION['chave'], $id);
    $query->execute(); 
    $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
    $query->fetch();
    $query->close();
    }
    if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbtelefone WHERE idUser = ?")){
    $query->bind_param('si', $_SESSION['chave'], $idUser);
    $query->execute();
    $query->bind_result($numTelefone);
    $query->fetch();
    $query->close();
    }
    $conteudo = explode("/+", $conteudoReq);
    if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($tipoReq == 6)){
		if($statusReq == 'Aprovado')
			$msg = '<b>Recebido pelo Departamento de Computação da Universidade Federal de Sergipe.</b>';
		else
			$msg = '<b>Esse documento ainda está em ANÁLISE e por isso é inválido.</b><br>Acompanhe o status do seu requerimento pelo AdminDCOMP.';
		if($_SESSION['nivel'] == '1')
			$assina = '<table class="principal" style="margin-top: 50px;" cellpadding="0" cellspacing="0"><tr><td style="padding: 0px; border: 0px;"><table class="principal" style="margin-bottom: 0px;"><tr><td style="width: 295px; border: 0px;text-indent: 1.5em;"><label>Em ____/____/______</label></td><td style="width: 400px; border: 0px;text-align:center;">___________________________________________<br>Assinatura do(a) professor(a)</td></tr></table></td></tr></table>';
		else
			$assina = '<table class="principal" style="margin-top: 50px;" cellpadding="0" cellspacing="0"><tr><td style="padding: 0px; border: 0px;"><table class="principal" style="margin-bottom: 0px;"><tr><td style="width: 100%; border: 0px;text-align:center;">'.$msg.'</td></tr></table></td></tr></table>';
		
		$html = '
	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="utf-8">
	<style>
	body{
		margin: 0;
		padding: 0;
		font-size: 15px;
	}
	table{
		border-collapse: collapse;
		display: table;
		padding: 0;
		margin: 0;
	}
	.topo table td{
		padding: 4px;
		border: 0px;
		width: 694px;
		font-size: 12px;
		font-weight: bold;
	}
	.rodape{
		width: 100%;
		font-size: 10px;
		text-align: center;
		margin-top: 360px;
	}
	table td{
		padding: 4px;
		border: 1px solid #000;
		width: 694px;
		vertical-align: text-top;
	}
	table tr{
			padding: 0;
		margin: 0;
	}
	label{
		font-weight: bold;
	}
	.principal{
		width: 694px;
		margin-bottom: 20px;
	}
	.titulo{
		width: 100%;
		text-align: center;
		font-weight: bold;
		text-decoration: underline;
		margin-bottom: 10px;
	}
	</style>
	<title></title>
	</head>
	<body>
		<div class="topo">
			<table style="width: 100%;margin-bottom: 10px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width: 80px;"><img src="ufs.jpg" width="80" height="80"></td>
				<td style="width: 500px;">
					SERVIÇO PÚBLICO FEDERAL<br>
					MINISTÉRIO DA EDUCAÇÃO<br>
					UNIVERSIDADE FEDERAL DE SERGIPE<br>
					CENTRO DE CIÊNCIAS EXATAS E TECNOLOGIA<br>
					DEPARTAMENTO DE COMPUTAÇÃO
				</td>
				<td style="width: 80px;"><img src="dcomp.jpg" width="80" height="80"></td>
			</tr>
			</table>
		</div>
		<table class="principal" style="width: 100%;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width: 100%;text-align: center;font-weight: bold;color: #fff;background-color: #004586;">
					<span style="font-size: 18px;">REQUERIMENTO DE TRABALHO DE CONCLUSÃO DE CURSO</span>
				</td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td><label>Nome: </label>'.$nomeUser.'</td>
			</tr>
			<tr>
				<td><label>Matrícula: </label>'.$matricula.' </td>
			</tr>
			<tr>
				<td><label>Curso: </label>'.$afiliacao.'</td>
			</tr>
			<tr>
				<td><label>Telefone: </label>'.$numTelefone.'</td>
			</tr>
			<tr>
				<td><label>E-mail: </label>'.$email.' </td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td style="border: 0px;text-align: justify;text-indent: 1.5em;">Venho, por meio deste, requerer matrícula na atividade de <b>TRABALHO DE CONCLUSÃO DE CURSO '.$conteudo[0].'</b>, código '.$conteudo[1].', período letivo '.$conteudo[2].', sob orientação do(a) professor(a) '.$conteudo[3].'.</td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td style="height: 100px;text-align: justify;"><label>OBS. (opcional): </label>'.$conteudo[4].'</td>
			</tr>
		</table>
		'.$assina.'

			<table class="rodape" cellpadding="0" cellspacing="0">
				<tr>
					<td style="border: 1px solid #000;">
						Cidade Universitária “Prof. José Aloísio de Campos” – Av. Marechal Rondon, s/n – Jardim Rosa Elze – São Cristóvão-SE – CEP: 49100-000
					</td>
				</tr>
				<tr>
					<td style="border: 0px;">
						Telefone: (79) 2105-6678 – Endereço Eletrônico: computacao.ufs.br
					</td>
				</tr>
			</table>

	</body>
	</html>
	';
	require_once("../dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->set_paper('a4','portrait');
	$dompdf->render();
	$dompdf->stream("requerimento_tcc_DCOMP.pdf", array("Attachment" => 0));
	}else{
		header('Location: ../index.php');
	}
?>
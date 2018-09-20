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
    if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 1)){
	//if($form['tipoReq'] == 1){
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
		margin-top: 167px;
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
				<td style="width: 100%;text-align: center;font-weight: bold;">
					<span style="font-size: 18px;">ATIVIDADES COMPLEMENTARES</span><br>
					(Aproveitamento de Créditos)
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
				<td style="height: 80px;"><label>Programa de estudo ou projeto ao qual está vinculada a atividade: </label>'.$conteudo[0].'</td>
			</tr>
			<tr>
				<td><label>Período de Realização: </label> '.$conteudo[1].' a '.$conteudo[2].'</td>
			</tr>
			<tr>
				<td><label>Carga Horária (h): </label></td>
			</tr>
			<tr>
				<td><label>Número de Créditos (créd.): </label></td>
			</tr>
			<tr>
				<td><label>Avaliação de Frequência (%): </label></td>
			</tr>
			<tr>
				<td><label>Eficiência (%): </label></td>
			</tr>
			<tr>
				<td><label>Professor Coordenador: </label></td>
			</tr>
			</table>
			<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td style="height: 80px;"><label>Observações: </label></td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<label>Assinatura do Presidente do Colegiado do Curso: </label>
					<div style="width:100%;text-align: center;margin-top:30px;">____________________________________________<br>Assinatura com carimbo</div>
				</td>
			</tr>
		</table>

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
	$dompdf->stream("aproveitamento_creditos_DCOMP.pdf", array("Attachment" => 0));
	}else{
		header('Location: ../index.php');
	} 
?>
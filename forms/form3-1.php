<?php
	$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	include '../sessao.php';

    $db = Atalhos::getBanco();
    if ($query = $db->prepare("SELECT idUser, idTemp
              FROM tbRequerimentos a
              WHERE a.idReq = ?")){
    $query->bind_param('i', $id);
    $query->execute(); 
    $query->bind_result($idUser, $idTemp);
    $query->fetch();
    $query->close();
    }
    if($idUser){ //SE FOR UM FORM DE UM ALUNO DO DCOMP
    	if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula
              FROM tbRequerimentos a
              inner join tbUsuario b on a.idUser = b.idUser 
              inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
              inner join tbMatricula e on b.idUser = e.idUser
              WHERE a.idReq = ?")){
		    $query->bind_param('si', $_SESSION['chave'], $id);
		    $query->execute(); 
		    $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula);
		    $query->fetch();
		    $query->close();
	    }
	    if ($query = $db->prepare("SELECT AES_DECRYPT(numTelefone,?) FROM tbTelefone WHERE idUser = ?")){
		    $query->bind_param('si', $_SESSION['chave'], $idUser);
		    $query->execute();
		    $query->bind_result($numTelefone);
		    $query->fetch();
		    $query->close();
	    }
	    $conteudo = explode("/+", $conteudoReq);
    } elseif($idTemp){ // SE FOR UM FORM DE UM ALUNO TEMPORÁRIO
    	if ($query = $db->prepare("SELECT a.conteudoReq, b.nome, AES_DECRYPT(b.email,?), b.curso, a.tipoReq, a.statusReq, b.matricula, AES_DECRYPT(b.telefone,?)
              FROM tbRequerimentos a
              inner join tbTemporarios b on a.idTemp = b.idTemp 
              WHERE a.idReq = ?")){
		    $query->bind_param('ssi', $_SESSION['chave'], $_SESSION['chave'], $id);
		    $query->execute(); 
		    $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq , $statusReq, $matricula, $numTelefone);
		    $query->fetch();
		    $query->close();
	    }
	    $conteudo = explode("/+", $conteudoReq);
		$idUser = 0;
    }

    
    if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq != 'Aprovado') && ($tipoReq == 3)){

		if($statusReq == 'Aprovado')
			$msg = '<b>Recebido pelo Departamento de Computação da Universidade Federal de Sergipe.</b>';
		else
			$msg = '<b>Esse documento ainda está em ANÁLISE e por isso é inválido.</b><br>Acompanhe o status do seu requerimento pelo AdminDCOMP.';
	
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
		margin-top: 256px;
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
				<td style="width: 100%;text-align: center;font-weight: bold;padding: 15px;">
					<span style="font-size: 18px;">REQUERIMENTO DE ABONO DE FALTAS</span>
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
				<td style="border: 0px;text-align: justify;text-indent: 1.5em;">Venho requerer abono de faltas durante o período de '.$conteudo[0].' a '.$conteudo[1].', conforme atestado médico anexo, na(s) seguinte(s) disciplina(s):</td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td style="padding: 0px;">
					<table class="principal" style="margin-bottom: 0px;">
						<tr>
							<td style="width: 495px; border: 0px;border-right: 1px solid #000;"><label>Disciplina: </label>'.$conteudo[2].'</td>
							<td style="width: 190px; border: 0px;"><label>Turma: </label>'.$conteudo[3].'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><label>Professor(a): </label>'.$conteudo[4].'</td>
			</tr>
		</table>

		<table class="principal" style="margin-top: 50px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="padding: 0px; border: 0px;">
					<table class="principal" style="margin-bottom: 0px;">
						<tr>
							<td style="width: 100%; border: 0px;text-align:center;">'.$msg.'</td>
						</tr>
					</table>
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
	$dompdf->stream("abono_faltas_DCOMP.pdf", array("Attachment" => 0));
	}else{
		header('Location: ../index.php');
	} 
?>
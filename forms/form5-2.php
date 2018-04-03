<?php
	$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	include '../sessao.php';

    $db = Atalhos::getBanco();
    if (($query = $db->prepare("SELECT nome, matricula, curso, AES_DECRYPT(telefone, ?), AES_DECRYPT(email, ?), disciplina, codigo, turma, periodo, motivo, status, dataEnvio, motivo2 FROM tbInclusao WHERE idInc = ?")) && $_SESSION['nivel'] == '1'){
    $query->bind_param('ssi', $_SESSION['chave'], $_SESSION['chave'], $id);
    $query->execute(); 
    $query->bind_result($nomeUser, $matricula, $afiliacao, $numTelefone, $email, $disciplina, $codigo, $turma, $periodo, $motivo, $status, $dataEnvio, $motivo2);
    $query->fetch();
    $query->close();


			$msg = '<b>Recebido pelo Departamento de Computação da Universidade Federal de Sergipe.</b>';

	
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
		margin-top: 140px;
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
					<span style="font-size: 18px;">REQUERIMENTO DE INCLUSÃO EM DISCIPLINA</span>
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
				<td style="border: 0px;text-align: justify;text-indent: 1.5em;">Venho, por meio deste, requerer inclusão na disciplina <b>'.$disciplina.'</b>, código <b>'.$codigo.'</b>, turma <b>'.$turma.'</b>, no período letivo <b>'.$periodo.'</b>.</td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td style="height: 100px;text-align: justify;"><label>Motivo (opcional): </label>'.$motivo.'</td>
			</tr>
		</table>
		<table class="principal" style="margin-top: 20px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="padding: 0px; border: 0px;height: 40px;">
					
				</td>
			</tr>
		</table>
		<table class="principal" cellpadding="0" cellspacing="0">
			<tr>
				<td><label>Resultado do Requerimento: </label>'.$status.'</td>
			</tr>
			<tr>
				<td style="height: 100px;text-align: justify;"><label>Motivo (opcional):</label>'.$motivo2.'</td>
			</tr>
		</table>
		<table class="principal" style="margin-top: 30px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="padding: 0px; border: 0px;">
					<table class="principal" style="margin-bottom: 0px;">
						<tr>
							<td style="width: 100%; border: 0px;text-align:center;">'.$msg.'<br>'.date('d/m/Y H:i', $dataEnvio).'</td>
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
	$dompdf->stream("requerimento_inclusao_DCOMP.pdf", array("Attachment" => 0));
	}else{
		header('Location: ../index.php');
	} 
?>
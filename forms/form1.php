<?php
$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	include '../includes/sessao.php';

    $db = Atalhos::getBanco();

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
    if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($statusReq == 'Aprovado') && ($tipoReq == 1)){
$html = '
<style>@page {
     margin: 200px 60px 115px 95px;
     background: url(3.png);

    }</style>
<style>
	div {
		padding:0.2em; 
		text-align:justify; 
	}
	table{
		border-collapse: collapse;
		padding: 0;
		margin: 0 0 20px 0;
		display: table;
	}
	.topo table td{
		padding: 4px;
		border: 0px;
		width: 694px;
		font-weight: bold;
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
	.titulo{
		border: 1px solid transparent;
		background: #004586;
		color: #fff;
		text-align: center;
		font-weight: bold;
	}
	.normal{
		border: 1px solid;
		background: #fff;
	}
</style>
<body style="font-family: Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;">
    <div class="dentro" style="font-size: 12px;">
		<h2 style="text-align: center;">ATIVIDADES COMPLEMENTARES</h2>
		<p style="text-align: center;">(APROVEITAMENTO DE CRÉDITOS)</p>
		<div class="titulo">DADOS DO ALUNO</div>
		<div class="normal"><b>Nome:</b> '.$nomeUser.'</div>
		<div class="normal"><b>Matrícula:</b> '.$matricula.'</div>
		<div class="normal"><b>Curso:</b> '.$afiliacao.'</div>
		<div class="normal"><b>Telefone:</b> '.$numTelefone.'</div>
		<div class="normal"><b>E-mail:</b> '.$email.'</div>
		<br>
		<div class="titulo">INFORMAÇÕES DA ATIVIDADE</div>
		<div class="normal">
			<p><b>Carga horária:</b> ________ (h)</p>
			<p><b>Número de créditos:</b> ________ (créd.)</p>
			<p><b>Atividade Concedida:</b><br>
				Ciência da Computação/Sistemas de Informação:<br>
				( ) COMP0316 – Atividades Complementares (15h)<br>
				( ) COMP0291 – Atividades Complementares (30h)<br>
				( ) COMP0292 – Atividades Complementares (60h)<br>
				( ) COMP0307 – Atividades Complementares (90h)<br>
				( ) COMP0308 – Atividades Complementares (120h)<br>
				Engenharia de Computação:<br>
				( ) COMP0317 – Atividades Complementares (60h)<br>
				( ) COMP0308 – Atividades Complementares (120h)
			</p>
		</div>
		<br>
		<div class="titulo">OBSERVAÇÕES</div>
		<div class="normal"><br><br><br><br></div>

		<p style="text-align: center;">Cidade Universitária “Prof. José Aloísio de Campos”, ________ de ________________________ de __________.</p>
		<p style="text-align: center;margin-top: 50px;">____________________________________________<br>PRESIDENTE DO COLEGIADO</p>
	</div>
';

//==============================================================
//==============================================================
//==============================================================
include("../mpdf/mpdf.php");

$mpdf=new mPDF('','A4');

$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output(); 
}else{
		header('Location: /inicio');
	} 
exit;

//==============================================================
//==============================================================
//==============================================================


?>
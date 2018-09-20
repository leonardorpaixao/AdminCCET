<?php
	$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	include '../includes/sessao.php';

    $db = Atalhos::getBanco();
    if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula, a.justificativaReq
              FROM tbrequerimentos a
              inner join tbusuario b on a.idUser = b.idUser 
              inner join tbafiliacao c on b.idAfiliacao = c.idAfiliacao
              inner join tbmatricula e on b.idUser = e.idUser
              WHERE a.idReq = ?")){
    $query->bind_param('si', $_SESSION['chave'], $id);
    $query->execute(); 
    $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula, $justificativa);
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
    if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $conteudo[3] || $_SESSION['id'] == $idUser) && ($tipoReq == 6)){

		switch ($statusReq) {
				case 'Pendente':
					$status = 'Pendente';
					break;
				case 'Aprovado':
					$status = 'Aprovado';
					break;
				case 'Cancelado':
					$status = 'Cancelado';
					break;
				case 'Negado':
					$status = 'Negado';
					break;
				case 'PendenteProf':
					$status = 'Pendente - Professor';
					break;
				case 'ConfirmadoProf':
					$status = 'Confirmado - Professor';
					break;
				case 'NegadoProf':
					$status = 'Negado - Professor';
					break;
			}

			if($conteudo[3] == 0)
				$professor = $conteudo[5];
			else{
				$query = $db->prepare("SELECT nomeUser FROM tbusuario WHERE idUser = ?");
		        $query->bind_param('i', $conteudo[3]);
		        $query->execute();
		        $query->bind_result($professor);
		        $query->fetch();
		        $query->close();
			}

	$html = '
<style>@page {
     margin: 200px 60px 115px 95px;
     background: url(3.png);
	z-index: 1;
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
		<h2 style="text-align: center;">REQUERIMENTO DE TRABALHO DE CONCLUSÃO DE CURSO</h2>
		<div class="titulo">DADOS DO ALUNO</div>
		<div class="normal"><b>Nome:</b> '.$nomeUser.'</div>
		<div class="normal"><b>Matrícula:</b> '.$matricula.'</div>
		<div class="normal"><b>Curso:</b> '.$afiliacao.'</div>
		<div class="normal"><b>Telefone:</b> '.$numTelefone.'</div>
		<div class="normal"><b>E-mail:</b> '.$email.'</div>
		<br>
		<p style="text-align: justify;text-indent: 1.5em;">Venho, por meio deste, requerer matrícula na atividade de <b>TRABALHO DE CONCLUSÃO DE CURSO '.$conteudo[0].'</b>, código '.$conteudo[1].', período letivo '.$conteudo[2].', sob orientação do(a) professor(a) '.$professor.'.</p>
		<br>
		<div class="titulo">INFORMAÇÕES DO REQUERIMENTO</div>
		<div class="normal"><b>Status:</b> '.$status.'</div>
		<div class="normal"><b>Observação do aluno (Opcional):</b> '.$conteudo[4].'</div>
		<div class="normal"><b>Justificativa (Opcional):</b> '.$justificativa.'</div>
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
?>
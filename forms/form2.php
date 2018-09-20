<?php
	$id = (isset($_GET['id']))? $_GET['id'] : NULL;
	include '../includes/sessao.php';

    $db = Atalhos::getBanco();
    if ($query = $db->prepare("SELECT a.conteudoReq, b.nomeUser, AES_DECRYPT(b.email,?), c.afiliacao, a.tipoReq, b.idUser, a.statusReq, e.matricula, a.justificativaReq
              FROM tbRequerimentos a
              inner join tbUsuario b on a.idUser = b.idUser 
              inner join tbAfiliacao c on b.idAfiliacao = c.idAfiliacao
              inner join tbMatricula e on b.idUser = e.idUser
              WHERE a.idReq = ?")){
    $query->bind_param('si', $_SESSION['chave'], $id);
    $query->execute(); 
    $query->bind_result($conteudoReq, $nomeUser, $email, $afiliacao, $tipoReq, $idUser, $statusReq, $matricula, $justificativa);
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
    $conteudo = explode("/-", $conteudoReq);
    $i = explode("/+", $conteudo[0]);
    $ir = explode("/+", $conteudo[1]);
    $est = explode("/+", $conteudo[2]);
    $h = explode("/+", $conteudo[3]);
    if(($_SESSION['nivel'] == '1' || $_SESSION['id'] == $idUser) && ($tipoReq == 2)){
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
		<h2 style="text-align: center;">FICHA DE CADASTRO DE ESTÁGIO</h2>
		<div class="titulo">DADOS DO ALUNO</div>
		<div class="normal"><b>Nome:</b> '.$nomeUser.'</div>
		<div class="normal"><b>Matrícula:</b> '.$matricula.'</div>
		<div class="normal"><b>Curso:</b> '.$afiliacao.'</div>
		<div class="normal"><b>Telefone:</b> '.$numTelefone.'</div>
		<div class="normal"><b>E-mail:</b> '.$email.'</div>
		<br>
		<div class="titulo">DADOS DA INSTITUIÇÃO</div>
		<div class="normal"><b>Tipo de Instituição:</b> '.$i[0].'</div>
		<div class="normal"><b>Instituição é um Agente de Integração?</b> '.$i[1].'</div>
		<div class="normal"><b>Nome da Instituição:</b> '.$i[2].'</div>
		<div class="normal"><b>CPF/CNPJ:</b> '.$i[3].'</div>
		<div class="normal"><b>Logradouro:</b> '.$i[4].' - nº '.$i[5].'</div>
		<div class="normal"><b>Complemento:</b> '.$i[7].'</div>
		<div class="normal"><b>Bairro:</b> '.$i[6].'</div>
		<div class="normal"><b>Cidade/UF:</b> '.$i[8].'</div>
		<div class="normal"><b>E-mail Institucional:</b> '.$i[9].'</div>
		<div class="normal"><b>Telefone Fixo:</b> '.$i[10].'</div>
		<div class="normal"><b>Telefone Celular:</b> '.$i[11].'</div>
		<br>
		<div class="titulo">DADOS DO RESPONSÁVEL PELA INSTITUIÇÃO</div>
		<div class="normal"><b>Nome:</b> '.$ir[0].'</div>
		<div class="normal"><b>CPF:</b> '.$ir[1].'</div>
		<div class="normal"><b>RG:</b> '.$ir[2].'</div>
		<div class="normal"><b>Órgão de Expedição:</b> '.$ir[3].'</div>
		<div class="normal"><b>UF:</b> '.$ir[4].'</div>
		<div class="normal"><b>Data de Nascimento:</b> '.$ir[5].'</div>
		<div class="normal"><b>Sexo:</b> '.$ir[6].'</div>
		<div class="normal"><b>Cargo:</b> '.$ir[7].'</div>
		<br>
		<div class="titulo">DADOS DO ESTÁGIO</div>
		<div class="normal"><b>Tipo de Estágio:</b> '.$est[0].'</div>
		<div class="normal"><b>Carga Horária Semanal (em horas):</b> '.$est[1].'</div>
		<div class="normal"><b>Valor da Bolsa (ao mês):</b> '.$est[2].'</div>
		<div class="normal"><b>Valor Aux. Transporte (ao mês):</b> '.$est[3].'</div>
		<div class="normal"><b>Data de Início do Estágio:</b> '.$est[4].'</div>
		<div class="normal"><b>Data de Fim do Estágio:</b> '.$est[5].'</div>
		<div class="normal"><b>Seguro contra Acidentes Pessoais pela Concedente¹?</b> '.$est[6].'</div>
		<div class="normal"><b>CNPJ¹:</b> '.$est[7].'</div>
		<div class="normal"><b>Seguradora¹:</b> '.$est[8].'</div>
		<div class="normal"><b>Apólice¹:</b> '.$est[9].'</div>
		<div class="normal"><b>Valor do Seguro¹:</b> '.$est[10].'</div>
		<div class="normal"><b>Nome do Supervisor Técnico:</b> '.$est[11].'</div>
		<div class="normal"><b>CPF:</b> '.$est[12].'</div>
		<div class="normal"><b>E-mail:</b> '.$est[13].'</div>
		<div class="normal"><b>Área de Atuação:</b> '.$est[14].'</div>
		<div class="normal"><b>Formação:</b> '.$est[15].'</div>
		<br>
		<div class="titulo">PROPOSTA DE HORÁRIO DE ATIVIDADES</div>
		<div class="normal">
			<table style="width: 100%;margin-bottom: 10px;" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width: 20%;">
						<table>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;"><label>SEG</label></td>
							</tr>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;">
									<table style=" text-align: center;">
										<tr>
											<td style="width: 50px;height: 18px;"><label>Entrada</label></td>
											<td style="width: 50px;height: 18px;"><label>Saída</label></td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[0].'</td>
											<td style="width: 50px;height: 18px;">'.$h[1].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[2].'</td>
											<td style="width: 50px;height: 18px;">'.$h[3].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[4].'</td>
											<td style="width: 50px;height: 18px;">'.$h[5].'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td style="width: 20%;">
						<table>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;"><label>TER</label></td>
							</tr>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;">
									<table style=" text-align: center;">
										<tr>
											<td style="width: 50px;"><label>Entrada</label></td>
											<td style="width: 50px;"><label>Saída</label></td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[6].'</td>
											<td style="width: 50px;height: 18px;">'.$h[7].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[8].'</td>
											<td style="width: 50px;height: 18px;">'.$h[9].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[10].'</td>
											<td style="width: 50px;height: 18px;">'.$h[11].'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td style="width: 20%;">
						<table>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;"><label>QUA</label></td>
							</tr>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;">
									<table style=" text-align: center;">
										<tr>
											<td style="width: 50px;"><label>Entrada</label></td>
											<td style="width: 50px;"><label>Saída</label></td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[12].'</td>
											<td style="width: 50px;height: 18px;">'.$h[13].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[14].'</td>
											<td style="width: 50px;height: 18px;">'.$h[15].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[16].'</td>
											<td style="width: 50px;height: 18px;">'.$h[17].'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td style="width: 20%;">
						<table>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;"><label>QUI</label></td>
							</tr>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;">
									<table style=" text-align: center;">
										<tr>
											<td style="width: 50px;"><label>Entrada</label></td>
											<td style="width: 50px;"><label>Saída</label></td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[18].'</td>
											<td style="width: 50px;height: 18px;">'.$h[19].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[20].'</td>
											<td style="width: 50px;height: 18px;">'.$h[21].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[22].'</td>
											<td style="width: 50px;height: 18px;">'.$h[23].'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td style="width: 20%;">
						<table>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;"><label>SEX</label></td>
							</tr>
							<tr>
								<td style="width: 120px; text-align:center; border: 0px;">
									<table style=" text-align: center;">
										<tr>
											<td style="width: 50px;height: 18px;"><label>Entrada</label></td>
											<td style="width: 50px;height: 18px;"><label>Saída</label></td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[24].'</td>
											<td style="width: 50px;height: 18px;">'.$h[25].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[26].'</td>
											<td style="width: 50px;height: 18px;">'.$h[27].'</td>
										</tr>
										<tr>
											<td style="width: 50px;height: 18px;">'.$h[28].'</td>
											<td style="width: 50px;height: 18px;">'.$h[29].'</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="titulo">PLANO DE TRABALHO</div>
		<div class="normal">'.$conteudo[4].'</div>
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
<?php

$html = '
<style>@page {
     margin: 200px 60px 115px 95px;
     background: url(3.png);background-repeat: no-repeat;

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
		<div class="normal">Nome:</div>
		<div class="normal">Matrícula:</div>
		<div class="normal">Curso:</div>
		<div class="normal">Telefone:</div>
		<div class="normal">E-mail:</div>
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
include("../mpdf.php");

$mpdf=new mPDF('','A4');

$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output(); 

exit;

//==============================================================
//==============================================================
//==============================================================


?>
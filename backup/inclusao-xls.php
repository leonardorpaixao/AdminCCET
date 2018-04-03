<?php
include 'sessao.php';
if(!$_SESSION['logado'] || $_SESSION['nivel'] != 1){
header('Location: /inicio');
}
$db = Atalhos::getBanco();
if ($query = $db->prepare("SELECT idInc, matricula, nome, curso, disciplina, codigo, turma, periodo, dataEnvio FROM tbInclusao WHERE status = 'Em análise' ORDER BY dataEnvio ASC")){
          $query->execute();
          $query->bind_result($idInc, $matricula, $nome, $curso, $disciplina, $codigo, $turma, $periodo, $data);
}


$arquivo = 'requerimentos-inclusao'.date("dmYHi", time()).'.xls';

$html = '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="3">Requerimentos de Inclusão (somente os registros em análise)</tr>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td><b>ID</b></td>';
$html .= '<td><b>Matrícula</b></td>';
$html .= '<td><b>Nome</b></td>';
$html .= '<td><b>Curso</b></td>';
$html .= '<td><b>Código</b></td>';
$html .= '<td><b>Disciplina</b></td>';
$html .= '<td><b>Turma</b></td>';
$html .= '<td><b>Período</b></td>';
$html .= '<td><b>Data</b></td>';
$html .= '</tr>';


while($query->fetch()){
$html .= '<tr>';	
$html .= '<td><b>'.$idInc.'</b></td>';
$html .= '<td><b>'.$matricula.'</b></td>';
$html .= '<td><b>'.$nome.'</b></td>';
$html .= '<td><b>'.$curso.'</b></td>';
$html .= '<td><b>'.$codigo.'</b></td>';
$html .= '<td><b>'.$disciplina.'</b></td>';
$html .= '<td><b>'.$turma.'</b></td>';
$html .= '<td><b>'.$periodo.'</b></td>';
$html .= '<td><b>'.date('d/m/Y H:i', $data).'</b></td>';
$html .= '</tr>';
}



$html .= '</table>';

header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: Requerimentos de Inclusão" );

echo $html;
exit;

?>
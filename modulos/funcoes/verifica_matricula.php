<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include '../../includes/atalhos.php';
	$matricula = $_GET['matricula'];
  $tipo = $_GET['tipo'];
	$db = Atalhos::getBanco();
	if ($query = $db->prepare("SELECT matricula FROM tbmatricula WHERE matricula = {$matricula}")){
        $query->execute();
        $query->store_result();
        $total = $query->num_rows;
        $query->free_result();
    $query->close();
      }
    
    if ($query = $db->prepare("SELECT matricula FROM tbtemporarios WHERE matricula = {$matricula}")){
        $query->execute();
        $query->store_result();
        $total2 = $query->num_rows;
        $query->free_result();
    $query->close();
      }
    
    if($tipo == 'inserir'){
    	if ($total == 1)
    		echo '<div class="callout callout-danger"><p>Você é aluno do DCOMP, logue em sua conta no AdminDCOMP para enviar esse requerimento.</p></div>
    				<input type="hidden" name="veriMat" id="veriMat" value="0"/>';
    	elseif($total == 0 && $total2 == 1)
    	  echo '<div class="callout callout-success"><p>Matrícula OK. Continue preenchendo o formulário.</p></div>
    			<input type="hidden" name="veriMat" id="veriMat" value="1"/>';
    	else
    	  echo '<div class="callout callout-success"><p>Matrícula OK. Informe seus dados pessoais abaixo e continue preenchendo o formulário.</p></div>
    			<input type="hidden" name="veriMat" id="veriMat" value="2"/>
    					<div class="form-group">
                          <label>Nome</label>
                          <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class="form-group">
                          <label>Curso</label>
                          <input type="text" class="form-control" name="curso" id="curso" required>
                        </div>
                        <div class="form-group">
                          <label>Telefone</label>
                          <input type="text" class="form-control" name="telefone" id="telefone" required>
                        </div>
                        <div class="form-group">
                          <label>E-mail</label>
                          <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                          <label>Confirme o e-mail</label>
                          <input type="email" class="form-control" name="email2" id="email2">
                        </div>';
    } elseif ($tipo == 'buscar'){
      if ($total == 1)
        echo '<div class="callout callout-danger"><p>Você é aluno do DCOMP, logue em sua conta no AdminDCOMP para acompanhar um requerimento. Após logar, acesse Requerimentos > Meus.</p></div>
            <input type="hidden" name="veriMat" id="veriMat" value="0"/>';
      elseif($total == 0 && $total2 == 1)
        echo '<div class="callout callout-success"><p>Matrícula OK. Informe o seu e-mail abaixo para acompanhar os requerimentos.</p></div>
          <input type="hidden" name="veriMat" id="veriMat" value="1"/>            
          <div class="form-group">
            <label>E-mail</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" id="botaoPesquisar">Pesquisar situação</button>
          </div>';
      else
        echo '<div class="callout callout-danger"><p>Matrícula não encontrada.</p></div>
            <input type="hidden" name="veriMat" id="veriMat" value="0"/>';
    }
	unset($_GET['matricula']);
  unset($_GET['tipo']);

?>
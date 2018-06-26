<?php
	include '../../includes/sessao.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		switch ($_POST['numPost']){
			case 1://Fazendo Login
				Post::login();
				break;
	        case 2://Fazendo Logout
		        Post::logout();
		        break;
	        case 3:
		        Post::termo();
		        header('Location: /cadastro/');
		        break;
	        case 4:
                Post::requerimentos();
                header('Location: '.$_SESSION['irPara']);
                break;
            case 5:
                Post::bugs();
                header('Location: '.$_SESSION['irPara']);
                break;
	    }
	}

    class Post{

    public static function login(){

      if($_SESSION['numTent'] >= 3){
        if(!empty($_POST['g-recaptcha-response'])){
          $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf3CxETAAAAAETFN-4j9bbRq45zeUUiu8kaC0Gr&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
          $data = json_decode($response);
        }else{
          $_SESSION['errorLogin'] = 'Por favor marque o Captcha';
        }
      }
      if($_SESSION['numTent'] < 3 || (!isset($_SESSION['errorLogin']) && $data->success)){
        $db = Atalhos::getBanco();
        if($query = $db->prepare("SELECT idUser, nomeUser, nivel, statusUser, termo, idAfiliacao FROM tbUsuario WHERE login=? AND senha=? LIMIT 1")){
          $query->bind_param('ss', $_POST['usuario'], $_POST['senha']);
          $query->execute();
          $query->bind_result($id, $nome, $nivel, $status, $termo, $afiliacao);
          if($query->fetch()){
            session_regenerate_id();
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['afiliacao'] = $afiliacao;
            $_SESSION['nivel'] = $nivel;
            $_SESSION['ativo'] = ($status == 'Ativo') ? true : false;
            $query->close();
            if($termo == 1){
              $_SESSION['logado'] = true;
              $query = $db->prepare("SELECT sessao FROM tbOnline WHERE idUser= ?");
              $query->bind_param('i', $_SESSION['id']);
              $query->execute();
              if($query->fetch()){
                $query->close();
                $query = $db->prepare("UPDATE tbOnline SET tempoExpirar= ?,sessao= ? WHERE idUser=?");
                $query->bind_param('sss', date("Y-m-d H:i:s", strtotime("+1 hour 30 minutes")), session_id(), $_SESSION['id']);
                $query->execute();
              }else{
                $query->close();
                $query = $db->prepare("INSERT INTO tbOnline (idUser, tempoExpirar, sessao) VALUES (?, ?, ?)");
                $data = date("Y-m-d H:i:s", strtotime("+1 hour 30 minutes"));
                $idSessao = session_id();
                $query->bind_param('sss', $_SESSION['id'], $data, $idSessao);
                $query->execute();
              }
              $query->close();
              $db->close();
              header('Location: '.$_SESSION['irPara']);
            }else{
              header('Location: /termos-de-uso');
            }
          }else{
            $_SESSION['errorLogin'] = 'Usuário ou senha incorreto';
            $_SESSION['numTent']++;
            header('Location: '.$_SESSION['irPara']);
          }
        }
      }else{
        if(isset($data->success)){
          $_SESSION['errorLogin'] = 'Captcha Incorreto';
        }
        header('Location: '.$_SESSION['irPara']);
      }
    }

    public static function logout(){
      if(isset($_SESSION['irPara'])){
        $irPara = $_SESSION['irPara'];
      }else{
        $irPara = '/inicio';
      }
      session_destroy();
      $db = Atalhos::getBanco();
      if($query = $db->prepare("DELETE FROM tbOnline WHERE idUser = ?")){
        $query->bind_param('i', $_SESSION['id']);
        Atalhos::addLogsAcoes('Deslogou', null, null);
        $query->execute();
      }
      $query->close();
      $db->close();
      header('Location: '.$_SESSION['irPara']);
    }

  	public static function termo(){
  		$db = Atalhos::getBanco();
  		if($query = $db->prepare("UPDATE tbUsuario SET termo = 0 WHERE idUser = ?")){
  			$query->bind_param('i', $_SESSION['id']);
  			$query->execute();
        Atalhos::addLogsAcoes('Confirmou termo', null, null);
  			echo 'Error: '.$query->error;
  			$query->close();
  			$_SESSION['logado'] = true;
  			$query = $db->prepare("SELECT sessao FROM tbOnline WHERE idUser= ?");
  			$query->bind_param('i', $_SESSION['id']);
  			$query->execute();
  			if($query->fetch()){
  				$query->close();
  				$query = $db->prepare("UPDATE tbOnline SET tempoExpirar= ?,sessao= ? WHERE idUser=?");
  				$query->bind_param('sss', date("Y-m-d H:i:s", strtotime("+1 hour 30 minutes")), session_id(), $_SESSION['id']);
  				$query->execute();
  			}else{
  				$query->close();
  				$query = $db->prepare("INSERT INTO tbOnline (idUser, tempoExpirar, sessao) VALUES (?, ?, ?)");
  				$data = date("Y-m-d H:i:s", strtotime("+1 hour 30 minutes"));
  				$idSessao = session_id();
  				$query->bind_param('sss', $_SESSION['id'], $data, $idSessao);
  				$query->execute();
  			}
  			$query->close();
  		}
  		$db->close();
  	}

  	public static function requerimentos(){
            switch($_POST['tipoReq']){
                case 3://Abono de Faltas
                  $inicio = $_POST['datacomeco'];
                  $fim = $_POST['datafim'];
                  $d1 = $_POST['disciplina'];
                  $t1 = $_POST['turma'];
                  $p1 = $_POST['professor'];
                  $p2 = $_POST['professor2'];
                  if($p1 != 0)
                    $p2 = '';
                  $requerimento_conteudo = $inicio.'/+'.$fim.'/+'.$d1.'/+'.$t1.'/+'.$p1.'/+'.$p2;
                  break;
                case 5://Inclusão
                  $periodo = $_POST['periodo'];
                  $situacao = $_POST['situacao'];
                  $reprovou = $_POST['reprovou'];
                  $iea = $_POST['iea'];
                  $disciplina = $_POST['disciplina'];
                  $turma = $_POST['turma'];
                  $requerimento_conteudo = $periodo.'/+'.$situacao.'/+'.$reprovou.'/+'.$iea.'/+'.$disciplina.'/+'.$turma;
                  break;
                case 7://Geral
                  $requerimento_conteudo = $_POST['requerimento'];
                  break;
            }
    		$db = Atalhos::getBanco();
            if($query = $db->prepare("SELECT idTemp FROM tbTemporarios WHERE matricula = ?")){
                $query->bind_param('i', $_POST['matricula']);
                $query->bind_result($idTemp1);
                $query->execute();
                $query->store_result();
                $total = $query->num_rows;
                $query->fetch();
                $query->close();
            }
            if($total == 0){ // O USUÁRIO NÃO É ALUNO DO DCOMP E NÃO TEM REGISTRO TEMPORÁRIO
                $tese = "senhatemporaria";

                if($_POST['tipoReq'] != 3 && $_POST['tipoReq'] != 5){ // REQUERIMENTOS SEM PDF
                    if($query = $db->prepare("INSERT INTO tbTemporarios(matricula,telefone,email,senha,curso, nome)
                    VALUES (?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?), ?, ?)")){
                        $query->bind_param('issssssss', $_POST['matricula'], $_POST['telefone'], $_SESSION['chave'], $_POST['email'], $_SESSION['chave'], $tese, $_SESSION['chave'], $_POST['curso'], $_POST['nome']);
                        $query->execute();
                        $idTemp = $query->insert_id;
                        $query->close();
                    }
                    if($query = $db->prepare("INSERT INTO tbRequerimentos (idTemp, dataReq, conteudoReq, tipoReq) VALUES (?, ?, ?, ?)")){
                        $query->bind_param('issi', $idTemp, date("Y-m-d", time()), $requerimento_conteudo, $_POST['tipoReq']);
                        $query->execute();
                        $query->close();
                        $_SESSION['avisoReqs'] = 1;
                    }
                } elseif(Atalhos::enviarPdfRequerimentos()){ // REQUERIMENTOS COM PDF
                    if($_POST['tipoReq'] == 3)
                      $statusInicial = 'PendenteProf';
                    else
                      $statusInicial = 'Pendente';
                    if($query = $db->prepare("INSERT INTO tbTemporarios(matricula,telefone,email,senha,curso, nome)
                    VALUES (?, AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?), AES_ENCRYPT(?, ?), ?, ?)")){
                        $query->bind_param('issssssss', $_POST['matricula'], $_POST['telefone'], $_SESSION['chave'], $_POST['email'], $_SESSION['chave'], $tese, $_SESSION['chave'], $_POST['curso'], $_POST['nome']);
                        $query->execute();
                        $idTemp = $query->insert_id;
                        $query->close();
                    }
                    if($query = $db->prepare("INSERT INTO tbRequerimentos (idTemp, dataReq, conteudoReq, tipoReq, statusReq) VALUES (?, ?, ?, ?, ?)")){
                        $query->bind_param('issis', $idTemp, date("Y-m-d", time()), $requerimento_conteudo, $_POST['tipoReq'], $statusInicial);
                        $query->execute();
                        $idPdf = $query->insert_id;
                        $query->close();
                        $_SESSION['avisoReqs'] = 1;
                    }
                    if(($_POST['tipoReq'] == 3) && ($query = $db->prepare("INSERT INTO tbReqs_professor (idProfessor, idReq) VALUES (?, ?)"))){
                      $query->bind_param('ii', $_POST['professor'], $idPdf);
                      $query->execute();
                      $query->close();
                      if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                    FROM tbUsuario
                                    WHERE idUser = ?")){
                        $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);
                        $query->execute();
                        $query->bind_result($email);
                        $query->fetch();
                        $query->close();
                        Atalhos::enviarEmail($email,3);
                      }
                    }
                    if(move_uploaded_file($_FILES['pdf']['tmp_name'], "../../pdfs/".$idPdf.".pdf")) {
                        //SE ELE PASSOU NESSE IF, TA TRANQUILO E FAVORAVEL
                    } else{
                        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                        $_SESSION['erroPdf'] = "Não foi possível enviar o PDF. Tente novamente!<br/>
                                                      Se o problema persistir, comunique o erro à secretaria.";
                        return false;
                    }
                }
            } else { // SE O USUÁRIO NÃO FOR ALUNO DO DCOMP MAS JÁ TEM REGISTRO TEMPORÁRIO
                if($_POST['tipoReq'] != 3 && $_POST['tipoReq'] != 5){ // REQUERIMENTOS SEM PDF
                    if($query = $db->prepare("INSERT INTO tbRequerimentos (idTemp, dataReq, conteudoReq, tipoReq) VALUES (?, ?, ?, ?)")){
                        $query->bind_param('issi', $idTemp1, date("Y-m-d", time()), $requerimento_conteudo, $_POST['tipoReq']);
                        $query->execute();
                        $query->close();
                        $_SESSION['avisoReqs'] = 1;
                    }
                } elseif(Atalhos::enviarPdfRequerimentos()){ // REQUERIMENTOS COM PDF
                    if($_POST['tipoReq'] == 3)
                      $statusInicial = 'PendenteProf';
                    else
                      $statusInicial = 'Pendente';
                    if($query = $db->prepare("INSERT INTO tbRequerimentos (idTemp, dataReq, conteudoReq, tipoReq, statusReq) VALUES (?, ?, ?, ?, ?)")){
                        $query->bind_param('issis', $idTemp1, date("Y-m-d", time()), $requerimento_conteudo, $_POST['tipoReq'], $statusInicial);
                        $query->execute();
                        $idPdf = $query->insert_id;
                        $query->close();
                        $_SESSION['avisoReqs'] = 1;
                    }
                    if(($_POST['tipoReq'] == 3) && ($query = $db->prepare("INSERT INTO tbReqs_professor (idProfessor, idReq) VALUES (?, ?)"))){
                      $query->bind_param('ii', $_POST['professor'], $idPdf);
                      $query->execute();
                      $query->close();
                      if ($query = $db->prepare("SELECT AES_DECRYPT(email, ?)
                                    FROM tbUsuario
                                    WHERE idUser = ?")){
                        $query->bind_param('si', $_SESSION['chave'], $_POST['professor']);
                        $query->execute();
                        $query->bind_result($email);
                        $query->fetch();
                        $query->close();
                        Atalhos::enviarEmail($email,3);
                      }
                    }
                    if(move_uploaded_file($_FILES['pdf']['tmp_name'], "../../pdfs/".$idPdf.".pdf")) {
                        //SE ELE PASSOU NESSE IF, TA TRANQUILO E FAVORAVEL
                    } else{
                        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
                        $_SESSION['erroPdf'] = "Não foi possível enviar o PDF. Tente novamente!<br/>
                                                      Se o problema persistir, comunique o erro à secretaria.";
                        return false;
                    }
                }
            }

    	   $db->close();
        }

        public static function bugs(){
            $db = Atalhos::getBanco();
            $dateNow = date("Y-m-d", strtotime("now"));
            if($query = $db->prepare("INSERT INTO tbBugs (nome, email, data, pagina, bug) VALUES (?, AES_ENCRYPT(?, ?), ?, ?, ?)")){
                $query->bind_param('ssssss', $_POST['nome'], $_POST['email'], $_SESSION['chave'], $dateNow, $_POST['pagina'], $_POST['bug']);
                $query->execute();
                $query->close();
                $_SESSION['avisoBugs'] = 1;
            }
            $db->close();
        }
    }
?>

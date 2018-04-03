<?php

include_once("sessao.php");  
include_once("moduleMail.php");
//geração de senha pelo apg
$comando=exec("apg -n 1 -m 12 -x 12 -M SN",$saida,$status);


//Definindo classe Mailer para envio de emial
//variaveis auxiliares
  $email_administrador="gfcteles@gmail.com ";
  $assunto_geracao_de_senha="DCOMP- Senha Gerada";
  $assunto_senha_de_root = "DCOMP- Senha de Root";
  $corpo_msg_senha_de_root = "Historico de senhas de root(1ª posição senha atual): <b>".Atalhos::decode($_SESSION["password"]);
  $corpo_msg_senha_gerada = "Senha gerada: <b>".$saida[0];

  
///

      if(isset($_POST['flag']) and $_POST['flag'] == '1' ){
                
         enviaEmail($email_administrador,$assunto_senha_de_root,$corpo_msg_senha_de_root);
          
         # echo "Nova senha: "."<b>".$saida[0]."</b>".;
          echo'<div class="col-md-6"><div class="box">
                <div class="box-header">
                  <h3 class="box-title">Gerenciamento de Senha (root)</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table id="tabel2"  class="table table-striped">
                    <tr>
                      <th style="text-align:center">Senha Atual</th>
                      <th style="text-align:center">Opções</th>
                    </tr>
                    <tr>';
                      
                  echo "
                        <td id=\"senha\" style=\"text-align:center \" ><p  style=\"color:red\" id=\"crm\"></p><b>Senha enviada ao e-mail do adm</b></td>\n
                      <td>
                      <button id='button_gerar' Onclick=\"gerar_senha()\" class=\"btn btn-block btn-info btn-xs\">gerar outra</button>\n
                      <button id='button_aplicar' Onclick=\"aplicar_senha() disabled\" class=\"btn btn-block btn-success btn-xs disabled\">aplicar</button>\n
                      </td>
                    </tr>\n
                    
                  </table>\n
                </div><!-- /.box-body -->\n
              </div><!-- /.box -->\n</div>";
            
          
          unset($_POST['flag']);
    }elseif (isset($_POST['flag']) and $_POST['flag'] == '2' ) {
              
          enviaEmail($email_administrador,$assunto_geracao_de_senha,$corpo_msg_senha_gerada);

          echo'<div class="col-md-6"><div class="box">
                <div class="box-header">
                  <h3 class="box-title">Gerenciamento de Senha (root)</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table id="tabel2"  class="table table-striped">
                    <tr>
                      <th style="text-align:center">Senha gerada</th>
                      <th style="text-align:center">Opções</th>
                    </tr>
                    <tr>';
                      
                  echo "
                        <td id=\"senha\" style=\"text-align:center \" ><p  style=\"color:red\" id=\"crm\"></p><b>Senha enviada ao e-mail do adm, para aplica-la click em 'aplicar', para gerar outra click em 'gerar outra'</b></td>\n
                      <td>
                      <button id='button_gerar' Onclick=\"gerar_senha()\" class=\"btn btn-block btn-info btn-xs\">gerar outra</button>\n
                      <button id='button_aplicar' Onclick=\"aplicar_senha()\" class=\"btn btn-block btn-success btn-xs\">aplicar</button>\n
                      </td>
                    </tr>\n
                    
                  </table>\n
                </div><!-- /.box-body -->\n
              </div><!-- /.box -->\n</div>";

    }
            

  
  ?>

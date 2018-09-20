<?php
  include '../../includes/sessao.php';
  
  if ($_GET['pass'] == '741AsD852963lcE6aDfF'){
    $db = Atalhos::getBanco();
      $dateNow = date("Y-m-d H:i:s", strtotime("now"));
    if ($query = $db->prepare("SELECT data FROM tbatualizacao ORDER BY idAtualizacao DESC LIMIT 1")){
      $query->execute();
      $query->bind_result($data);
      $query->fetch();
      $query->close();
    }
    $date12h = date("Y-m-d H:i:s", strtotime("+12 hour", strtotime($data)));
    if ($dateNow >= $date12h){
      $idUser = 10;
      if($query = $db->prepare("INSERT INTO tbatualizacao (idUser, data) VALUES (?, ?)")){
        $query->bind_param('is', $idUser, $dateNow);
        $query->execute();
        $query->close();
      }
      Atalhos::updateBD();
      $db->close();
   }
  }else{
    echo "HELLO";
  }

?>

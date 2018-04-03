<?php

  include 'includes/atalhos.php';

  class Statistics{

    private static $db;

    function __construct(){
      self::$db = Atalhos::getBanco();
    }
  
    public function getRating(){
      if($query = self::$db->prepare ("SELECT avalicao FROM tbTicket WHERE avalicao != 'NULL'")){
        $query->execute();
        $query->bind_result($avaliacao);
        $total = 0; $i = 0;
        while ($query->fetch()){
          $total += $avaliacao;
          $i++;
        }
        $result = $total / $i;
      }
      return round($result, 2);
      $query->close();
      self::$db->close();
    }
    
    public function getTimeClose(){
      if($query = self::$db->prepare ("SELECT dateStart, dateUpdate FROM tbTicket WHERE statusTicket = 'Concluído'")){
        $query->execute();
        $query->bind_result($dateStart, $dateUpdate);
        $total = 0; $i = 0;
        while ($query->fetch()){
          $diff = strtotime($dateUpdate) - strtotime($dateStart);
          $total += $diff;
          if($diff > 0)
            $i++;
        }
        $result = $total / $i;
      }
      return (int)floor($result / 3600);
      $query->close();
      self::$db->close();
    }

    public function getTimeResponse(){
      if($query = self::$db->prepare("SELECT idTicket, idUser, dataLog FROM tbLog ORDER BY idTicket ASC")){
        $query->execute();
        $query->bind_result($idTicket, $idUser, $dateLog);
        $total = 0; $i = 0; $flag = 1;
        while ($query->fetch()){
          if ($idTicket == $idTicketOld && $idUser != $idUserOld && $flag > 1){
            $total += strtotime($dateLog) - strtotime($dateLogOld);
            $flag = 0;
            $i++;
          }
          $flag++;
          $idTicketOld = $idTicket;
          $idUserOld = $idUser;
          $dateLogOld = $dateLog;
        }
        $result = $total / $i;
      }
      return (int)floor($result / 3600);
      $query->close();
      self::$db->close();
    }

  }

  $statistic = new Statistics();
  echo $statistic->getRating();

?>

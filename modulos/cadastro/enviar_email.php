<?php

require("../../phpmailer/PHPMailerAutoload.php");

$Mailer = new PHPMailer();
$Mailer->IsSMTP();
$Mailer->Charset = 'UTF-8';
$Mailer->SMTPAuth = true;
$Mailer->SMTPOptions = array(
    'ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_sef_signed'=>true
    )
);


//debug
$Mailer->SMTPDebug=false;

//Host
$Mailer->Host = "smtp.gmail.com";

$Mailer->SMTPSecure = 'tls';

$Mailer->Port = 587;

$Mailer->SMTPAuth = true;

$Mailer->Username='leonardorpaixao3@gmail.com';
$Mailer->Password='leo152476389';

$Mailer->setFrom ('leonardorpaixao3@gmail.com', 'email');
$Mailer->addAddress($row['email'], $row['nomeUser']);
$Mailer->Subject = 'testando PHPMailer';
$Mailer->Body = 'Este é um teste do php Mailer';

if($Mailer->send()){
    echo "email enviado com sucesso!";
    $testemail = $row['email'];
    echo print_r($testemail);
}else echo "Deu algum erro";

?>

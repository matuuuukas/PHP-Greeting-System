<?php

//    $mailto = $_POST['mail_to'];
//    $mailSub = $_POST['mail_sub'];
//    $mailMsg = $_POST['mail_msg'];
//    $mailMsg = rtrim($mailMsg, ' , ');

require_once('dbh.inc.php');

$sql = "SELECT first_name, last_name, birth_date FROM birthday";
$result = mysqli_query($conn, $sql);


//    $splitDate[1] == $todayDate['mon'] && $splitDate[2] == $todayDate['mday'];


$todayDate = (getdate());
$arr = array();

while ($row = mysqli_fetch_array($result)){
    
    $splitDate = explode("-", $row['birth_date']);
    $todayDate = (getdate());

    if ($splitDate[1] == $todayDate['mon'] + 1) {
        
        $birthday = $row['first_name'] . " " . $row['last_name'] . ", ";
        $arr[] = $birthday;
    }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Host = 'kuosa.serveriai.lt';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "matas@elegija.lt";
$mail->Password = "matas39605040516";
$mail->setFrom('matas@elegija.lt', 'Alna sveikina su gimtadieniu!');
$mail->addReplyTo('matas@elegija.lt', 'Matas Sisimbajevas');
$mail->addAddress('matukasel@gmail.com');
$mail->Subject = $mailSub;

$mail->Body = '
<div style="background-image: linear-gradient(to rgba(); padding-top: 30px; padding-bottom: 30px;">

    <h1 align="center">Šiandien gimtadienį švenčia: </h1>
    <h2 style="font-size: 20px; text-align:center; font-weight: 600;">' . foreach($arr as $value) {echo $value;} . '</h2>
    <h3 style="text-align:center;"> Sveikiname su gimtadieniu ir linkime atrasti tai, <br>kas kiekvieną dieną skatintų stiebtis, kilti aukštyn ir sėkmingai pasiekti savo tikslus!</h3>
</div>
<div align="center">
    <img src="http://www.alna.lt/wp-content/uploads/2016/04/Alna-logo-resized-1.png" width="50px" ;>
</div>';

$mail->isHTML(true);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.kuosa.serveriai.lt}[Kuosa]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}


?>
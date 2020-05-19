<?php
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


error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
require_once "Mail.php";

$host = "ssl://kuosa.serveriai.lt";
$username = "matas@elegija.lt";
$password = "matas39605040516";
$port = "465";
$to = "matukasel@gmail.com";
$email_from = "matas@elegija.lt";
$email_subject = "Kito mėnesio gimtadieniai!";

$names = implode(', ', $arr);

$email_body = '<div style="padding-top: 30px; padding-bottom: 30px;">

    <h1 align="center">Kitą menėsį gimtadienį švenčia: </h1>
    <h2 style="font-size: 20px; text-align:center; font-weight: 600;"></h2>
    <h3 style="text-align:center;"> Nepamirškite pasveikinti </h3>
</div>
<div align="center">
</div>
    
$email_address = "matas@elegija.lt";
$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address, 'Content-type' => 'text/html;charset=iso-8859-1');
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
echo("<p>Message successfully sent!</p>");
}


?>
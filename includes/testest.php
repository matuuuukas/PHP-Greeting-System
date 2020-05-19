<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ .'../../lib/PHPMailer/src/Exception.php';
require __DIR__ .'../../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '../../lib/PHPMailer/src/SMTP.php';



$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 3;
$mail->Host = '172.27.2.40';
$mail->Port = 25;
$mail->SMTPSecure = false;
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false;
$mail->Username = "oracle@alna.lt";
$mail->Password = "Alnukas01";
$mail->setFrom('oracle@alna.lt', 'Alna sveikina su gimtadieniu!');
$mail->addReplyTo('oracle@alna.lt', 'Birthday');

$mail->addAddress('msisimbajevas@alna.lt');
$mail->Subject = "Alna Software sveikina su gimtadieniu!";
$mail->Encoding = 'base64';
$mail->CharSet = 'UTF-8';
require_once('dbh.inc.php');

$sql = "SELECT first_name, last_name, birth_date FROM birthday ORDER BY MONTH(birth_date), DAYOFMONTH(birth_date)";
$result = mysqli_query($conn, $sql);

$todayDate = (getdate());
$arr = array();

while ($row = mysqli_fetch_array($result)){
    
    $splitDate = explode("-", $row['birth_date']);
    $todayDate = (getdate());
//$splitDate[1] == $todayDate['mon'] && $splitDate[2] == $todayDate['mday']
    if ($splitDate[1] == $todayDate['mon'] && $splitDate[2] == $todayDate['mday']) {
        
        $birthday = $row['first_name'] . " " . $row['last_name'];
        $arr[] = $birthday;
    } 
}

if (empty($arr)){
    die();
} else {
    $names = implode($arr, ", ");
}

//$names = implode($arr, ", ");

$mail->Body = '<table class="m_8407661053376512930gmail-fix" width="100%" style="background:#fff;min-width:320px" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td>
                <table class="m_8407661053376512930w-100p" width="800" align="center" style="max-width:800px;margin:0 auto" cellpadding="0" cellspacing="0">
                    <tbody>

                        <tr>
                            
                        </tr>

                        <tr>
                            <td class="m_8407661053376512930pl-21 m_8407661053376512930pb-10 m_8407661053376512930fs-46 m_8407661053376512930lh-40" style="padding:0 10px 17px 43px;font:700 70px/61px Helvetica,Arial,sans-serif,acumin-pro;color:#000"> Happy birthday!
                            </td>
                        </tr>
                        <tr>
                            <td class="m_8407661053376512930pl-21 m_8407661053376512930fs-25 m_8407661053376512930lh-28" style="padding:10px 10px 20px 43px;font:35px/40px Helvetica,Arial,sans-serif,acumin-pro;color:#000"> Matas Sisimbajevas
                            </td>
                        </tr>
                        <tr>
                        </tr>

            <td>
                <img src="http://172.27.199.169/uploads/acb.gif" border="0" style="vertical-align:top" width="300px" height="auto" alt="" class="CToWUd" download>
            
            </td>
        <tr>

        </tr>
    </tbody>
</table>
</td>
</tr>
</tbody>
</table>';
        
$mail->isHTML(true);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>
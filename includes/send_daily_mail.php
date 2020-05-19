<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ .'../../lib/PHPMailer/src/Exception.php';
require __DIR__ .'../../lib/PHPMailer/src/PHPMailer.php';
require __DIR__ . '../../lib/PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 3;
$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPSecure = "tls";
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = true;
$mail->Username = "";
$mail->Password = "";
$mail->setFrom('', '');
$mail->addReplyTo('', '');
$mail->addAddress('', '');

$mail->Subject = "";
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

$mail->Body = '<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no" />

    <style>
        body {
            margin: 0;
            padding: 0;
            min-width: 100%;
            width: 100% !important;
            height: 100% !important;
        }

        body,
        table,
        td,
        div,
        p,
        a {
            -webkit-font-smoothing: antialiased;
            text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            line-height: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse !important;
            border-spacing: 0;
        }

        img {
            border: 0;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }


        @media all and (min-width: 560px) {
            .background {
                background: #fff;
            }
        
            .container {
                border-radius: 8px;
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                -khtml-border-radius: 8px;
            }
        }

        a,
        a:hover {
            color: #127DB3;
        }

        .footer a,
        .footer a:hover {
            color: #999999;
        }

    </style>

    <title></title>

</head>

<body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; background-color: #F0F0F0; color: #000000;" bgcolor="#F0F0F0" text="#000000">

    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="padding-bottom: 20px; border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; class="background">
        <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;" bgcolor="#F0F0F0">

                
                <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="margin-bottom: 30px; border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="wrapper">

                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 20px;
			padding-bottom: 20px;">
                        </td>
                    </tr>
                    
                </table>
<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px; margin-bottom: 50px;" class="container"> 
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
			padding-top: 25px;
			color: #000000;
			font-family: sans-serif;" class="header">
                            Šiandien gimtadienį švenčia
                        </td>
                    </tr>


                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%; padding-top: 25px; color: #000000; font-family: sans-serif;" class="paragraph"><b>
                            ' . $names . '</b>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%; padding-top: 25px; color: #000000; font-family: sans-serif;" class="paragraph">
                             Nuoširdžiai su gimtadieniu sveikina <b>ASW</b> kolektyvas!

                        </td>
                    </tr>
                    
                    
                    <tr>
                    <td style="padding-bottom: 15px;"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>';
        
$mail->isHTML(true);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>

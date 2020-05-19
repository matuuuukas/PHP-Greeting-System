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

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>

    <body>
        <form action="send_month_mail.php" method="POST" id="subForm">
            <input type="text" name="mail_to" id="mail_to" value="matukasel@gmail.com">
            <input type="text" name="mail_sub" id="mail_sub" value="Alna sveikina">
            <input type="text" name="mail_msg" id="mail_msg" value="
            <?php 
            foreach($arr as $value){
                    echo $value;
                }
                                                                    
            if (empty($value)){
                header("Location: ../index.php");
                exit();
            }
                                                                    
            ?>
            ">
            <input type="submit" value="submit">
        </form>

        <script>
            document.getElementById("subForm").submit();
        </script>
    </body>

    </html>
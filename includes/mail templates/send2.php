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

foreach ($arr as $value){
    echo $value;
}

?>
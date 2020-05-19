<?php

require_once('mysqli_connect.php');

if (mysqli_connect_errno()){
    echo ("Connect failed: %s\n". mysqli_connect_error());
    exit;
} else {
//    echo "Prisijungta";
}

$sql = "SELECT first_name, last_name, birth_date FROM birthday";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Nepavyko paleisti uzklausos i duomenu baze" . mysql_error();
} else {
//    echo "<br>Pavyko </br>";
}

if (mysqli_num_rows($result) == 0) {
    echo "Duomenų bazėje duomenų nerasta";
    exit;
}

    echo '<h2 style="text-align:center; margin-bottom: 20px;">Kita menesį</h2>';

    $getMonths = substr(date('Y-m-d'), 5, -3);
    $getYears = substr(date('Y-m-d'), 0, -6);
    $nextMonth = substr(date('Y-m-d'), 5, -3) + 1;
    $days=cal_days_in_month(CAL_GREGORIAN,$nextMonth,$getYears);

//    echo "<h2><b>The next month is: $nextMonth and has days: $days </b></h2>";

    while ($row = mysqli_fetch_array($result)){
        if (substr($row['birth_date'], 5, 9) == $nextMonth){
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['birth_date'] . "</td></tr>";
            
//             echo $row['first_name'] . " " . $row['last_name'] . " " . $row['email'] . " " .  $row['birth_date'] . "<br>";
        }
    }
?>
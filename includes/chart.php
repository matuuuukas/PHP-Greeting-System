<?php 
//include_once ('dbh.inc.php');

include_once ('dbh.inc.php');
mysqli_set_charset($conn, 'utf8');

$countBirth = array('Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis');

for($i = 1; $i < 13; $i++){
    
    $sql = "SELECT * FROM birthday WHERE EXTRACT(month from birth_date) = $i";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
                    echo $i . " Menuo <br>";

        while ($row = mysqli_fetch_array($result)){
            echo $row['first_name'] . "<br>";
            echo $row['last_name'] . "<br>";
            echo $row['birth_date'] . "<br>";
            echo "<br>";
        }
        echo "<br><hr>";
    }

}

?>


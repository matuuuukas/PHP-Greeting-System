<?php 
//Connect to database
$dbServername = "";
$dbUsername = "";
$dbPassword = "";
$dbName = "db_birthday";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
mysqli_set_charset($conn, 'utf8');

if ($conn->connect_error) {
    die ("Prie duomenų bazės prisijungti nepavyko: " . $conn->connect_error);
}

?>



<?php
session_start();

if(isset($_POST['logout'])){
    session_start();
    session_destroy();
    header("Location: ../index.php?login=logout");
    exit();
}

?>
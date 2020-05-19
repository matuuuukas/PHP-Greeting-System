<?php 
session_start();
    if(isset($_POST['add'])){
        
            $data_missing = array();
            
            if(empty($_POST['first_name'])){
                $data_missing[] = 'First Name';
            } else {
                $_SESSION['first_name'] = trim($_POST['first_name']);
                
            }
            
            if(empty($_POST['last_name'])){
                $data_missing[] = 'Last Name';
            } else {
                $_SESSION['last_name'] = trim($_POST['last_name']);
            }
            
            if(empty($_POST['birth_date'])){
                $data_missing[] = 'Birth Day';
            } else {
                $_SESSION['birth_date'] = trim($_POST['birth_date']);
            }
        
            if(!empty($data_missing)){
                $_SESSION["alert"] = "Insert data";
                header("Location: ../index.php?add=empty");
                exit();
            } else {
               
                require_once('dbh.inc.php');
                mysqli_set_charset($conn, 'utf8');
                $sql = "SELECT * FROM birthday WHERE first_name = '" . $_SESSION['first_name'] . "' AND last_name = '" . $_SESSION['last_name'] . "';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0){
                    $_SESSION["alert"] = "Data exist";
                    header("Location: ../index.php?add=exist");
                    exit();
                } else {
                    require_once('dbh.inc.php');
                    mysqli_set_charset($conn, 'utf8');
                    $query = "INSERT INTO birthday (first_name, last_name, birth_date) VALUES (?,?,?)";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, 'sss', $_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['birth_date']);
                    mysqli_stmt_execute($stmt);
                    header("location: ../index.php?add=success");
                    $_SESSION["alert"] = "Duomenys įvesti į duomenų baze";

                }
            }
        }
?>
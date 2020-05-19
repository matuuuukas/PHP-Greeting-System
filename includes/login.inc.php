<?php
session_start();

if(isset($_POST['submit'])){
    require_once('dbh.inc.php');
    
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    
    //Error handlers
    
    if (empty($uid) || empty ($pwd)){
            $_SESSION['error'] = "<h3>Norėdami prisijungti įveskite teisingus duomenis</h3>";
            header("Location: ../index.php?login=empty");
            exit();
    } else {
        $sql = "SELECT * FROM admins WHERE user_uid ='$uid' OR user_email = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1) {
                $_SESSION['error'] = "<h3>Norėdami prisijungti įveskite teisingus duomenis</h3>";
                header("Location: ../index.php?login=error");
                exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)){
                
                //De-hashing password
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                
                if ($hashedPwdCheck == false) {
                    $_SESSION['error'] = "<h3>Norėdami prisijungti įveskite teisingus duomenis</h3>";
                    session_unset();
                    session_destroy();
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif($hashedPwdCheck == true) {
                    // Log in the user here
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    header("Location: ../index.php?login=success");
                }
            }
        }
    }
   
} else {
        header("Location: ../index.php?login=error");
        exit();
    }
    
?>
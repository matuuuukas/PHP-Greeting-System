<?php 
session_start(); 
?>


<!DOCTYPE html>
<html lang="lt">

<head>
    <meta charset="UTF-8">
    <title>Login as administrator</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <h1>Login to Greeting system</h1>
            <form action="includes/login.inc.php" method="POST" class="form">
                <input type="text" name="uid" id="uid" placeholder="Username" autocomplete="off">
                <input type="password" name="pwd" id="pwd" placeholder="Password" autocomplete="off">
                <button type="submit" name="submit" id="login-button">Login</button>
            </form>
        </div>
    </div>
    <script>
        $("#login-button").click(function(event) {
            event.preventDefault();

            $('form').fadeOut(500);
            $('.wrapper').addClass('form-success');
        });
    </script>
</body>

</html>
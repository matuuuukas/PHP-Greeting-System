<?php 
session_start();

if (!isset($_SESSION['u_id'])){
   header("Location: login.php");
   die();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Alna Birthday</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script src="lib/jquery-tabledit-1.2.3/jquery.tabledit.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Add new birthday -->
<div class="container-fluid">
    <div class="row" style="background-color:#f8f9fa;">
        <div align="right">
            <form action="includes/logout.inc.php" method="POST">
                <button name="logout" class="btn btn-link">
                    Log out
                </button>
            </form>
        </div>
    </div>

    <div class="row" style="background-color:#f8f9fa; margin-top: 0; padding-top:0; padding-right: 0; padding-bottom: 50px; padding-left:0 ;">
        <div class="col-0 col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>
        <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-8">
            <h2 align="center">Add new birthday</h2><br>

            <div align="center">

                <form class="form-inline" action="includes/addbirthday.inc.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Vardas" autocomplete="off" style="text-align:center;">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Pavardė" autocomplete="off" style="text-align:center;">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" style="text-align:center;" name="birth_date" id="date" placeholder="<?php echo date('Y-m-d'); ?>" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-default" name="add">Pridėti</button>
                </form>
            </div>
        </div>
        <div class="col-0 col-sm-1 col-md-1 col-lg-2 col-xl-2">
        </div>
    </div>
    <div class="row">

        <?php 
                if (isset($_SESSION["alert"])){
                    echo "<h5 style='text-align:center; padding-top: 10px;'>" . $_SESSION["alert"] . "</h5>";
                }
        ?>

    </div>

    <!-- Search from all list -->

    <div class="row">
        <div class="col-0 col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>
        <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-8">
                <br/>
                <div class="form-group">
                        <input type="text" name="search_text" id="search_text" placeholder="Search" class="form-control" style="text-align:center;" autocomplete="off" />
                </div>
                <br/>

                <div id="result"></div>



          
        </div>
        <div class="col-0 col-sm-1 col-md-1 col-lg-2 col-xl-2"></div>
    </div>
    <div class="row" style="width: 100%; height: 50px;"></div>
    <!---->
    <script src="js/search.js"></script>

    </div>
</body>

</html>
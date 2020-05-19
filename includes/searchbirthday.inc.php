<?php


require_once('dbh.inc.php');
mysqli_set_charset($conn, 'utf8');
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "SELECT * FROM birthday where first_name LIKE '%".$search."%' OR last_name LIKE '%".$search."%' or birth_date LIKE '%".$search."%'";
} else {
    $query = "SELECT * FROM birthday ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
 $output .= '
<div class="table-responsive">
    <table id="editable_table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="display:none;">ID</th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Gimimo diena</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
   <td style="display:none;">'.$row["id"].'</td>
    <td>'.$row["first_name"].'</td>
    <td>'.$row["last_name"].'</td>
    <td>'.$row["birth_date"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Duomenų nerasta';
}
?>

    <script>
        $(document).ready(function() {
            $('#editable_table').Tabledit({
                url: 'includes/editremove.php',
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'first_name'],
                        [2, 'last_name'],
                        [3, 'birth_date']
                    ]
                },
                restoreButton: false,
                onSuccess: function(data, textStatus, jqXHR) {
                    if (data.action == 'delete') {
                        $('#' + data.id).remove();
                    }

                }
            });
        });
    </script>
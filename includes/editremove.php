<?php 


include_once('dbh.inc.php');
mysqli_set_charset($conn, 'utf8');

$input = filter_input_array(INPUT_POST);

$first_name = mysqli_real_escape_string($conn, $input["first_name"]);
$last_name = mysqli_real_escape_string($conn, $input["last_name"]);
$birth_date = mysqli_real_escape_string($conn, $input["birth_date"]);

if($input['action'] === 'edit'){
    $query = "UPDATE birthday SET first_name = '".$first_name."', last_name = '".$last_name."', birth_date = '".$birth_date."' WHERE id = '".$input["id"]."'";
    mysqli_query($conn, $query);    
}

if($input['action'] === 'delete'){
    $query = "DELETE FROM birthday WHERE id = '".$input["id"]."'";
    mysqli_query($conn, $query);
}
mysqli_close($conn);
echo json_encode($input);


?>
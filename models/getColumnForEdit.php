<?php
include_once ("../config/connection.php");
if(isset($_POST['table'])){
    $id = $_POST['id'];
    $table = $_POST['table'];
    $sql= "SELECT * FROM $table WHERE id='$id'";
    $rezultat=$konekcija->query($sql)->fetch(PDO::FETCH_ASSOC);
    echo json_encode($rezultat);

}
?>
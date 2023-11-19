<?php
include_once ("../config/connection.php");
global $konekcija;
if(isset($_POST['returnOptions'])) {
    $table = $_POST['table'];
    $sql= "select * FROM $table";
    $rezultat = $konekcija->query($sql)->fetchAll();
    echo json_encode($rezultat);


}

<?php
session_start();
if(isset($_SESSION["korisnik"])){
    unset($_SESSION["korisnik"]);
    header("Location:../index.php?page=login");
}
else{
    header("location:../index.php?page=home");
}

?>

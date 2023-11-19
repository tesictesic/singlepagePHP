<?php
include_once ("../config/connection.php");
global $konekcija;
 if(isset($_POST['kljuc'])){
     $strani_kljuc=$_POST['kljuc'];
     $upit="";
     if($strani_kljuc=="role_id"){
         $upit.="SELECT id,name FROM role";
     }
     else if($strani_kljuc=="product_id"){
         $upit.="SELECT id,name FROM products";
     }
     else if($strani_kljuc=="specification_id"){
         $upit.="SELECT id,name FROM specifications";
     }
     else if($strani_kljuc=="gender_id"){
         $upit.="SELECT id,name FROM gender";
     }
     else if($strani_kljuc=="brand_id"){
         $upit.="SELECT id,name FROM brand";
     }
     else if($strani_kljuc=="color_id"){
         $upit.="SELECT id,name FROM color";
     }
     $rezultat=$konekcija->query($upit)->fetchAll(PDO::FETCH_ASSOC);
     echo json_encode($rezultat);

 }
?>

<?php
 include("../config/connection.php");
 global $konekcija;
 $code="";
 if(isset($_POST['btnKlik'])){
     $id=$_POST['id'];
     $table=$_POST['table'];
     if($konekcija){
         $upit="DELETE FROM $table WHERE id='$id'";
         $rezultat=$konekcija->query($upit)->fetch();
         if(!$rezultat){
             $code=["code"=>201];
         }
         $ajaxResponse=json_encode($code);
         echo $ajaxResponse;
     }

 }
?>

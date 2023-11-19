<?php
 include_once("../config/connection.php");
 global $konekcija;
 $code="";
 if($konekcija){
      if(isset($_POST['btnKlik'])){
       $user_id=$_POST['id_user'];
       $upit="UPDATE users SET banned='0' WHERE id='$user_id'";
       $rezultat=$konekcija->query($upit)->fetch();
       $code=["code"=>201];
       $ajax_response=json_encode($code);
       echo $ajax_response;
      }
 }

?>

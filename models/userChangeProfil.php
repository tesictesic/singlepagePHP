<?php
 session_start();
 include_once ("../config/connection.php");
 require_once ("functions.php");
 global  $konekcija;
 $odgovor="";
 $code="";
 $brGresaka="";
 if($konekcija){
     if($_POST['btnKlik']){
         $brGresaka=0;
         $regexName="/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15})?$/";
         $regexEmail="/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/";
         $regexPicture="/.*\.(jpg|png|jpeg)$/";;
         $ime=$_POST['first_name'];
         $prezime=$_POST['last_name'];
         $email=$_POST['email'];
         $user_id=$_SESSION["korisnik"]["id"];

         ValidateRegex($regexName,$ime,"Your first_name is not in good format. Example: Djordje");
         ValidateRegex($regexName,$prezime,"Your last name is not in good format. Example: Tesic");
         ValidateRegex($regexEmail,$email,"Your email is not in good format. Example:djordjetesic@gmail.com");
         if(!empty($_FILES['picture'])){
             $slika=$_FILES['picture'];
             cutImage($slika,true);
         }
         if($brGresaka==0){
            $upit="UPDATE users SET first_name='$ime',last_name='$prezime',email='$email'";
             if(!empty($_FILES['picture'])){
                 $slika_ime=$_FILES['picture']['name'];
                 $upit.=",picture='$slika_ime'";
             }
             $upit.=" WHERE id='$user_id'";
             if($rezultat=$konekcija->query($upit)->fetch()){

                 $code=["code"=>503];
             }
             else{
                 $code=["code"=>201];
             }
             echo json_encode($code);
         }
     }
 }
?>

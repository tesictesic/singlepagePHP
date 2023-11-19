<?php
 if(isset($_POST['btnKlik'])){
     include("../config/connection.php");
     require ("functions.php");
     global $konekcija;
     $brGresaka;
     $poruka="";
     $code="";
     if($konekcija){
         $brGresaka=0;
        $name=$_POST['name'];
        $subject=$_POST['subject'];
        $email=$_POST['email'];
        $message=$_POST['message'];
        $regexFullName = "/^([A-ZŠĐŽĆČ][a-zšđžćč]{2,15})\s([A-ZŠĐŽĆČ][a-zšđžćč]{2,15}){0,2}$/";
        $regexSubject = "/^[A-zšđžćč]{3,}$/";
        $regexEmail="/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/";
         if(!strlen($message)>5){
             $brGresaka++;
             $poruka=["poruka"=>"Your have to fill in message field and that have to be longer than five"];
             $code=["code"=>422];
         }
         ValidateRegex($regexFullName,$name,"Your name is not in good format. Example:Djordje Tesic");
         ValidateRegex($regexEmail,$email,"Your email is not in good format. Example:djordjetesic@gmail.com");
         if($brGresaka==0){
             $upit_za_unos_poruke="INSERT INTO messages(username,email,user_subject,message_text)VALUES(:username,:email,:user_subject,:message_text)";
             $preparacija=$konekcija->prepare($upit_za_unos_poruke);
             $preparacija->bindParam(":username",$name);
             $preparacija->bindParam(":email",$email);
             $preparacija->bindParam(":user_subject",$subject);
             $preparacija->bindParam(":message_text",$message);
             $rezultat_preparacija=$preparacija->execute();
             if($rezultat_preparacija){
                 $poruka=["poruka"=>"You have successfull registred"];
                 $code=["code"=>201];
             }
             else{
                 $poruka=["poruka"=>"Database problem. Try again"];
                 $code=["code"=>503];
             }
         }


     }
     else{
         echo "Nema konekcije";
     }
     $ajaxResponse=json_encode($code);
     echo $ajaxResponse;
 }
?>

<?php
include("../config/connection.php");
global $konekcija;
require("functions.php");
 if($_POST['btnKlik']){
     $regexName ="/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][a-zšđžćč]{2,15})?$/";
     $regexEmail="/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/";
     $regexPassword ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/";
     $regexPicture="/^(\.\.\/images\/).*\.(jpg|jpeg|png)$/";
     $regexNameof="/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,}$/";
     if($_POST['tabela']){
         $tabela=$_POST['tabela'];
         $brGresaka=0;
         $code="";
         $odgovor="";
         if($tabela=="products"){
            $product_name=$_POST['product_name'];
            $product_text=$_POST['product_text'];
            $product_brandId=$_POST['product_brand'];
            $product_genderId=$_POST['product_gender'];
            $product_picture=$_FILES['product_picture'];
//            var_dump($product_picture);exit();
             CheckEmptyString($product_name,"You have to fill in this field");
             ValidateTextArea($product_text,"Your text must be longer than 3 characters","You have to fill in this field");
             CheckDdlList($product_genderId,"You have to choose gender");
             CheckDdlList($product_brandId,"You have to choose brand");
             if($brGresaka==0){
                 cutImage($product_picture);
                 $image_src=$_FILES['product_picture']['name'];
                 $upit_za_ubacivanje="INSERT INTO products(name,src,description,brand_id,gender_id)VALUES (:name,:src,:description,:brand_id,:gender_id)";
                 $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                 $preparacija->bindParam(":name",$product_name);
                 $preparacija->bindParam(":src",$image_src);
                 $preparacija->bindParam(":description",$product_text);
                 $preparacija->bindParam(":brand_id",$product_brandId);
                 $preparacija->bindParam(":gender_id",$product_genderId);
                 $izvrsanaje=$preparacija->execute();
                 if($izvrsanaje){
                     $odgovor=["poruka"=>"You have successfull registred"];
                     $code=["code"=>201];
                 }
                 else{
                     $odgovor=["poruka"=>"Database problem. Try again"];
                     $code=["code"=>503];
                 }
             }

         }
         else if($tabela=="product_price"){
             $productPrice=$_POST['product_price'];
             $product_id=$_POST['productId'];
             $datumOd=$_POST['datumOd'];
             CheckEmptyString($productPrice,"You have to fill in this field");
             CheckDdlList($product_id,"You have to choose product");
             CheckEmptyString($datumOd,"You have to fill in this dateOf input");
             if(isset($_POST['datumDo'])){
                 $datumDo=$_POST['datumDo'];
                 CheckDates($datumOd,$datumDo,"the to date must not be greater than the to date");
             }
             if($brGresaka==0){
                 $upit_za_ubacivanje="";
                 if(isset($_POST['datumDo'])){
                     $upit_za_ubacivanje="INSERT INTO product_price(product_id,price,dateOf,dateTo) VALUES (:product_id,:price,:dateOf,:dateTo)";
                 }
                 else{
                     $upit_za_ubacivanje="INSERT INTO product_price(product_id,price,dateOf) VALUES (:product_id,:price,:dateOf)";
                 }
                $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                 $preparacija->bindParam(":product_id",$product_id);
                 $preparacija->bindParam(":price",$productPrice);
                 $preparacija->bindParam(":dateOf",$datumOd);
                 if(isset($_POST['datumDo'])){
                     $datumDo=$_POST['datumDo'];
                     $preparacija->bindParam(":dateTo",$datumDo);
                 }
                 $rezultat=$preparacija->execute();
                 if($rezultat){
                     $odgovor=["poruka"=>"You have successfull registred"];
                     $code=["code"=>201];
                 }
                 else{
                     $odgovor=["poruka"=>"Database problem. Try again"];
                     $code=["code"=>503];
                 }
             }
         }
         else if($tabela=="users"){
             $first_name=$_POST['first_name'];
             $last_name=$_POST['last_name'];
             $email=$_POST['email'];
             $password=$_POST['password'];
             $roleId=$_POST['roleId'];
             ValidateRegex($regexName,$first_name,"Your first_name not in good format.Example:Djordje");
             ValidateRegex($regexName,$last_name,"Your last_name not in good format.Example:Tesic");
             ValidateRegex($regexEmail,$email,"Your email not in good format:Example djordjetesic@gmail.com");
             ValidateRegex($regexPassword,$password,"Your password have to contain at least one lowercase letter, one uppercase letter and one number, and the length of the password is at least 8 characters.");
             if($brGresaka==0){
                 $kriptovana_sifra=md5($password);
                  $upit_za_postojanje_korisnika="SELECT * FROM users WHERE email='$email' AND password='$password'";
                  $rezultat_postojanja_korisnika=$konekcija->query($upit_za_postojanje_korisnika)->fetch();
                  if($rezultat_postojanja_korisnika){
                      die();
                  }
                  else{
                      if(isset($_FILES['picture'])){
                          $picture=$_FILES['picture'];
                          cutImage($picture,true);
                          $picture_src=$picture['name'];
                      }
                      else{
                          $picture_src="user.png";
                      }
                      $upit_za_ubacivanje="INSERT INTO users(first_name,last_name,email,password,picture,role_id)VALUES (:first_name,:last_name,:email,:password,:picture,:roleId)";
                      $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                      $preparacija->bindParam(":first_name",$first_name);
                      $preparacija->bindParam(":last_name",$last_name);
                      $preparacija->bindParam(":email",$email);
                      $preparacija->bindParam(":password",$kriptovana_sifra);
                      $preparacija->bindParam(":picture",$picture_src);
                      $preparacija->bindParam(":roleId",$roleId);
                      $izvrsanaje=$preparacija->execute();
                      if($izvrsanaje){
                          $odgovor=["poruka"=>"You have successfull registred"];
                          $code=["code"=>201];
                      }
                      else{
                          $odgovor=["poruka"=>"Database problem. Try again"];
                          $code=["code"=>503];
                      }
                  }

             }
         }
         else if($tabela=="navigation"){
             $page=$_POST['page'];
             $text=$_POST['text'];
             CheckEmptyString($page,"You have to fill in this page field");
             CheckEmptyString($text,"You have to fill in this text field ");
             if($brGresaka==0){
                 $provera_da_li_postoji="SELECT * FROM navigation WHERE page='$page' AND text='$text'";
                 $rezultat=$konekcija->query($provera_da_li_postoji)->fetch();
                 if($rezultat){
                     die();
                 }
                 else{
                     $upit_za_ubacivanje="INSERT INTO navigation(page,text)VALUES (:page,:text)";
                     $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                     $preparacija->bindParam(":page",$page);
                     $preparacija->bindParam(":text",$text);
                     $rezultat=$preparacija->execute();
                     if($rezultat){
                         $odgovor=["poruka"=>"You have successfull registred"];
                         $code=["code"=>201];
                     }
                     else{
                         $odgovor=["poruka"=>"Database problem. Try again"];
                         $code=["code"=>503];
                     }
                 }

             }
         }
         else if($tabela=="messages"){
             $username=$_POST['username'];
             $email=$_POST['email'];
             $user_subject=$_POST['user_subject'];
             $message_text=$_POST['message_text'];
             ValidateRegex($regexName,$username,"Your username not in good format.Example:Djordje Tesic");
             ValidateRegex($regexEmail,$email,"Your email not in good format.Example djordjetesic@gmail.com");
             CheckEmptyString($user_subject,"You have to fill in this field");
             ValidateTextArea($message_text,"Your text must be longer than 3 characters","You have to fill in this field");
             if($brGresaka==0){
                 $upit_za_ubacivanje="INSERT INTO messages(username,email,user_subject,message_text) VALUES (:username,:email,:user_subject,:message_text)";
                 $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                 $preparacija->bindParam(":username",$username);
                 $preparacija->bindParam(":email",$email);
                 $preparacija->bindParam(":user_subject",$user_subject);
                 $preparacija->bindParam(":message_text",$message_text);
                 $rezultat=$preparacija->execute();
                 if($rezultat){
                     $odgovor=["poruka"=>"You have successfull registred"];
                     $code=["code"=>201];
                 }
                 else{
                     $odgovor=["poruka"=>"Database problem. Try again"];
                     $code=["code"=>503];
                 }

             }
         }
         else if($tabela=="role"){
             RoleColorGender($tabela,"role_name");
         }
         else if($tabela=="gender"){
             RoleColorGender($tabela,"gender_name");
         }
         else if($tabela=="color"){
             RoleColorGender($tabela,"color_name");
         }
         else if($tabela=="specifications"){
             RoleColorGender($tabela,"name_color");
         }
         else if($tabela=="product_specification"){
             $product_id=$_POST['product_id'];
             $specification_id=$_POST['specification_id'];
             $spec_value=$_POST['spec_value'];
             CheckEmptyString($spec_value,"You have to fill in this field");
             if($brGresaka==0){
                 $upit_za_ubacivanje="INSERT INTO product_specification(product_id,specification_id,value) VALUES (:product_id,:specification_id,:value)";
                 $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                 $preparacija->bindParam(":product_id",$product_id);
                 $preparacija->bindParam(":specification_id",$specification_id);
                 $preparacija->bindParam(":value",$spec_value);
                 $rezultat=$preparacija->execute();
                 if($rezultat){
                     $odgovor=["poruka"=>"You have successfull registred"];
                     $code=["code"=>201];
                 }
                 else{
                     $odgovor=["poruka"=>"Database problem. Try again"];
                     $code=["code"=>503];
                 }
             }
         }
        else if($tabela=="brand"){
            $brand_name=$_POST['brand_name'];
            $brand_description=$_POST['brand_description'];
            CheckEmptyString($brand_name,"You have to fill in this field");
            ValidateTextArea($brand_description,"Your text must be longer than 3 characters","You have to fill in this field");
            if($brGresaka==0){
                $provera_da_li_postoji_brend="SELECT * FROM brand WHERE name='$brand_name'";
                $rezultat_postojanja_brenda=$konekcija->query($provera_da_li_postoji_brend)->fetch();
                if($rezultat_postojanja_brenda){
                    die();
                }
                else{
                    $upit_za_ubacivanje="INSERT INTO brand(name,description)VALUES (:name,:description)";
                    $preparacija=$konekcija->prepare($upit_za_ubacivanje);
                    $preparacija->bindParam(":name",$brand_name);
                    $preparacija->bindParam(":description",$brand_description);
                    $rezultat=$preparacija->execute();
                    if($rezultat){
                        $odgovor=["poruka"=>"You have successfull registred"];
                        $code=["code"=>201];
                    }
                    else{
                        $odgovor=["poruka"=>"Database problem. Try again"];
                        $code=["code"=>503];
                    }
                }
            }
        }
     }
     $ajaxResponse=json_encode($code);
     echo $ajaxResponse;
 }
?>
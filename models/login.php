<?php
include("../config/connection.php");
require("../helpers/mail.php");
require("functions.php");

 if($_SERVER['REQUEST_METHOD']=="POST") {
     session_start();
     $brGresaka = 0;
     global $brputa_pogreseni;
     $email = $_POST['email_login'];
     $password = $_POST['password_login'];
     $regexEmail = "/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/";
     $regexPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/";
     ValidateRegex($regexEmail, $email, "Your email is not in good format. Example:djordjetesic@gmail.com");
     ValidateRegex($regexPassword, $password, "Your password have to contain at least one lowercase letter, one uppercase letter and one number, and the length of the password is at least 8 characters.");
     if ($brGresaka == 0) {
         $brojacGresaka=0;
         $kriptovana_sifra = md5($password);
         if (!empty($konekcija)) {
             $upit_provera_korisnika = "SELECT * FROM users WHERE email='$email' AND password='$kriptovana_sifra'";
             $rezultat = $konekcija->query($upit_provera_korisnika)->fetch();
             if ($rezultat) {
                 if($rezultat["banned"]==1){
                     header("Location:../index.php?page=login&msg=You are  banned from this site, you can't registred");
                 }
                 else{
                     $_SESSION["korisnik"] = $rezultat;
                     var_dump($_SESSION["korisnik"]);
                     if(isset($_SESSION["korisnik"])){
                         $svi_ulogovani_korisnici=file("../data/ulogovani_korisnici.txt");
                         $email_adresa=$rezultat['email'];
                         if(count($svi_ulogovani_korisnici)==0){
                             $fajl_pokazivac=fopen("../data/ulogovani_korisnici.txt","a");
                             $string_za_unos="$email_adresa\t".time()."\n";
                             fwrite($fajl_pokazivac,$string_za_unos);
                             fclose($fajl_pokazivac);
                         }
                         else{
                             $postoji_user=false;
                             foreach ($svi_ulogovani_korisnici as $korisnik){
                                 list($email_adresa_iz_fajla,$datum_vreme_iz_fajla)=explode("\t",$korisnik);
                                 if($email_adresa_iz_fajla==$email_adresa){
                                     $postoji_user=true;
                                 }
                             }
                             if(!$postoji_user){
                                 $fajl_pokazivac=fopen("../data/ulogovani_korisnici.txt","a");
                                 $string_za_unos="$email_adresa\t".time()."\n";
                                 fwrite($fajl_pokazivac,$string_za_unos);
                                 fclose($fajl_pokazivac);
                             }
                         }

                         header("Location:../index.php?page=home");
                     }
                 }

             }
             else{
                 $upit_postojanja_korisnika="SELECT * FROM users WHERE email='$email'";
                 $rezultat_postojanja=$konekcija->query($upit_postojanja_korisnika)->fetch();
                 if($rezultat_postojanja){
                     $svi_podaci=file("../data/korisnici.txt");
                     if(count($svi_podaci)==0){
                         $fajl_pokazivac=fopen("../data/korisnici.txt","a");
                         $email=$rezultat_postojanja['email'];
                         $datum_vreme=time();
                         $pokusaj=1;
                         $string_za_unos="$email\t$datum_vreme\t$pokusaj\n";
                         fwrite($fajl_pokazivac,$string_za_unos);
                         fclose($fajl_pokazivac);
                     }
                     else{
                         $email_za_proveru=$rezultat_postojanja['email'];
                         $user_exist=false;
                         foreach ($svi_podaci as $row){
                             $data=explode("\t",$row);
                             if($data[0]==$email_za_proveru) $user_exist=true;
                         }
                         if($user_exist){
                             foreach ($svi_podaci as $row){
                                 $data=explode("\t",$row);
                                 if($data[0]==$email_za_proveru){
                                     $datum_vreme=time();
                                     $data[2]++;
                                     $data[1]=$datum_vreme;
                                     if($data[2]>=3){
                                         $upit_za_ban="UPDATE users SET banned='1' WHERE email='$data[0]'";
                                         $rezultat=$konekcija->query($upit_za_ban)->fetch();
                                         header("Location:../index.php?page=login&msg=You are pernament banned from this site");
                                         $userEmail=$data[0];
                                         $subject="Luxury Watches";
                                         $body="Laki kitica";
                                         $headers="From: djordje.tesa@gmail.com";
//                                         if(mail($userEmail, $subject, $body, $headers)){
//                                             header("Location:../index.php?page=login&msg=You are pernament banned from this site");
//                                         }
//
//                                         else{
//                                             var_dump("DADA");
//                                            header("Location:../index.php?page=login&msg=Ne radi mail funkcija");
//                                         }
                                     }
                                     $string=implode("\t",$data);
                                     $string=trim($string);
                                     $string.="\n";
                                     $string_za_unos="";
                                     foreach ($svi_podaci as $item){
                                         $data2=explode("\t",$item);
                                         if($data2[0]==$email_za_proveru){
                                             $string_za_unos.=$string;
                                         }
                                         else{
                                             $string_za_unos.="$data2[0]\t$data2[1]\t$data2[2]\n";
                                         }
                                     }
                                     $niz_clanova=explode("\n",$string_za_unos);
                                     $pomocni_niz=[];
                                     foreach ($niz_clanova as $item){
                                      if($item==""){
                                          continue;
                                      }
                                      else{
                                          array_push($pomocni_niz,$item);
                                      }
                                     }
                                     var_dump($pomocni_niz);
                                     $string_za_unos=implode("\n",$pomocni_niz);
                                     var_dump($string_za_unos);
                                     $string_za_unos=trim($string_za_unos);
                                     $string_za_unos.="\n";
                                     $fajl_pokazivac=fopen("../data/korisnici.txt","w");
                                     fwrite($fajl_pokazivac,$string_za_unos);
                                     fclose($fajl_pokazivac);
                                 }

                             }
                         }
                         else{
                             $fajl_pokazivac=fopen("../data/korisnici.txt","a");
                             $email=$rezultat_postojanja['email'];
                             $datum_vreme=time();
                             $pokusaj=1;
                             $string_za_unos="$email\t$datum_vreme\t$pokusaj\n";
                             fwrite($fajl_pokazivac,$string_za_unos);
                             fclose($fajl_pokazivac);
                         }

                     }

                 }
                 else{
                     header("Location:../index.php?page=login&msg=Unexist user");
                 }


                 header("Location:../index.php?page=login&msg=Your email or password are incorrect");
             }
         }
     }
 }
?>
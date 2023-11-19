<?php
 global $konekcija;
 function ValidateRegex($regex,$input,$poruka){
     global $brGresaka;
     global $odgovor;
     global $code;

     if(!preg_match($regex,$input)){
         $brGresaka++;
         $odgovor=["poruka"=>$poruka];
         $code=["code"=>423];
     }
 }
 function GetTableAll($table){
     global $konekcija;
     $upit_za_dohvatanje="SELECT * FROM $table";
     $rezultat=$konekcija->query($upit_za_dohvatanje)->fetchAll();
     return $rezultat;
 }
function CheckEmptyString($input,$poruka){
    global $brGresaka;
    global $odgovor;
    global $code;
    if($input==""){
        $brGresaka++;
        $odgovor=["poruka"=>$poruka];
        $code=["code"=>423];
    }
}
function CheckDdlList($ddl_value,$poruka){
    global $brGresaka;
    global $odgovor;
    global $code;
    if($ddl_value=="0"){
        $brGresaka++;
        $odgovor=["poruka"=>$poruka];
        $code=["code"=>423];
    }
}
function CheckDates($datum_od,$datum_do,$poruka){
    global $brGresaka;
    global $odgovor;
    global $code;
    if($datum_do<$datum_od){
        $brGresaka++;
        $odgovor=["poruka"=>$poruka];
        $code=["code"=>423];
    }
}
function ValidateTextArea($input,$poruka,$poruka2){
    global $brGresaka;
    global $odgovor;
    global $code;
    if($input!=""){
        if(strlen($input)<3){
            $brGresaka++;
            $odgovor=["poruka"=>$poruka];
            $code=["code"=>423];
        }

    }
    else{
        $odgovor=["poruka"=>$poruka2];
        $code=["code"=>423];

    }
}
function cutImage($slika,$profile=false){
    $tmp=$slika['tmp_name'];
    $name=$slika['name'];
    $type=$slika['type'];
    list($sirina,$visina)=getimagesize($tmp);
     if($profile){
         $nova_sirina=120;
         $nova_visina=120;
     }
     else{
         $nova_sirina=180;
         $nova_visina=180;
     }
     if($type=="image/jpeg"){$izvorna_slika=imagecreatefromjpeg($tmp);}
     else if($type=="image/png"){$izvorna_slika=imagecreatefrompng($tmp);}
     $objekat_slika=imagecreatetruecolor($nova_sirina,$nova_visina);
     imagecopyresampled($objekat_slika,$izvorna_slika,0,0,0,0,$nova_sirina,$nova_visina,$sirina,$visina);
     move_uploaded_file($tmp,"../assets/images/".$name);
     if($type=="image/jpeg"){
         imagejpeg($objekat_slika,"../assets/images/img-resize/".$name);
     }
     if($type=="image/png"){
         imagepng($objekat_slika,"../assets/images/img-resize/".$name);
     }




}
function CheckPercent($id){
     global $konekcija;
    $dohvatanje_datuma_do="SELECT dateTo FROM product_price WHERE product_id='$id'AND dateTo<=CURRENT_DATE LIMIT 1";
    $rezultat_datuma=$konekcija->query($dohvatanje_datuma_do)->fetch();
    if($rezultat_datuma){
        return true;
    }
    else{
        return  false;
    }
}
function ProductPercent($id){
     global $konekcija;
     $upit_za_najblizu_staru_cenu="SELECT price FROM product_price WHERE product_id='$id' AND dateTo<=CURRENT_DATE LIMIT 1";
     $stara_cena_niz=$konekcija->query($upit_za_najblizu_staru_cenu)->fetch();
     $stara_cena=$stara_cena_niz[0];
     $_upit_najnovija_cena="SELECT price FROM product_price WHERE product_id='$id' AND dateTo IS NULL ";
     $najnovija_cena_niz=$konekcija->query($_upit_najnovija_cena)->fetch();
     $najvnovija_cena=$najnovija_cena_niz[0];
     $procenat_snizenja=(((float)$stara_cena-(float)$najvnovija_cena)/(float)$stara_cena)*100;
     return(int)$procenat_snizenja;
}
function LoadOldPrice($id){
     global $konekcija;
    $upit_za_najblizu_staru_cenu="SELECT price FROM product_price WHERE product_id='$id' AND dateTo<=CURRENT_DATE LIMIT 1";
    $stara_cena_niz=$konekcija->query($upit_za_najblizu_staru_cenu)->fetch();
    $stara_cena=$stara_cena_niz[0];
    return $stara_cena;
}
function LoadPrice($id){
     global $konekcija;
    $_upit_najnovija_cena="SELECT price FROM product_price WHERE product_id='$id' AND dateTo IS NULL ";
    $najnovija_cena_niz=$konekcija->query($_upit_najnovija_cena)->fetch();
    $najvnovija_cena=$najnovija_cena_niz[0];
    return (int)$najvnovija_cena;

}
function RoleColorGender($tabela,$kolona){
     global $konekcija;
     global $brGresaka;
     global $odgovor;
     global $code;
    $kolona=$_POST['input'];
    CheckEmptyString($kolona,"You have to fill in this field");
    if($brGresaka==0){
        $upit_za_postojanje_uloge="SELECT * FROM $tabela WHERE name='$kolona'";
        $rezultat_postojanja_uloge=$konekcija->query($upit_za_postojanje_uloge)->fetch();
        if($rezultat_postojanja_uloge){
            die();
        }
        else{
            $upit_za_ubacivanje="INSERT INTO $tabela(name)VALUES (:name)";
            $preparacija=$konekcija->prepare($upit_za_ubacivanje);
            $preparacija->bindParam(":name",$kolona);
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
function CheckTimeInFile($filename,$vreme_isteka){
    $svi_korisnici = file($filename);
    $trenutno_vreme = time();
    $pet_minuta=1*60;
    if($vreme_isteka=="24h"){
        $vreme_za_istek=24*60*60;
    }
    else{
    $vreme_za_istek=1*60;
    }
    echo "<br/>";
    foreach ($svi_korisnici as $key => $korisnik){
        list($email, $datum_vreme) = explode("\t", $korisnik);
            $vreme_unosa=$datum_vreme;
        $ostatak=$trenutno_vreme;
        if($trenutno_vreme - $vreme_unosa > $vreme_za_istek){
            var_dump($korisnik);
            obrisiKorisnika($key, $filename);
        }
    }

}
function obrisiKorisnika($korisnikIndex, $filename) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    unset($lines[$korisnikIndex]);
    $lines = array_filter($lines); // Uklanja prazne redove
    file_put_contents($filename, implode("\n", $lines));
}



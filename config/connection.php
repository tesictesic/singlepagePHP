<?php
require_once "config.php";
PamcenjeStranice();
try {
    $konekcija = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
} catch (PDOException $er) {
    echo "Greska sa konekcijom:" . $er->getMessage();
}
function PamcenjeStranice():void{
    $stranica_koja_je_posecena=$_SERVER['REQUEST_URI'];
    $datum_vreme=date("d. m. Y. h:i:s");
    $ip_adresa=$_SERVER['REMOTE_ADDR'];

    if(strpos($stranica_koja_je_posecena,"index.php?page")){
        if(!strpos($stranica_koja_je_posecena,"&msg")){
            $query=parse_url($stranica_koja_je_posecena,PHP_URL_QUERY);
            parse_str($query,$params);
            $page=basename($params['page']);
            $page=ucfirst($page);
            $sadrzaj_za_upis="$page\t$datum_vreme\t$ip_adresa\n";
            $fajl_pokazivac=fopen(LOG_FAJL,"a"); // data/txt.koji_ti_treba
            $upis=fwrite($fajl_pokazivac,$sadrzaj_za_upis);
            if($upis){
                fclose($fajl_pokazivac);
            }
        }

    }

}
?>







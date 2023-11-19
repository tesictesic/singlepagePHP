<?php
include("../config/connection.php");
global $konekcija;
$brGresaka="";
$odgovor="";
if($konekcija){
    if($_POST['btnKlik']){
        $brGresaka=0;
        $id=$_POST['id'];
        $tabela=$_POST['tabela'];
        $niz=$_POST['niz'];
        $regexEmail="/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/";
        $novi_niz=explode(",",$niz);
        $email="";
        $slika="";
        foreach($novi_niz as $element){

            if(strpos($element,"@")){
                $email=$element;
                if(!preg_match($regexEmail,$email)){
                    $brGresaka++;
                    echo "Greska email";
                }
            }


        }
        if($brGresaka==0){
            if($tabela=="users"){
                $upit="UPDATE $tabela SET first_name='".$novi_niz[0]."',last_name='".$novi_niz[1]."',email='".$novi_niz[2]."',role_id='".$novi_niz[3]."'";
                $upit.=" WHERE id='$id'";
                $result=$konekcija->query($upit);
                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="role"){
                $upit="UPDATE $tabela SET name='".$novi_niz[0]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="products"){
                $upit="UPDATE $tabela SET name='".$novi_niz[0]."',description='".$novi_niz[1]."',gender_id='".$novi_niz[2]."',brand_id='".$novi_niz[3]."' WHERE id=$id";
                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="navigation"){
                $upit="UPDATE $tabela SET page='".$novi_niz[0]."',text='".$novi_niz[1]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="messages"){
                $upit="UPDATE $tabela SET username='".$novi_niz[0]."',email='".$novi_niz[1]."',user_subject='".$novi_niz[2]."',message_text='".$novi_niz[3]."',posting_date='".$novi_niz[4]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="gender"){
                $upit="UPDATE $tabela SET  name='".$novi_niz[0]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="brand"){
                $upit="UPDATE $tabela SET  name='".$novi_niz[0]."',description='".$novi_niz[1]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="specifications"){
                $upit="UPDATE $tabela SET  name='".$novi_niz[0]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if("product_specification"){
                $upit="UPDATE $tabela SET value='".$novi_niz[0]."',specification_id='".$novi_niz[1]."',product_id='".$novi_niz[2]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="product_price"){
                $upit="UPDATE $tabela SET  price='".$novi_niz[0]."',dateOf='".$novi_niz[1]."'";
                if($novi_niz[2]!=""){
                    $upit.=",dateTo='".$novi_niz[2]."'";
                }
                else{
                    $upit.=",dateTo=NULL";
                }
                $upit.=",product_id='".$novi_niz[3]."' WHERE id=$id";
                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
            else if($tabela=="color"){
                $upit="UPDATE $tabela SET  name='".$novi_niz[0]."',class='".$novi_niz[1]."' WHERE id=$id";

                $result=$konekcija->query($upit);

                if($result){
                    $update_result=$result->fetch();
                    $odgovor=["poruka"=>"Izvrseno"];
                }
            }
        }

        else{
            echo "Ima gresaka";
        }
        $ajaxResponse=json_encode($odgovor);
        echo $ajaxResponse;

    }
}
else{
    echo "Nema konekcije";
}


?>

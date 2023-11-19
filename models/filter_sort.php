<?php
include_once ("../config/connection.php");
global $konekcija;
if($konekcija){
    if(isset($_POST['btnKlik'])){
        $upit="SELECT p.id,p.name,p.src,p.description,pr.price,
         (SELECT price FROM product_price WHERE dateTo<=CURRENT_DATE AND product_id=p.id LIMIT 1) as old_price
       FROM products p INNER JOIN product_price pr ON p.id=pr.product_id";
        if(isset($_POST['colorId'])){
            $upit.=" INNER JOIN product_color pc ON p.id=pc.product_id";
            $color_id=$_POST['colorId'];
            $upit.=" WHERE dateTo IS NULL";
            $upit.=" AND pc.color_id='$color_id'";
        }
        else{
            $upit.=" WHERE dateTo IS NULL";
        }

        if(isset($_POST['brandId'])){
            $brands=$_POST['brandId'];
            if(gettype($brands)=="string"){
                $string=$brands;
            }
            else{
                $string=implode(",",$brands);
            }
            $upit.=" AND p.brand_id IN($string)";

        }
        if(isset($_POST['genderId'])){
            $genders=$_POST['genderId'];
            $string2=implode(",",$genders);
            if(isset($_POST['brandId'])){
                $upit.=" AND p.gender_id IN($string2)";
            }
            else{
                $upit.=" AND p.gender_id IN($string2)";
            }
        }

        if(isset($_POST['discount'])){
            $discount=$_POST['discount'];
            $upit.=" AND 100-(pr.price*100)/(SELECT price FROM product_price WHERE dateTo<=CURRENT_DATE AND product_id=p.id LIMIT 1)>$discount";
        }
        if(isset($_POST['sort'])){
            $sort=$_POST['sort'];
            if($sort=="name-asc"){
                $upit.=" ORDER BY p.name ASC";
            }
            else if($sort=="name-desc"){
                $upit.=" ORDER BY p.name DESC";
            }
            else if($sort=="price-asc"){
                $upit.=" ORDER BY pr.price ASC";
            }
            else if($sort=="price-desc"){
                $upit.=" ORDER BY pr.price DESC";
            }
        }
       // var_dump($upit);
        $rezultat=$konekcija->query($upit)->fetchAll();
        $broj=count($rezultat);
        if(isset($_POST['page'])){
            $page=$_POST['page'];
            if($page==""){
                $page=1;
            }
            $page=(int)$page;
            $perPage=9;
            $upit.=" LIMIT ".$perPage*($page-1).",".$perPage;
        }

        $rezultat2=$konekcija->query($upit)->fetchAll();
        $elementi = [
            'brojProizvoda' => $broj,
            'proizvodi'=>$rezultat2
        ];
        $pomocni_niz=[];
        array_push($pomocni_niz,$elementi);
        $ajaxResponse=json_encode($pomocni_niz);
        echo $ajaxResponse;



    }
}
?>
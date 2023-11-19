<?php
include_once ("../config/connection.php");
global $konekcija;
if($konekcija){
    $cart_array=$_POST['cart_array'];
    $products=array();
    foreach ($cart_array as $item){
        $id=$item['id'];
        $upit="SELECT p.id,p.src,p.name,pr.price FROM products p INNER JOIN product_price pr ON p.id=pr.product_id WHERE dateTo is null and p.id='$id'";
        $rezultat=$konekcija->query($upit)->fetch();
        array_push($products,$rezultat);
    }
    echo json_encode($products);
}
else{
    echo "Nema konekcije";
}

?>

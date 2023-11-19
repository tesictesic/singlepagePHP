<?php
session_start();
include_once("../config/connection.php");
global $konekcija;
if($konekcija){
    $code="";
    if(isset($_POST['cart'])){
        $cart=$_POST['cart'];
        $user_id=$_SESSION["korisnik"]["id"];
        $upit="INSERT INTO cart(user_id)VALUES(:user_id)";
        $preparacija=$konekcija->prepare($upit);
        $preparacija->bindParam(":user_id",$user_id);
        $izvrsavanje=$preparacija->execute();
        $cart_id=$konekcija->lastInsertId();
        foreach($cart as $item){
            $upit2="INSERT INTO product_cart(product_id,cart_id,quantity)VALUES (:product_id,:cart_id,:quantity)";
            $preparacija2=$konekcija->prepare($upit2);
            $preparacija2->bindParam(":product_id",$item["id"]);
            $preparacija2->bindParam(":cart_id",$cart_id);
            $preparacija2->bindParam(":quantity",$item["quantity"]);
            $izvrsavanje2=$preparacija2->execute();
        }
        $code=["code"=>201];

    }
    else{
        $code=["code"=>423];
    }
    echo json_encode($code);
}
?>
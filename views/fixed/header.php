<head>

    <?php
     if(isset($_GET['page'])){
         $page=$_GET['page'];
         if(isset($_GET['id'])){
             $id_product=$_GET['id'];
         }
         switch ($page){
             case 'home':
                 echo "<title>Luxury Watches| Home </title>";
                 break;
             case 'products':
                 echo "<title>Luxury Watches| Shop </title>";
                 break;
             case 'contact':
                 echo "<title>Luxury Watches| Contact </title>";
                 break;
             case 'login':
                 echo "<title>Luxury Watches| Login </title>";
                 break;
             case 'register':
                 echo "<title>Luxury Watches| Register </title>";
                 break;
             case 'author':
                 echo "<title>Luxury Watches | Author</title>";
                 break;
             case 'single':
                 $upit_za_dohvatanje_imena_proizvoda="SELECT name FROM products WHERE id='$id_product'";
                 $prozivod=$konekcija->query($upit_za_dohvatanje_imena_proizvoda)->fetch();
                 $proizvod_ime=$prozivod[0];
                 echo "<title>$proizvod_ime | Luxury Watches</title>";
                 break;
         }
     }
     else{
     echo "<title>Luxury Watches| Home </title>";
     }
    ?>

    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

    <!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <!--Custom-Theme-files-->
    <!--theme-style-->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Luxury Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />

    <!--start-menu-->

    <link href="assets/css/memenu.css" rel="stylesheet" type="text/css" media="all" />
    <!--dropdown-->
</head>

<!--top-header-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                <p id="dj-t-header">Kneza Milosa Obrenovic 16 Bajina Basta</p>
            </div>
            <div class="col-md-6 top-header-left">
                <div class="cart box_1">
                    <a href="index.php?page=checkout">
                        <div class="total">
                            <span class="simpleCart_total"></span></div>
                        <img src="assets/images/cart-1.png" alt="cart1" />
                    </a>

                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--start-logo-->
<div class="logo">
    <a href="index.php"><h1>Luxury Watches</h1></a>
</div>
<!--start-logo-->
<!--bottom-header-->

<!--bottom-header-->
<!--banner-starts-->

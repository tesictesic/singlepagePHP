
<!DOCTYPE html>
<?php
session_start();
include("config/connection.php");
require_once ("models/functions.php");
include("views/fixed/header.php");
CheckTimeInFile("data/ulogovani_korisnici.txt","24h");
CheckTimeInFile("data/korisnici.txt","5m");
?>

<body> 
 <?php
  include ("views/fixed/nav.php");
 ?>
    <?php
 if(isset($_GET['page'])){
     $page=$_GET['page'];
     switch ($page){
         case 'home':
             include('views/pages/home.php');
             break;
         case 'register':
             include("views/pages/register.php");
             break;
         case 'login':
             include("views/pages/login.php");
             break;
         case 'products':
             include("views/pages/products.php");
             break;
         case 'contact':
             include("views/pages/contact.php");
             break;
         case 'checkout':
             include("views/pages/checkout.php");
             break;
         case 'author':
             include("views/pages/author.php");
             break;
         case 'profil':
             include("views/pages/account.php");
             break;
         case 'single':
             include("views/pages/single.php");
             break;
     }
 }
 else{
     include('views/pages/home.php');
 }

    ?>
    <?php
     include("views/fixed/footer.php");
    ?>
 <div id="myModal" style="background-color:#0000008f;" class="modal">
     <div class="modal-dialog modal-confirm">
         <div class="modal-content text-center">
             <div class="modal-header flex-column">
                 <div class="icon-box" style="margin:0px auto">
                     <span class="mdi mdi-alert-circle-outline" id="dj-t-alert-icon"></span>
                 </div>
                 <h4 class="modal-title w-100">Cart</h4>
             </div>
             <div class="modal-body">
                 <p class="dj-t-font-20">You have successfull added item</p>
             </div>

         </div>
     </div>
 </div>
 <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

</body>

</html>
<?php
 session_start();
 if(isset($_SESSION["korisnik"])){
     $rola=$_SESSION["korisnik"]["role_id"];
     if($rola!=1){
         header("Location:../../../index.php?page=home");
     }
 }
 else{
     header("Location:../../../index.php?page=home");
 }
?>
<?php
 include_once("../../../config/connection.php");
 global $konekcija;
?>
<!DOCTYPE html>
<html lang="en" class="html">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin Panel | Luxury Watches</title>

    <!-- Fontfaces CSS-->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet"/>
    <link href="../../../assets/css/font-face.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../../../assets/css/fontawesome-all.css" type="text/css" media="all"/>
    <link href="../../../assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/css/style.css" rel="stylesheet"/>

    <!-- Bootstrap CSS-->
    <link href="../../../assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../../../assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../../assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../../../assets/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="indexAdmin.php">
                            <img src="../../../assets/images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <h3>Luxury Watches</h3>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <?php
                include("../../fixed/navAdmin.php");
                ?>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="../../../assets/images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="../../../assets/images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-email"></i>
                                        <span class="quantity">1</span>
                                        <div class="email-dropdown js-dropdown">
                                            <div class="email__title">
                                                <p>You have 3 New Emails</p>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="../../../assets/images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, 3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="../../../assets/images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="email__item">
                                                <div class="image img-cir img-40">
                                                    <img src="../../../assets/images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                                </div>
                                                <div class="content">
                                                    <p>Meeting about new dashboard...</p>
                                                    <span>Cynthia Harvey, April 12,,2018</span>
                                                </div>
                                            </div>
                                            <div class="email__footer">
                                                <a href="#">See all emails</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="../../../assets/images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="../../../assets/images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <?php
             if(isset($_GET['table'])){
                 $table=$_GET['table'];
                 switch ($table){
                     case 'none':
                         include("adminHome.php");
                         break;
                     default:{
                         include("adminTable.php");
                         break;
                     }
                 }
             }
             else{
                 include("adminHome.php");
             }

            ?>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <?php
    if (isset($_POST['id'])&&isset($_POST['table'])) {
        $id=$_POST['id'];
        $tabela=$_POST['table'];
    }
    ?>

    <div class="modal" id="dj-t-2" tabindex="-1" style="overflow-y:scroll">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title">Insert</h5>
        
      </div>
      <div class="modal-body">
            <?php

            require("../../../models/functions.php");
            if($tabela=="users"):
            ?>
            <form enctype="multipart/form-data">
                <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" value="" id="first_name" name="first_name" class="form-control"/>
                 <p class="dj-t-none">Your first name not in good format Example:Djordje</p>
                </div>
                <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control"/>
                    <p class="dj-t-none">Your last name not in good format Example:Tesic</p>
                </div>
                <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control"/>
                    <p class="dj-t-none">Your first name not in good format Example:djordjetesic@gmail.com</p>
                </div>
                <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control"/>
                 <p class="dj-t-none">Your password have to contain at least one lowercase letter, one uppercase letter and one number, and the length of the password is at least 8 characters.</p>
                </div>
                <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" name="picture" class="form-control"/>
                 <p class="dj-t-none">Extension must be .jpeg, .png, .jpeg</p>
                </div>
                <div class="form-group">
                <label for="role">Role:</label>
                 <select id="role" class="form-control">
                    <option value="0">Choose</option>
                    <?php
                     $role=GetTableAll("role");
                     foreach($role as $rol):
                    ?>
                    <option value="<?=$rol['id']?>"><?=$rol['name']?></option>
                    <?php endforeach; ?>
                 </select>
                    <p class="dj-t-none"></p>
                </div>
            </form>
            <?php 
             elseif($tabela=="brand"):
            ?>
                 <div class="form-group">
                     <label for="_name">Name:</label>
                     <input type="text" id="_name" name="_name" class="form-control"/>
                     <p class="dj-t-none"></p>
                 </div>
                 <div class="form-group">
                     <label for="deskripcija">Description:</label>
                     <textarea id="deskripcija" class="form-control"></textarea>
                     <p class="dj-t-none"></p>
                 </div>
             <?php
                 elseif($tabela=="messages"):
                 ?>
                     <div class="form-group">
                         <label for="username">Username:</label>
                         <input type="text" id="username" name="username" class="form-control"/>
                         <p class="dj-t-none">Your username not in good format Example: Djordje Tesic</p>
                     </div>
                     <div class="form-group">
                         <label for="message_email">Email:</label>
                         <input type="text" id="message_email" name="message_email" class="form-control"/>
                         <p class="dj-t-none">Your email is not in good format Example:djordjetesic@gmail.com</p>
                     </div>
                     <div class="form-group">
                         <label for="user_subject">User subject:</label>
                         <input type="text" id="user_subject" name="user_subject" class="form-control"/>
                         <p class="dj-t-none"></p>
                     </div>
                     <div class="form-group">
                         <label for="message_text">Message text:</label>
                         <textarea id="message_text" class="form-control" rows="5"></textarea>
                         <p class="dj-t-none"></p>
                     </div>
                 <?php
                     elseif($tabela=="navigation"):
                     ?>
                         <div class="form-group">
                             <label for="page">Page:</label>
                             <input type="text" id="page" name="page" class="form-control"/>
                             <p class="dj-t-none"></p>
                         </div>
                         <div class="form-group">
                             <label for="nav_text">Text:</label>
                             <input type="text" id="nav_text" name="nav_text" class="form-control"/>
                             <p class="dj-t-none"></p>
                         </div>
                     <?php
            elseif($tabela=="products"):
                $brendovi=GetTableAll("brand");
                $polovi=GetTableAll("gender");
                ?>
            <form enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Name:</label>
                    <input type="text" id="product_name" name="product_name" class="form-control"/>
                    <p class="dj-t-none"></p>
                </div>
                <div class="form-group">
                    <label for="src_text">Src:</label>
                    <input type="file" id="src_file" name="src_file" class="form-control"/>
                    <p class="dj-t-none">"Extensions must be .jpg , .jpeg, .png"</p>
                </div>
                <div class="form-group">
                    <label for="product_text">Description:</label>
                    <textarea id="product_text" rows="5" class="form-control"></textarea>
                    <p class="dj-t-none"></p>
                </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <select class="form-control" id="brand" name="brand">
                        <option value="0">Choose</option>
                        <?php
                        foreach ($brendovi as $brend):
                            ?>
                            <option value="<?=$brend['id']?>"><?=$brend['name']?></option>
                        <?php
                        endforeach;
                        ?>
                </select>
                <p class="dj-t-none"></p>
            </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="0">Choose</option>
                        <?php
                        foreach ($polovi as $pol):
                            ?>
                            <option value="<?=$pol['id']?>"><?=$pol['name']?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <p class="dj-t-none"></p>
                </div>
            </form>
            <?php
            elseif($tabela=="product_price"):
                ?>
                <div class="form-group">
                    <label for="product_price">Price:</label>
                    <input type="text" id="product_price" name="product_price" class="form-control"/>
                    <p class="dj-t-none"></p>
                </div>
                <div class="form-group">
                    <label for="products">Products:</label>
                    <select class="form-control" id="products" name="products">
                        <option value="0">Choose</option>
                        <?php $proizvodi=GetTableAll("products");
                          foreach ($proizvodi as $row):
                        ?>
                        <option value="<?=$row['id'] ?>"><?=$row['name']?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <p class="dj-t-none"></p>
                </div>
                <div class="form-group">
                    <label for="date_of">DateOf:</label>
                    <input type="date" id="date_of" name="date_of" class="form-control"/>
                    <p class="dj-t-none"></p>
                </div>
                <div class="form-group">
                    <label for="date_to">DateTo:</label>
                    <input type="date" id="date_to" name="date_to" class="form-control"/>
                    <p class="dj-t-none"></p>
                </div>
            <?php
            elseif($tabela=="cart"):
                $korisnici=GetTableAll("users");
                ?>

                <div class="form-group">
                    <label for="product_price">Users:</label>
                   <select name="cart_korisnici" class="form-control">
                       <option value="">Choose</option>
                       <?php
                        foreach ($korisnici as $korisnik):
                       ?>
                       <option value="<?=$korisnik['id']?>"><?=$korisnik['first_name']?> <?=$korisnik['last_name']?></option>
                       <?php
                        endforeach;
                       ?>
                   </select>
                </div>
            <?php
            elseif($tabela=="product_specification"):
                $satovi=GetTableAll("products");
                $specifikacije=GetTableAll("specifications");
                ?>
          <div class="form-group">
              <label for="product">Product:</label>
             <select id="product" class="form-control">
                 <option value="">Choose</option>
                 <?php foreach ($satovi as $sat): ?>
                 <option value="<?=$sat['id']?>"><?=$sat['name']?></option>
                 <?php endforeach; ?>
             </select>
              <p class="dj-t-none"></p>
          </div>
              <div class="form-group">
                  <label for="specification">Specification:</label>
          <select id="specification" class="form-control">
              <option value="">Choose</option>
              <?php foreach ($specifikacije as $specifikacija): ?>
              <option value="<?=$specifikacija['id']?>"><?=$specifikacija['name']?></option>
              <?php endforeach; ?>
          </select>
                  <p class="dj-t-none"></p>
              </div>
                <div class="form-group">
                    <label for="spec_value">Value:</label>
                    <input type="text" id="spec_value" name="spec_value" class="form-control"/>
                    <p class="dj-t-none"></p>
                </div>
            <?php
             else:

                 ?>
                 <div class="form-group">
                     <label for="first_name">Name:</label>

                     <input type="text" id="_name_color" name="_name_color" class="form-control" />
                     <p class="dj-t-none"></p>
                 </div>
          <?php
           endif;
          ?>
      </div>
      <div id="AlertDiv">
          <p class="d-none alert alert-danger" id="alert">That user has already registred</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="Odbij3">Close</button>
        <button type="button" class="btn btn-primary" data-table="<?php echo $table ?>" id="Prihvati3">Save changes</button>
      </div>
      
    </div>
  </div>
    </div>
</div>
    <div id="myModal" style="background-color:#0000008f;" class="modal">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content text-center">
                <div class="modal-header flex-column">
                    <div class="icon-box" style="margin:0px auto">
                        <span class="mdi mdi-alert-circle-outline" id="dj-t-alert-icon"></span>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" id="Odbija" >Cancel</button>
                    <button type="button" class="btn btn-danger" id="Prihvata">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="../../../assets/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../../../assets/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../../../assets/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../../../assets/vendor/slick/slick.min.js">
    </script>
    <script src="../../../assets/vendor/wow/wow.min.js"></script>
    <script src="../../../assets/vendor/animsition/animsition.min.js"></script>
    <script src="../../../assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../../../assets/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../../../assets/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../../../assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../../../assets/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../../assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../../../assets/vendor/select2/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/bdcc9994aa.js" crossorigin="anonymous"></script>

    <!-- Main JS-->

    <script src="../../../assets/js/main2.js"></script>
    <script src="../../../assets/js/main.js"></script>

</body>

</html>
<!-- end document-->


<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-9 header-left">
                <div class="top-nav dj-t-margin-margin-top10">
                    <ul class="memenu">
                        <?php
                         $upit_za_dohvatanje_navigacije="SELECT * FROM navigation";
                         $rezultat_upita=$konekcija->query($upit_za_dohvatanje_navigacije)->fetchAll();
                        $x="";
                         if(isset($_SESSION["korisnik"])){
                             $rola=$_SESSION["korisnik"]["role_id"];
                             if($rola==1){
                                 foreach ($rezultat_upita as $row){
                                     if($row["text"]=="Admin Panel"){
                                         $x.="<li class='active'><a href='views/pages/adminPanel/indexAdmin.php'>".$row["text"]."</a>";
                                     }
                                     else{
                                         $x.="<li class='active'><a href='index.php?page=".$row["page"]."'>".$row["text"]."</a>";
                                     }

                                 }
                             }
                             else if($rola==2){
                                 foreach ($rezultat_upita as $row){
                                     if($row["text"]!="Admin Panel"){
                                         $x.="<li class='active'><a href='index.php?page=".$row["page"]."'>".$row["text"]."</a>";
                                     }
                                 }
                             }
                         }
                         else{
                             foreach ($rezultat_upita as $row){
                                 if($row["text"]=="Home"||$row["text"]=="Products"||$row["text"]=="Contact"){
                                     $x.="<li class='active'><a href='index.php?page=".$row["page"]."'>".$row["text"]."</a>";
                                 }
                             }
                         }
                         echo $x;
                        ?>

                        <?php
                        if(isset($_SESSION["korisnik"])):
                            ?>
                            <li>
                                <a href="models/logout.php">Logout</a>
                            </li>
                        <?php
                        else:
                            ?>

                            <li>
                                <a href="index.php?page=login">Login</a>
                            </li>
                        <?php
                        endif;
                        ?>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-md-3 header-right">
                <ul class="memenu dj-t-profile">
                    <?php
                    if(isset($_SESSION["korisnik"])){
                        $rola=$_SESSION["korisnik"]["role_id"];
                        $id=$_SESSION["korisnik"]["id"];
                        $upit_za_dohvatanje_korisnika="SELECT * FROM users WHERE id='$id'";
                        $rezultat_upita=$konekcija->query($upit_za_dohvatanje_korisnika)->fetch();
                        $picture=$rezultat_upita["picture"];
                        $ime=$rezultat_upita['first_name'];
                        if($picture=="user.png"){
                            echo "<img style='height:45px; width:45px;' src='assets/images/$picture' alt='$picture'/>";
                        }
                        else{
                            echo "<img style='height:45px; width:45px;' src='assets/images/img-resize/$picture' alt='$picture'/>";
                        }
                        if($rola==1){
                            echo "<p>Welcome&nbsp;&nbsp; admin&nbsp; &nbsp; <span><a href='index.php?page=profil&id=$id' class='dj-t-color-red'>$ime</a></span></p>";
                        }
                        else{
                            echo "<p>Welcome&nbsp; &nbsp;<span><a href='index.php?page=profil&id=$id' class='dj-t-color-green'>$ime</a></span></p>";
                        }
                    }


                        ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

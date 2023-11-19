<?php
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
 if(isset($_GET['table'])){
     $tabela=$_GET['table'];
     if($tabela=="product_color" || $tabela=="product_cart" || $tabela=="cart"){
         return;
     }
 }
?>

<div class="col-lg-12 mt-5">
    <div class="container">
        <div class="row">
            <?php
            $upit_za_dohvatanje_kolona="SHOW COLUMNS FROM $tabela";
            $rezultat_upita=$konekcija->query($upit_za_dohvatanje_kolona)->fetchAll();
            $niz_kolona=array();
            foreach ($rezultat_upita as $row){
//                if(!strpos($row['Field'],"_id")){
//                    $niz_kolona[]=$row['Field'];
//                }
                $niz_kolona[]=$row['Field'];

            }

            ?>

            <h2 class="title-1 m-b-25 mt-5"><?php echo ucfirst($tabela) ?></h2>
            <div class="table-responsive table--no-card m-b-40">
                <button class="btn btn-primary mb-3 insert" data-table="<?php echo $tabela ?>">Insert</button>
                <?php
                 if($tabela=="users"):
                ?>
                 <button class="btn btn-secondary mb-3" id="laki_kitica">Banned</button>
                <?php endif; ?>
                <table class="table table-borderless table-striped table-earning" id="dataTable">
                    <thead>
                    <tr>
                        <?php
                        foreach ($niz_kolona as $item):
                            if(strpos($item,"_id")):
                                $broj = strpos($item, "_id");
                                $samo_ime = substr($item, 0, $broj);
                                $samo_ime .= " name";
                                var_dump($samo_ime);
                            ?>
                            <th><?=$samo_ime?></th>
                        <?php else: ?>
                        <th><?=$item?></th>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        $upit_za_dohvatanje_vrednosti="SELECT * FROM $tabela";
                        $rezultat_za_dohvatanje_vrednosti=$konekcija->query($upit_za_dohvatanje_vrednosti)->fetchAll();
                        ?>

                        <?php
                        foreach ($rezultat_za_dohvatanje_vrednosti as $item):
                        echo "<tr>";
                        foreach ($niz_kolona as $kolona):
                            if($kolona=="product_id"){
                                $id=$item[$kolona];
                                $upit="SELECT name FROM products WHERE id='$id'";
                                $rezultat=$konekcija->query($upit)->fetch();
                                echo "<td>$rezultat[0]</td>";
                                continue;
                            }
                            else if($kolona=="specification_id"){
                                $id=$item[$kolona];
                                $upit="SELECT name FROM specifications WHERE id='$id'";
                                $rezultat=$konekcija->query($upit)->fetch();
                                echo "<td>$rezultat[0]</td>";
                                continue;
                            }
                            else if($kolona=="brand_id"){
                                $id=$item[$kolona];
                                $upit="SELECT name FROM brand WHERE id='$id'";
                                $rezultat=$konekcija->query($upit)->fetch();
                                echo "<td>$rezultat[0]</td>";
                                continue;
                            }
                            else if($kolona=="gender_id"){
                                $id=$item[$kolona];
                                $upit="SELECT name FROM gender WHERE id='$id'";
                                $rezultat=$konekcija->query($upit)->fetch();
                                echo "<td>$rezultat[0]</td>";
                                continue;
                            }
                            else if($kolona=="role_id"){
                                $id=$item[$kolona];
                                $upit="SELECT name FROM role WHERE id='$id'";
                                $rezultat=$konekcija->query($upit)->fetch();
                                echo "<td>$rezultat[0]</td>";
                                continue;
                            }
                            if($kolona=="banned" && $item[$kolona]=="1"){
                                echo "<td>Banned</td>";
                                continue;
                            }
                            else if($kolona=="banned" && $item[$kolona]=="0"){
                                echo "<td>Not banned</td>";
                                continue;
                            }
                            if($tabela=="brand" && $kolona=="description"){
                             echo "<td class='smanjiWidth2'>$item[$kolona]</td>";
                             continue;
                            }

                            $dodajKlasu = $kolona == "description" ? "smanjiWidth" : "";
                            if(substr($item[$kolona],-4)==".png" || substr($item[$kolona],-4)==".jpg" || substr($item[$kolona],-5)==".jpeg"):
                                ?>
                                <td>
                                    <img src="../../../assets/images/img-resize/<?=$item[$kolona]?>" alt="<?=$item[$kolona]?>" class="dj-t-resize-width"/>
                                </td>
                            <?php
                            else:
                                ?>
                                <td class="<?php echo $dodajKlasu ?>"><?=$item[$kolona]?></td>
                            <?php endif; ?>

                        <?php endforeach; ?>
                        <td>
                            <button class="btn btn-danger delete"  data-id="<?=$item['id']?>" data-table="<?=$tabela?>">Delete</button>
                        </td>
                        <td>
                            <button href="indexAdmin.php" data-table="<?=$tabela?>" data-id="<?=$item['id']?>"  class="btn btn-warning updates">Update</button>
                        </td>
                    </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="dj-t-8" style="overflow-y:scroll;" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:150%;">
            <div class="modal-header">
                <h5 class="modal-title">History of purchase</h5>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if($konekcija){
                    $upit="SELECT p.id, p.first_name,p.last_name,p.email,r.name FROM users p INNER JOIN role r ON p.role_id=r.id WHERE p.banned='1'";
                    $rezultat=$konekcija->query($upit)->fetchAll();
                    if($rezultat){
                        $total=0;
                        echo "<table class='table table-bordered'>
                 <thead>
                 <tr>
                 <th>First Name</th>
                 <th>Last Name</th>
                 <th>Email</th>
                 <th>Role</th>
                 <th>Unban</th>
                 </tr>
                 </thead>
                 <tbody>
                ";
                        foreach($rezultat as $element){
                            echo "
                        <tr>
                        <td>".$element['first_name']."</td>
                        <td>".$element['last_name']."</td>
                        <td>".$element['email']."</td>
                        <td>".$element['name']."</td>
                        <td><button class='btn btn-secondary unban_buttons' data-id=".$element['id'].">Unban</button></td>
                        </tr>";
                        }
                        echo "</tbody>
                </table>";
                    }
                    else{
                        echo "<p>The are no banned user</p>";
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="Odbij5">Close</button>
            </div>
        </div>
    </div>
</div>

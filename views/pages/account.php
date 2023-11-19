<?php
 if(empty($_SESSION["korisnik"])){
     header("Location:index.php?page=home");
 }
?>
<?php
 if(isset($_GET['id'])){
     $id=$_GET['id'];
 }
 else{
     header("location:index.php?page=home");
 }
?>

<body>
  <?php

   if($konekcija){
       $upit_za_dohvatanje_korisnika="SELECT u.id,u.first_name,u.last_name,u.email,u.picture, r.name FROM users u INNER JOIN role r ON u.role_id=r.id WHERE u.id='$id' ";
       $rezultat_upita=$konekcija->query($upit_za_dohvatanje_korisnika)->fetch();
   }
  ?>
    <div class="container dj-t-margin-top50 dj-t-margin-bottom50">
        <div class="row">
            <div class="col-md-4">
                <img src="assets/images/<?php echo $rezultat_upita['picture']; ?>" alt="Profilna slika" class="profile-image">
            </div>
            <div class="col-md-8">
                <!-- Osnovne informacije o korisniku -->
                <h2>Basic information</h2>
                <div class="basic-info">
                    <p><strong>First Name: </strong> <?php  echo $rezultat_upita['first_name'] ?></p>
                    <p><strong>Last Name: </strong><?php  echo $rezultat_upita['last_name'] ?></p>
                    <p><strong>Email Adress: </strong><?php  echo $rezultat_upita['email'] ?></p>
                    <p><strong>Role Name: </strong><?php  echo $rezultat_upita['name'] ?></p>
                </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-6">
                <!-- Forma za izmenu podataka -->
                <h2>Data modification</h2>
                <form action="update_profile.php" method="post" class="edit-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="ime">First Name:</label>
                        <input type="text" class="form-control" id="ime" name="ime" value="<?php  echo $rezultat_upita['first_name'] ?>">
                        <p class="dj-t-none">Your first name is not in good format Example:<?php echo $rezultat_upita['first_name'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="prezime">Last Name:</label>
                        <input type="text" class="form-control" id="prezime" name="prezime" value="<?php  echo $rezultat_upita['last_name'] ?>">
                        <p class="dj-t-none">Your last name is not in good format Example:<?php echo $rezultat_upita['last_name'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php  echo $rezultat_upita['email'] ?>">
                        <p class="dj-t-none">Your email is not in good format Example:<?php echo $rezultat_upita['email'] ?></p>
                    </div>
                    <div class="form-group">
                        <label for="picture">Insert Picture</label>
                        <input type="file" class="form-control" name="picture" id="picture">
                        <p class="dj-t-none">Your extensions must be .jpg,.png,.jpeg</p>
                    </div>
                    <button type="button" class="btn btn-primary" id="save">Save</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Dugme za pregled istorije kupovina -->
                <h2>History of buying</h2>
                <a href="#" class="btn btn-secondary history-button">Show history of buying</a>
                <div class="modal" id="dj-t-5" style="overflow-y:scroll;" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">History of purchase</h5>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                if($konekcija){
                                    $upit="SELECT name,price,quantity,date_of_purchase FROM products p INNER JOIN product_cart pc ON p.id=pc.product_id INNER JOIN cart c ON pc.cart_id=c.id INNER JOIN product_price pr ON p.id=pr.product_id WHERE user_id=".$_SESSION['korisnik'][0].". AND dateTo is null";
                                    $rezultat=$konekcija->query($upit)->fetchAll();
                                    if($rezultat){
                                        $total=0;
                                        echo "<table class='table table-bordered'>
                 <thead>
                 <tr>
                 <th>Product name</th>
                 <th>Quantity</th>
                 <th>Price</th>
                 <th>Total</th>
                 <th>Date of purchase</th>
                 </tr>
                 </thead>
                 <tbody>
                ";
                                        foreach($rezultat as $element){
                                            echo "<tr>
                        <td>".$element['name']."</td>
                        <td>".$element['quantity']."</td>
                        <td>".$element['price']."</td>
                        <td>$".$element['price']*$element['quantity']."</td>
                        <td>".$element['date_of_purchase']."</td>
                    
                    </tr>
                    ";
                                            $total+=$element['price']*$element['quantity'];
                                        }
                                        echo "</tbody>
                </table>
                <h3 style='text-align:center;'>Total: $".$total."</h3>
                ";
                                    }
                                    else{
                                        echo "<p>The are no products</p>";
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
            </div>
        </div>
    </div>


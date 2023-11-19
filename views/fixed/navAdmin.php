
<?php
$dohvatanje_tabela="SHOW TABLES FROM luxury_watches";
$rezultat_tabele=$konekcija->query($dohvatanje_tabela)->fetchAll();
$niz_tabela=array();
foreach ($rezultat_tabele as $table) {
    if($table['Tables_in_luxury_watches']=="product_color" || $table['Tables_in_luxury_watches']=="product_cart" || $table['Tables_in_luxury_watches']=="cart"){
        continue;
    }
    else{
        $niz_tabela[] = $table['Tables_in_luxury_watches'];
    }
}
?>
<nav class="navbar-sidebar">
    <ul class="list-unstyled navbar__list">
        <li class="active has-sub">
            <a class="js-arrow" href="indexAdmin.php?table=none">Home</a>
        </li>
        <?php
        foreach ($niz_tabela as $table):
        ?>
        <li class="active has-sub">
            <a class="js-arrow" href="indexAdmin.php?table=<?=$table?>"><?=ucfirst($table)?></a>
        </li>
        <?php
        endforeach;
        ?>
        <li>
            <a class="js-arrow" href="../../../index.php?page=home">Go back to site</a>
        </li>
        </li>
    </ul>

</nav>
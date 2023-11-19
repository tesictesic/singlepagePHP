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
<div class="main-content">
    <div class="section__content section__content--p30">
        <h1 class="text-center mb-3">Information about site</h1>
        <div class="container-fluid">
             <div class="container">
                 <div class="row">
                     <?php
                     $ceo_fajl=file("../../../data/log.txt");
                     $currentDateTime = time();
                     $previousDateTime = $currentDateTime - (24 * 60 * 60);
                     $visits = 0;
                     $users=0;
                     $pageVisits=array();
                     foreach ($ceo_fajl as  $item) {
                         $podaci=explode("\t",$item);
                             $dateTime = DateTime::createFromFormat('d. m. Y. H:i:s',$podaci[1]);
                            if($dateTime instanceof DateTime){
                                $timestamp=$dateTime->getTimestamp();
                                if ($timestamp >= $previousDateTime &&$timestamp<=$currentDateTime){
                                    $page=$podaci[0];
                                    if(isset($pageVisits[$page])){
                                        $pageVisits[$page]++;
                                    }
                                    else{
                                        $pageVisits[$page]=1;
                                    }

                                }
                            }

                         }
                     ?>
                     <table class="table  table-dark">
                         <thead>
                         <tr>
                             <th>#</th>
                             <th>Site</th>
                             <th>Visit in the last 24h</th>
                             <th>Visit by percentage</th>
                         </tr>
                         </thead>
                         <tbody>
                        <?php
                        $total_visits=array_sum($pageVisits);
                        $brojac=0;
                        foreach($pageVisits as $page=>$visit):
                            $brojac++;
                        $percentage=($visit/$total_visits)*100;
                        ?>
                         <tr>
                             <th scope="row"><?=$brojac?></th>
                             <td><?=$page?></td>
                             <td><?=$visit?></td>
                             <td><?=round($percentage,2)?>%</td>

                         </tr>

                         <?php endforeach; ?>
                         </tbody>
                     </table>
                     <div class="my-4">
                         <?php

                            $ceo_fajl = file("../../../data/ulogovani_korisnici.txt");
                            $currentDateTime = time();
                            $previousDateTime = $currentDateTime - (24 * 60 * 60);
                            $brojKorisnika = 0;
                            foreach ($ceo_fajl as $red) {
                                $podaci = explode("\t", $red);
                                $vreme_unosa=intval($podaci[1]);
                                if ($vreme_unosa >= $previousDateTime && $vreme_unosa <= $currentDateTime) {
                                    $brojKorisnika++;
                                }
                            }
                            ?>
                         <h4>Number of users in last 24h: <?php echo $brojKorisnika ?></h4>
                     </div>
                 </div>
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

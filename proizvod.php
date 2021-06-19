<?php
    include_once "pages/head.php";
    include_once "pages/header.php";
    include "konekcija/konekcija.php";
    
    global $konekcija;

    $id = intval($_GET['id']);
    $upit = "SELECT p.*, s.src, s.alt
    FROM `proizvodi` p INNER JOIN `slike` s
    ON p.idSlika = s.idSlika 
    WHERE p.idProizvod = $id";

    $podaci = $konekcija->query($upit)->fetch();
?>
<body>
    <div id="proizvod" class="container-fluid d-flex justify-content-around align-items-center bg-light">
        <div id="levo">
            <h1><?=$podaci->naziv?></h1>
            <p class="mt-3"><?php
                if($podaci->opis == null)
                {
                    echo "Proizvod nema opis";
                }
                else
                {
                    echo $podaci->opis;
                }
            ?></p>
            <p class="mt-3">Cena <?=$podaci->cena?> RSD</p>
        </div>
        <div id="desno" class="border mt-3 mb-3">
            <img src="<?='images/proizvodi/'.$podaci->src?>" alt="<?='images/proizvodi/'.$podaci->alt?>" class="img-fluid"/>
        </div>
    </div>
    <?php
        include_once "pages/footer.php";
    ?>
</body>

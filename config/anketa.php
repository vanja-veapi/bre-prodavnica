<?php
    session_start();
    $korsinik = $_SESSION['korisnik'];

    include "../konekcija/konekcija.php";
    // if(isset($_POST['idAnketa']))
    // {
        $idOdgovor = (int)$_POST['idOdgovorPHP'];
        $idKorisnik = (int)$korsinik->idKorisnik;

        if($konekcija)
        {
            try
            {
                $upit = $konekcija->prepare("INSERT INTO korisnici_odgovori (idOdgovor, idKorisnik) VALUES(:idOdgovor, :idKorisnik)");
                $upit->bindParam(":idOdgovor", $idOdgovor);
                $upit->bindParam(":idKorisnik", $idKorisnik);
                $upit->execute();
            }
            catch(PDOExcepction $ex)
            {
                http_response_code(500);
                echo $ex->getMessage();
                echo "PORUKA GRESKA";
            }
        }
        else
        {
            echo "<h1>GRESKA, LOSA KONEKCIJA</h1>";
        }
    //}
?>
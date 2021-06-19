<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../konekcija/konekcija.php";
        include "functions.php";

        if(isset($_POST['id']))
        {
            $idKorisnik = $_POST['id'];
            //var_dump($id);
            $brisanje = brisanjeKorisnika("korisnici", "idKorisnik", $idKorisnik);
            if($brisanje)
            {
                http_response_code(204);
            }
            else
            {
                http_response_code(500);
            }
        }
    }

?>
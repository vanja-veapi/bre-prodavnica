<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../konekcija/konekcija.php";
        include "functions.php";

        try
        {
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $email = $_POST['email'];
            $lozinka = $_POST['lozinka'];
            $idPol = $_POST['pol'];
            $idUloga = $_POST['uloga'];

            $sifrovanaLozinka = md5($lozinka);

            $unosKorisnika = unosKorisnika($ime, $prezime, $email, $sifrovanaLozinka, $idUloga);

            if($unosKorisnika)
            {
                $odgovor = ["poruka" => "Uspesno ste se dodali korisnika u bazu", "kod" => true];
                echo json_encode($odgovor);
                http_response_code(201);
            }

        }
        catch(PDOExcepction $ex)
        {
            http_response_code(500);
        }
    }
    else
    {
        http_response_code(404);
    }
?>
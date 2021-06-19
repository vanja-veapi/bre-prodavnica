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

            $sifrovanaLozinka = md5($lozinka);

            $reFirstLastName = "/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/";
            $rePassword="/^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
            $reMail="/^[a-z][a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/";
            $rePassword = "/^[A-z]{4,20}[0-9]{1}/";

            $error_message = "";

            if(!preg_match($reFirstLastName, $ime))
            {
                $error_message.= "Polje ime nije u dobrom formatu<br/>";
            }
            if(!preg_match($reFirstLastName, $prezime))
            {
                $error_message.= "Polje prezime nije u dobrom formatu<br/>";
            }
            if(!preg_match($reMail, $email))
            {
                $error_message.= "Polje email nije u dobrom formatu<br/>";
            }
            if(!preg_match($rePassword, $lozinka))
            {
                $error_message.= "Polje lozinka nije u dobrom formatu<br/>";
            }
            if(strlen($error_message) > 0) 
            {
                $odgovor = ["poruka" => $error_message, "kod" => false];
                echo json_encode($odgovor);
                // echo $error_message;
                die();
            }

            $unosKorisnika = unosKorisnika($ime, $prezime, $email, $sifrovanaLozinka, 2);
            
            if($unosKorisnika)
            {
                $odgovor = ["poruka" => "Uspesno ste se registrovali", "kod" => true];
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
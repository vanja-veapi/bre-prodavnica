<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "../konekcija/konekcija.php";
        include "functions.php";

        try
        {
            if(isset($_POST['id']))
            {
                if($konekcija)
                {
                    $cena = $_POST['cena'];
                    $idProizvod = $_POST['id'];
                    
                    if($cena <= 200 || $cena >= 10000)
                    {
                        $odgovor = ["poruka" => "Cena ne sme da bude manja od 200 dinara ili veća od 10000 dinara. IlI ste pokušali da unesete nedozvoljene karaktere"];
                        echo json_encode($odgovor);
                    }
                    else
                    {
                        $upit = "UPDATE proizvodi
                            SET cena = :cena
                            WHERE idProizvod = :id";
                        $priprema = $konekcija->prepare($upit);
                        $priprema->bindParam(":cena", $cena);
                        $priprema->bindParam(":id", $idProizvod);
                        $priprema->execute();

                        $odgovor = ["poruka" => "Uspesno ste izmenili podatke"];
                        echo json_encode($odgovor);
                    }
                }
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
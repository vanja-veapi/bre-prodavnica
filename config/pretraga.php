<?php
    header("Content-type: application/json");
    
    if(isset($_POST['dugme']))
    {
        $vrednost = $_POST['vrednost'];

        if($konekcija)
        {
            try
            {
                $upit = "SELECT `p`.*, `s`.*, `pv`.*, `v`.*
                FROM `proizvodi` AS `p` 
                    LEFT JOIN `slike` AS `s` ON `p`.`idSlika` = `s`.`idSlika` 
                    LEFT JOIN `proizvodi_velicina` AS `pv` ON `pv`.`idProizvod` = `p`.`idProizvod` 
                    LEFT JOIN `velicina` AS `v` ON `pv`.`idVelicina` = `v`.`idVelicina`
                WHERE p.naziv LIKE LOWER('%".$vrednost."%')";
                $proizvodi = $konekcija->query($upit)->fetchAll();
                echo json_encode($proizvodi);
                // var_dump(json_encode($proizvodi));
            }
            catch(Excepction $ex)
            {
                http_response_code(500);
            }
        }
    }
?>
<?php
    //include("konekcija/konekcija.php");
    include "konekcija/konekcija.php";
    if(isset($_POST["action"]))
    {
        if(isset($_POST["velicine"]))
        {
        $velicine_filter = implode("','", $_POST["velicine"]);
        
        //$query = " AND proizvodi IN('".$velicine_filter."')";
        $query = "SELECT `p`.*, `s`.*, `pv`.*, `v`.*
                FROM `proizvodi` AS `p` 
                LEFT JOIN `slike` AS `s` ON `p`.`idSlika` = `s`.`idSlika` 
                LEFT JOIN `proizvodi_velicina` AS `pv` ON `pv`.`idProizvod` = `p`.`idProizvod` 
                LEFT JOIN `velicina` AS `v` ON `pv`.`idVelicina` = `v`.`idVelicina`
                WHERE pv.idVelicina IN('".$velicine_filter."')";
        }
        if(empty($velicine_filter))
        {
            $output = "";
            $query = "SELECT `p`.*, `s`.*, `pv`.*, `v`.*
                FROM `proizvodi` AS `p` 
                LEFT JOIN `slike` AS `s` ON `p`.`idSlika` = `s`.`idSlika` 
                LEFT JOIN `proizvodi_velicina` AS `pv` ON `pv`.`idProizvod` = `p`.`idProizvod` 
                LEFT JOIN `velicina` AS `v` ON `pv`.`idVelicina` = `v`.`idVelicina`";
                $proizvodi = $konekcija->query($query)->fetchAll();
                foreach($proizvodi as $proizvod)
                {
                    $output .="<article class='w-50 border mr-2 mb-3 col-lg-3 pt-3 pb-3 proizvodi'>
                                            <a href='proizvod.php/?id=$proizvod->idProizvod'><img src='images/proizvodi/$proizvod->src' alt='$proizvod->alt' class='img-fluid mb-2'/></a>
                                            <p>Naziv: $proizvod->naziv</p>
                                            <p>Veličina: $proizvod->velicina</p>
                                            <p>Cena: $proizvod->cena dinara</p>
                                            <input type='button' class='btn btn-primary mt-2' value='Add to cart'/>
                                        </article>";
                    
                }
        }
        else
        {
            $proizvodi = $konekcija->query($query)->fetchAll();
            $output = "";
            
            foreach($proizvodi as $proizvod)
            {
                $output .="<article class='w-50 border mr-2 mb-3 col-lg-3 pt-3 pb-3 proizvodi'>
                                        <a href='proizvod.php/?id=$proizvod->idProizvod'><img src='images/proizvodi/$proizvod->src' alt='$proizvod->alt' class='img-fluid mb-2'/></a>
                                        <p>Naziv: $proizvod->naziv</p>
                                        <p>Veličina: $proizvod->velicina</p>
                                        <p>Cena: $proizvod->cena dinara</p>
                                        <input type='button' class='btn btn-primary mt-2' value='Add to cart'/>
                                    </article>";
                
            }
        }
        
        $total_row = count($proizvodi);
        if($total_row == 0)
        {
            $output = '<h3 style="color:red">No Data Found</h3>';
        }
        echo json_encode($output);
    }
?>
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
                LEFT JOIN `velicina` AS `v` ON `pv`.`idVelicina` = `v`.`idVelicina`";
        $proizvodi = $konekcija->query($query)->fetchAll();
        }
        //WHERE `p` IN('".$velicine_filter."')
        //var_dump($velicine_filter);
    
        
    
        //$total_row = count($proizvodi);
        $output = '';
        // if($total_row > 0)
        // {
        foreach($proizvodi as $proizvod)
        {
            $output .=`
            <article class='w-50 border mr-2 mb-3 col-lg-3 pt-3 pb-3 proizvodi'>
                                    <a href='proizvod.php/?id=$proizvod->idProizvod'><img src='images/proizvodi/$proizvod->src' alt='$proizvod->alt' class='img-fluid mb-2'/></a>
                                    <p>Naziv: $proizvod->naziv</p>
                                    <p>Veličina: $proizvod->velicina</p>
                                    <p>Cena: $proizvod->cena dinara</p>
                                    <input type='button' class='btn btn-primary mt-2' value='Add to cart'/>
                                </article>`;
            //}
        }
        // else
        // {
        // $output = '<h3 style="color:red">No Data Found</h3>';
        // }
        echo $output;
    }
?>
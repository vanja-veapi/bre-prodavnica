<?php
    session_start();
    include("pages/head.php");
    include_once("pages/header.php");
    //include "config/functions.php";
    //include "config/filtriranje.php";
    //include("konekcija/konekcija.php");
    include "filtriranje.php";
?>
    <div id="searchDiv" class="container-fluid pt-3 pb-3">
    <form>
        <input type="text" name="search" id="search" placeholder="Pretraga" class="w-100 pl-3 pt-2 pb-2">
        <button id="sendBtn" name="sendBtn" class="btn btn-danger mt-3" > Search </button>
    </form>
    </div>
    <div id="prodavnica" class="container-fluid d-flex">
        <section id="meni">
            <table>
                <?php
                    if($konekcija)
                    {
                        $velicinaId = vratiSve("velicina");
                        foreach($velicinaId as $vel)
                        {
                            echo "<tr>
                                <td><input type='checkbox' id='velicina$vel->idVelicina' value='$vel->idVelicina' name='$vel->velicina' class='velicine common_selector'/></td>
                                <td><label>$vel->velicina</label><td>
                            </tr>";
                        }
                    }
                    else
                    {
                        echo "Greska";
                    }
                ?>
            </table>    
            
            <!-- <div id="sortiranje" class="mt-3">
                <select name="sort" id="sort">
                    <option value="asc">Rastuće</option>
                    <option value="desc">Opadajuće</option>
                </select>
            </div> -->
        </section>

        <section id="proizvodi" class="d-flex justify-content-around w-100 row ml-3 mt-4">
            <?php
                if($konekcija)
                {
                    //$query = "SELECT * FROM proizvodi p, slike s WHERE p.idSlika = s.idSlika";
                    $query = "SELECT `p`.*, `s`.*, `pv`.*, `v`.*
                    FROM `proizvodi` AS `p` 
                        LEFT JOIN `slike` AS `s` ON `p`.`idSlika` = `s`.`idSlika` 
                        LEFT JOIN `proizvodi_velicina` AS `pv` ON `pv`.`idProizvod` = `p`.`idProizvod` 
                        LEFT JOIN `velicina` AS `v` ON `pv`.`idVelicina` = `v`.`idVelicina`";
                    $proizvodi = $konekcija->query($query)->fetchAll();
                    foreach($proizvodi as $proizvod)
                    {
                        echo "<article class='w-50 border mr-2 mb-3 col-lg-3 pt-3 pb-3 proizvodi'>
                            <a href='proizvod.php?id=$proizvod->idProizvod'><img src='images/proizvodi/$proizvod->src' alt='$proizvod->alt' class='img-fluid mb-2'/></a>
                            <p>Naziv: $proizvod->naziv</p>
                            <p>Veličina: $proizvod->velicina</p>
                            <p>Cena: $proizvod->cena dinara</p>
                        </article>";
                    }
                }
                else
                {
                    echo "<h1>Konekcija nije uspostavljena</h1>";
                }
            ?>
            <!-- <article class="w-50 border mr-2 mb-3 col-lg-3">
                <img src="images/galerija/slika1.jpg" alt="Proizvod 1" class="img-fluid"/>
                <p>Naziv: Majica</p>
                <p>Veličina: L</p>
                <p>Cena: 300 dinara</p>
            </article> -->
        </section>
    </div>
<?php
    include_once("pages/footer.php");
?>

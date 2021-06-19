<?php
    session_start();   
    include "headAdminPanel.php";
    //include "header.php";
    //header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        include "../konekcija/konekcija.php";
        include "../config/functions.php";
        //include "../config/login.php";

        if($konekcija)
        {
            //Ukupan broj glasova
            $upit1 = "SELECT COUNT(idKorisnikOdgovori) AS ukupanBrojOdgovora FROM korisnici_odgovori";
            $rezultat1 = $konekcija->query($upit1)->fetch();
            $brojGlasalih = $rezultat1->ukupanBrojOdgovora;

            //Ukupno pojedinacnih odgovora
            $upit2 = "SELECT o.odgovor AS odgovor, COUNT(ko.idOdgovor) AS idOdgovor
                    FROM korisnici_odgovori AS ko INNER JOIN odgovori o 
                    ON ko.idOdgovor = o.idOdgovor
                    GROUP BY ko.idOdgovor";
            $rezultat2 = $konekcija->query($upit2)->fetchAll();

            $upit3 = "SELECT * FROM anketa";
            $rezultat3 = $konekcija->query($upit3)->fetchAll();

            if(isset($_SESSION['korisnik']))
            {   
                $korisnik = $_SESSION['korisnik'];
                // var_dump($_SESSION['korisnik']);
                if($korisnik->naziv == "admin")
                {
                    //var_dump($korisnik->ime);
                    echo "<div id='top' class='d-flex justify-content-around'><h5 class='mb-5 ml-3 w-5'>$korisnik->ime, dobrodošli na admin panel.</h5>
                    <div id='nazad'><a href='../index.php' class='btn btn-danger'>Početna</a></div>
                </div>";
                    echo "<br/>
                            </br>
                                <div class='w-50 m-auto'>
                                    <p class='h2 mb-3'>Rezultati Ankete:</p>";
                                    foreach($rezultat3 as $red)
                                    {
                                        echo "<p class='mb-2'>Pitanje: $red->pitanje</p>";
                                    }
                                    foreach($rezultat2 as $red)
                                    {
                                        $procenat = $red->idOdgovor/$brojGlasalih*100;
                                        echo "Za odgovor <b>".strtoupper($red->odgovor)."</b> je glasalo ".sprintf("%.2f",$procenat)."% ljudi<br/>";
                                    }
                                    echo "
                                        </div>
                                    <br/>
                                    <br/>";
?>
<div id="podaci" class="w-50 m-auto">
    <h2>Podaci o korisnicima</h2>

    <table class='table table-striped border'>
        <tr>
            <th class="col">ID</th>            
            <th class="col">Ime</th>
            <th class="col">Prezime</th>
            <th class="col">Email</th>
            <th class="col">Uloga</th>
            <th class="col">Obriši</th>
        </tr>
<?php
    if($konekcija)
    {
        $korisnici = vratiSve("korisnici");
        foreach($korisnici as $korisnik)
        {
            echo "<tr>
            <td>$korisnik->idKorisnik</td>
            <td>$korisnik->ime</td>
            <td>$korisnik->prezime</td>
            <td>$korisnik->email</td>";
            if($korisnik->idUloga == 1)
            {
                echo "<td>Admin</td>";
            }
            if($korisnik->idUloga == 2)
            {
                echo "<td>Korisnik</td>";
            }
            echo "<td><input type='button' class='btn btn-danger btnDelete' name='$korisnik->idKorisnik' value='Obriši korisnika'/></td>";
            echo "</tr>";
        }
    }
?>
    </table>
</div>

<div id="dodaj" class="w-50 m-auto">
    <h2 class="mt-4">Dodaj korisnika</h1>
    <form action="">
        <input type="text" name="ime" id="ime" class="form-control mb-3" placeholder="Ime korisnika..."/>
        <input type="text" name="prezime" id="prezime" class="form-control mb-3" placeholder="Prezme korisnika..."/>
        <input type="password" name="lozinka" id="lozinka" class="form-control mb-3" placeholder="Sifra korisnika..."/>
        <input type="text" name="email" id="email" class="form-control mb-3" placeholder="Email korisnika..."/>
        <select name="uloga" id="uloga" class="custom-select">
            <option value="1">Admin</option>
            <option value="2">Korisnik</option>
        </select>
        <input type="button" id="btnDodaj" value="Dodaj korisnika" class="btn btn-danger mt-3 mb-3"/>
    </form>
    <div id="odgovor"></div>
</div>
<div id="podaci-prodavnica" class="w-50 pt-5 m-auto">
    <table class='table table-striped border'>
        <tr>           
            <th class="col">Opis</th>
            <th class="col">Naziv proizvoda</th>
            <th class="col">Cena</th>
            <th class="col">Updateuj</th>
        </tr>
    <?php
        $proizvodi = vratiSve("proizvodi");
        foreach($proizvodi as $proizvod)
        {
            echo "<tr>
                    <td><p>$proizvod->naziv</p></td>
                    <td><p>$proizvod->opis</p></td>
                    <td><input type='text' value='$proizvod->cena'/></td>
                    <td><input type='button' class='btn btn-danger btnUpdate' name='$proizvod->idProizvod' value='Update'/>
                </tr>";
        }
    ?>
    </table>
</div>
<?php
            include "footerAdminPanel.php";
            } // if korisnik naziv == admin
        } // if isset korisnik
    } // if konekcija
    } // request method
    else
    {
        echo "Sine de si posao, ajde idi nazad <a href='../index.php'>Pocetna stranica</a>";
    }
?>

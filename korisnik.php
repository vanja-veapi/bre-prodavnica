<?php
    session_start();
    include "pages/head.php";
    include "pages/header.php";

    $korisnik = $_SESSION['korisnik'];
    if(isset($_POST['btnLogin']))
    {
        if($korisnik->naziv == "korisnik")
        {

        
            echo "<h1>Pozdrav $korisnik->ime, dobrodošli nazad!</h1>";

            $upit = "SELECT * FROM korisnici_odgovori ko INNER JOIN odgovori o
            ON ko.idOdgovor = o.idOdgovor
            WHERE ko.idKorisnik = '$korisnik->idKorisnik'";
            $podaci = $konekcija->query($upit);
            if($konekcija)
            {
                echo "<div id='anketa'>";
                if($podaci->rowCount() == 0)
                {
                    $pitanje = vratiSve("anketa");
                    foreach($pitanje as $red)
                    {
                        echo "<p class='mt-5 h4'>$red->pitanje</p>";
                    }
                    $odgovori = vratiSve("odgovori");
                    foreach($odgovori as $red)
                    {
                        echo "<label>$red->odgovor</label>
                        <input type='radio' name='odgovor' value='$red->idOdgovor' class='mr-3'/>";
                    }
                    echo "<br/><button id='btnOdgovor' value='$red->idAnketa' class='btn btn-danger mb-5'>Submit</button>";
                    echo "</div>";
                }
                else if($podaci->rowCount() == 1)
                {
                    echo "<p class='mt-4 mb-4 ml-4'>Već ste odgovorili na anketu. Trenutno nemamo novih anketa. Pozdrav</p>";
                }
            }
            else
            {
                echo "Greska!";
                die();
            }
?>
<div class="container border mb-5 pb-4">
    <p class="h1 text-center text-uppercase mt-2">Upload slike</p>
    <form action="config/upload.php" method="POST" enctype="multipart/form-data" name="uploadform">
        <input type="file" name="userfile" id="userfile"/>
        <input type="submit" value="Uploaduj" name="upload"/>
    </form>
    <table class="mt-5 w-100">
        <tbody class="d-table m-auto">
            <?php
                    $uploadovaneSlike = vratiSve("upload_file_server");

                    if($konekcija)
                    {
                        foreach($uploadovaneSlike as $slika)
                        {
                            if($slika->idKorisnik == $korisnik->idKorisnik)
                            {
                                echo "<tr>
                                    <td><img src=".substr($slika->path, 3)." alt='$slika->path' width='300'/>
                                </tr>";
                            }
                        }
                    }
        }
    } //isset BTNLOGIN
    else
    {
        echo "Sine desi posao idi nazad <a href='bre/index.php'>nazad</a>";
    }
            ?>
        </tbody>
    </table>
</div>
<?php
    include "pages/footer.php";
?>
<?php
    $uploadDir = "../uploads/";

    if(isset($_POST['upload']))
    {
        session_start();
        $korisnik = $_SESSION['korisnik'];
        // echo $korisnik->idKorisnik."</br>";

        $fileName = $_FILES['userfile']['name'];
        $tmpName = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        
        
        $filePath = $uploadDir.time()."-".$fileName;

        $result = move_uploaded_file($tmpName, $filePath);

        if($result == true && $filePath == addslashes($filePath))
        {
            echo "Uspesno ste uploadovali sliku<br/><a href='../korisnik.php'>Nazad na korisiničku stranicu</a>";
        }
        else
        {
            echo "Upload slika nije uspeo<br/>
            Proverite da li vasa slika ima nedozvoljene karaktere (npr. '\')
            <br/><br/>
            <a href='../korisnik.php'>Nazad na korisiničku stranicu</a>";
            die();
        }

        include "../konekcija/konekcija.php";
        $fileName = addslashes($fileName);
        $filePath = addslashes($filePath);
        
        $upit = "INSERT INTO upload_file_server (name, size, type, path, idKorisnik) VALUES (:name, :size, :type, :path, :idKorisnik)";

        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(":name", $fileName);
        $priprema->bindParam(":size", $fileSize);
        $priprema->bindParam(":type", $fileType);
        $priprema->bindParam(":path", $filePath);
        $priprema->bindParam(":idKorisnik", $korisnik->idKorisnik);

        $rezultat = $priprema->execute();
        return $rezultat;
    }
?>
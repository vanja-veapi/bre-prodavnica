<?php   
    function vratiSve($nazivTabele)
    {
        global $konekcija;
        $upit = "SELECT * FROM $nazivTabele";
        $podaci = $konekcija->query($upit)->fetchAll();
        return $podaci;
    }

    function unosKorisnika($ime, $prezime, $email, $sifrovanaLozinka, $idUloga)
    {
        global $konekcija;

        $upit = "INSERT INTO korisnici (ime, prezime, email, lozinka, idUloga)
                 VALUES (:ime, :prezime, :email, :lozinka, :idUloga)";

        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':prezime', $prezime);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':lozinka', $sifrovanaLozinka);
        $priprema->bindParam(':idUloga', $idUloga);

        $rezultat = $priprema->execute();
        return $rezultat;
    }

    function proveraLogovanja($email, $sifrovanaLozinka)
    {
        global $konekcija;

        $upit = "SELECT * FROM korisnici k JOIN uloga u ON k.idUloga = u.idUloga
        WHERE k.email = :email AND k.lozinka = :lozinka";

        $priprema = $konekcija->prepare($upit);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':lozinka', $sifrovanaLozinka);
        $priprema->execute();

        $rezultat = $priprema->fetch();
        return $rezultat;
    }

    function brisanjeKorisnika($nazivTabele, $kolona, $id)
    {
        global $konekcija;

        $upit = "DELETE FROM $nazivTabele WHERE $kolona = :id";

        $delete = $konekcija->prepare($upit);
        $delete->bindParam(":id", $id);
        $rezultat = $delete->execute();
        
        return $rezultat;
    }

    // function vratiJednogKorisnika($nazivTabele, $kolona, $sesija)
    // {
    //     global $konekcija;
    //     $upit = "SELECT * FROM $nazivTabele WHERE $kolona = $sesija";
    //     $podaci = $konekcija->query($upit)->fetchAll();
    //     return $podaci;
    // }
?>
<?php
    // session_start();
    if(isset($_SESSION['korisnik']))
    {
        var_dump($_SESSION['korisnik']);
        unset($_SESSION['korisnik']);
        header("location:../index.php");
        exit;
    }
?>
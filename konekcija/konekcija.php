<?php
    include("podaci.php");

    try
    {
        $konekcija = new PDO("mysql:host=$serverBaze;dbname=$dbName", $user, $pass);
        $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch(PDOExcepction $ex)
    {
        echo $ex->getMessage();
    }

?>
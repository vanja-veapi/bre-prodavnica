<?php
    session_start();
    include_once "pages/head.php";
    include_once "pages/header.php";
    // include "config/login.php";
?>
    <div class="container">
        <div class="row">
            <div id="login" class="col-6 mx-auto py-5">
                <h1>Login</h1>
                <form action="" method="POST">
                    <label for="">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>

                    <label for="" class="mt-3">Lozinka</label>
                    <input type="password" id="lozinka" name="lozinka" class="form-control" placeholder="Lozinka"/>

                    <input type="button" value="Uloguj se" id="btnLogin" name="btnLogin" class="btn btn-danger mt-4"/>
                </form>
                <div id="odgovor"></div>
                <?php
                    if(isset($_SESSION['korisnik']))
                    {   

                        $korisnik = $_SESSION['korisnik'];
                        // var_dump($_SESSION['korisnik']);
                        if($korisnik->naziv == "admin")
                        {
                            echo "<a href='pages/admin-panel.php'>Stranica za admina</a>";
                        }
                        if($korisnik->naziv == "korisnik")
                        {
                            echo "<a href='korisnik.php'>Stranica za korisnika</a>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    include_once "pages/footer.php";
?>
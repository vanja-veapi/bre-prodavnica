<?php
    session_start();
    include_once "pages/head.php";
    include_once "pages/header.php";
?>
    <div class="container">
        <div class="row">
            <div id="registracija" class="col-6 mx-auto py-5">
                <h1>Registracija</h1>
                <form action="">
                    <label for="">Ime - Početi prvim velikim slovom</label>
                    <input type="text" id="ime" name="ime" class="form-control" placeholder="Ime"/>

                    <label for="" class="mt-3">Prezime - Početi prvim velikim slovom</label>
                    <input type="text" id="prezime" name="prezime" class="form-control" placeholder="Prezime"/>

                    <label id="labelEmail" for="" class="mt-3">Email </label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>

                    <label for="" class="mt-3">Lozinka (Lozinka mora da ima barem 4 karaktera i 1 broj na kraju)</label>
                    <input type="password" id="lozinka" name="lozinka" class="form-control" placeholder="Lozinka"/>

                    <input type="button" value="Registruj se" id="btnReg" class="btn btn-danger mt-4"/>
                </form>
                <div id="odgovor"></div>
            </div>
        </div>
    </div>
<?php
    include_once "pages/footer.php";
?>
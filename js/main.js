$(document).ready(function(){
    if(window.location.pathname == "bre/index.php")
    {
        let sendMsg = document.getElementById("sendmsg");
        sendMsg.addEventListener("click", function(e){
            e.preventDefault();
            checkForm();
        });
    }

    //filter_data();
    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        //let velicine = document.querySelectorAll(".velicine");
        let velicine = get_filter('velicine');
        // velicine.forEach(e => {
        //     e.addEventListener("click", function(){
        //         let idVel = this.value;
        //         console.log(idVel);
                $.ajax({
                    url:"filtriranje.php",
                    type:"POST",
                    data:{action:action, velicine:velicine},
                    dataType: "json",
                    success: function(result)
                    {
                        $('#proizvodi').html(result);
                    },
                    error: function(xhr)
                    {
                        console.log("GRESKA");
                    }
                });
            //})
        //});
    }
   
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    $('.common_selector').click(function(){
        filter_data();
    });
 
    if(window.location.pathname == "/bre/registracija.php")
    {
        let ime, prezime, lozinka, email;

        ime = document.querySelector("#ime");
        prezime = document.querySelector("#prezime");
        lozinka = document.querySelector("#lozinka");
        email = document.querySelector("#email");

        let btnReg = document.querySelector("#btnReg");
        btnReg.addEventListener("click", function(){
            // registracija(ime, prezime, lozinka, email);
            let counter = 0;
            let valid = true;
            let regExpNameSurname = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,12}$/;
    
            //Ime
            if(ime.value === "")
            {
                valid = false;
                ime.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regExpNameSurname.test(ime.value))
                {
                    valid = false;
                    ime.style.border = "1px solid #ff0000";
                }
                else
                {
                    valid = true;
                    counter++;
                    ime.style.border = "1px solid #00ff00";
                }
            }

            //Prezime
            if(prezime.value === "")
            {
                valid = false;
                prezime.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regExpNameSurname.test(prezime.value))
                {
                    valid = false;
                    prezime.style.border = "1px solid #ff0000";
                }
                else
                {
                    valid = true;
                    counter++;
                    prezime.style.border = "1px solid #00ff00";
                }
            }

            //Sifra
            let regPass = /^[A-z]{4,20}[0-9]{1}/;
            if(lozinka.value === "")
            {
                valid = false;
                lozinka.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regPass.test(lozinka.value))
                {
                    valid = false;
                    lozinka.style.border = "1px solid #ff0000";
                }
                else
                {
                    valid = true;
                    counter++;
                    lozinka.style.border = "1px solid #00ff00";
                }
            }

            //Email
            let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

            if(email.value === "")
            {
                valid = false;
                email.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regExpMail.test(email.value))
                {
                    valid = false;
                    email.style.border = "1px solid #ff0000";   
                }
                else
                {
                    valid = true;
                    counter++;
                    email.style.border = "1px solid #00ff00";
                }
            }
            let labelEmail = document.querySelector("#labelEmail");
            //Zakomentarisao sam counter da bi moglo da se posalje serveru
            // if(counter === 4)
            // {
                var podaciZaSlanje = {
                    ime: ime.value,
                    prezime: prezime.value,
                    email: email.value,
                    lozinka: lozinka.value
                }
                $.ajax({
                    url:"config/registracija.php",
                    type: "POST",
                    data: podaciZaSlanje,
                    dataType: "json",
                    success: function(result)
                    {
                        if(result.kod === false)
                        {
                            odgovor.innerHTML = `<p class='alert alert-danger my-3'>${result.poruka}</p>`;
                        }
                        else if(result.kod === true)
                        {
                            labelEmail.innerHTML = "Email";
                            odgovor.innerHTML = `<p class='alert alert-success my-3'>${result.poruka}</p>`;
                        }
                        console.log(odgovor);
                        console.log("true");
                        console.log(result.kod);
                        console.log(result.poruka);
                    },
                    error: function(xhr)
                    {
                        email.style.border = "1px solid #ff0000";
                        labelEmail.innerHTML = "Email koji ste uneli postoji u nasoj bazi";
                        if(xhr == 404)
                        {
                            ("#registracija").html(`<p class='alert alert-danger'>${xhr}</p>`);
                        }
                        if(xhr == 500)
                        {
                            ("#registracija").html(`<p class='alert alert-danger'>${xhr}</p>`);
                        }
                    }
                });
            // }

        });   
    }

    //Zakomentarisao si regularne izraze u login php delu resi to
    if(window.location.pathname == "/bre/login.php")
    {
        let btnLogin = document.querySelector("#btnLogin");
        btnLogin.addEventListener("click", function()
        {
            let email, lozinka;
            //    let counter = 0;
    
                email = document.querySelector("#email");
                lozinka = document.querySelector("#lozinka");
    
                //regularni izrazi
                //Sifra
                let regPass = /^[a-z]{4,20}[0-9]{1}/;
                if(lozinka.value === "")
                {
                    valid = false;
                    lozinka.style.border = "1px solid #ff0000";
                }
                else
                {
                    if(!regPass.test(lozinka.value))
                    {
                        valid = false;
                        lozinka.style.border = "1px solid #ff0000";
                    }
                    else
                    {
                        valid = true;
                        // counter++;
                        lozinka.style.border = "1px solid #00ff00";
                    }
                }
    
                //Email
                let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;
    
                if(email.value === "")
                {
                    valid = false;
                    email.style.border = "1px solid #ff0000";
                }
                else
                {
                    if(!regExpMail.test(email.value))
                    {
                        valid = false;
                        email.value = "";
                        email.placeholder = "Nije ispravan email";
                        email.style.border = "1px solid #ff0000";   
                    }
                    else
                    {
                        valid = true;
                        // counter++;
                        email.style.border = "1px solid #00ff00";
                    }
                }
            var loginPodaci = {
                email: email.value,
                lozinka: lozinka.value
            };
            $.ajax({
                url:"config/login.php",
                type: "POST",
                data: loginPodaci,
                dataType: "json",
                success: function(result)
                {
                    let odgovor = document.querySelector("#odgovor");
                    if(result.kod === false)
                    {
                        odgovor.innerHTML = `<p class='alert alert-danger my-3'>${result.poruka}</p>`;
                    }
                    else if(result.kod === true)
                    {
                        odgovor.innerHTML = `<p class='alert alert-success my-3'>${result.poruka}</p>`;
                        setTimeout(location.reload(), 3000);
                    }
                    console.log(result);
                },
                error: function(xhr)
                {   
                    email.style.border = "1px solid #ff0000";
                    lozinka.style.border = "1px solid #ff0000";
                    if(xhr == 404)
                    {
                            ("#odgovor").html(`<p class='alert alert-danger'>${xhr}</p>`);
                    }
                    if(xhr == 500)
                    {
                            ("#odgovor").html(`<p class='alert alert-danger'>${xhr}</p>`);
                    }
                }
            });
        });
    }
    
    
    
    if(window.location.pathname === "/bre/pages/admin-panel.php")
    {
        let ime, prezime, lozinka, email;

        ime = document.querySelector("#ime");
        prezime = document.querySelector("#prezime");
        lozinka = document.querySelector("#lozinka");
        email = document.querySelector("#email");
        let uloga = document.querySelector("#uloga");
        

        let btnReg = document.querySelector("#btnDodaj");
        btnReg.addEventListener("click", function(){
            // registracija(ime, prezime, lozinka, email);
            let counter = 0;
            let valid = true;
            let regExpNameSurname = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,12}$/;
    
            //Uloga
            uloga.addEventListener("change", function(){
                if(uloga.value == "1" || uloga.value == "2")
                {
                    counter++;
                    uloga.style.border = "1px solid #00ff00";
                }
                else
                {
                    counter--;
                    uloga.style.border = "1px solid #ff0000";
                }
            })
            //Ime
            if(ime.value === "")
            {
                valid = false;
                ime.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regExpNameSurname.test(ime.value))
                {
                    valid = false;
                    ime.style.border = "1px solid #ff0000";
                }
                else
                {
                    valid = true;
                    counter++;
                    ime.style.border = "1px solid #00ff00";
                }
            }

            //Prezime
            if(prezime.value === "")
            {
                valid = false;
                prezime.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regExpNameSurname.test(prezime.value))
                {
                    valid = false;
                    prezime.style.border = "1px solid #ff0000";
                }
                else
                {
                    valid = true;
                    counter++;
                    prezime.style.border = "1px solid #00ff00";
                }
            }

            //Sifra
            let regPass = /^[a-z]{4,20}[0-9]{1}/;
            if(lozinka.value === "")
            {
                valid = false;
                lozinka.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regPass.test(lozinka.value))
                {
                    valid = false;
                    lozinka.style.border = "1px solid #ff0000";
                }
                else
                {
                    valid = true;
                    counter++;
                    lozinka.style.border = "1px solid #00ff00";
                }
            }

            //Email
            let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

            if(email.value === "")
            {
                valid = false;
                email.style.border = "1px solid #ff0000";
            }
            else
            {
                if(!regExpMail.test(email.value))
                {
                    valid = false;
                    email.style.border = "1px solid #ff0000";   
                }
                else
                {
                    valid = true;
                    counter++;
                    email.style.border = "1px solid #00ff00";
                }
            }

            if(counter === 4)
            {
                var podaciZaSlanje = {
                    ime: ime.value,
                    prezime: prezime.value,
                    email: email.value,
                    lozinka: lozinka.value,
                    idUloga: uloga.value
                }
                $.ajax({
                    url:"../config/dodavanje.php",
                    type: "POST",
                    data: podaciZaSlanje,
                    dataType: "json",
                    success: function(result)
                    {
                        let odgovor = document.querySelector("#odgovor");
                        odgovor.innerHTML = `<p class='alert alert-success my-3'>${result.poruka}</p>`;
                        console.log(result);
                        setTimeout(location.reload(), 5000);
                        // console.log(result.poruka);
                    },
                    error: function(xhr)
                    {
                       if(xhr == 404)
                       {
                            ("#registracija").html(`<p class='alert alert-danger'>${xhr}</p>`);
                       }
                       if(xhr == 500)
                       {
                            ("#registracija").html(`<p class='alert alert-danger'>${xhr}</p>`);
                       }
                    }
                });
            }

        });

        //Obrisi korisnika
        let btnDelete = document.querySelectorAll(".btnDelete");
        for(let i = 0; i < btnDelete.length; i++)
        {
            btnDelete[i].addEventListener("click", function(){
                let idKorisnik = this.name;
                $.ajax({
                    url: "../config/brisanje.php",
                    type: "POST",
                    data: {id: idKorisnik},
                    dataType: "json",
                    success: function(result)
                    {
                        console.log(result);
                        btnDelete[i].parentElement.parentElement.remove();
                        alert("Uspesno ste obrisali korisnika");
                    },
                    error: function(xhr)
                    {
                        console.log(xhr);
                    }
                });

            });
        }

        //Updatuj artikal
        let btnUpdate = document.querySelectorAll(".btnUpdate");
       
        for(let i = 0; i < btnUpdate.length; i++)
        {
            btnUpdate[i].addEventListener("click", function(){
                let idProizvod = this.name;
                let cena = btnUpdate[i].parentElement.previousElementSibling.firstChild.value;
                // console.log(btnUpdate[i].parentElement.previousElementSibling.firstChild.value);
                $.ajax({
                    url: "../config/update.php",
                    type: "POST",
                    data: {id: idProizvod, 
                    cena: cena},
                    dataType: "json",
                    success: function(result)
                    {
                        alert(result.poruka);
                        setTimeout(location.reload(), 3000);
                    },
                    error: function(xhr)
                    {
                        alert("Greska!");
                        console.log(xhr);
                    }
                });
            });
        }
    } 
    if(window.location.pathname === "/bre/prodavnica.php")
    {
        // let search = document.querySelector("#search");
        let sendBtn = document.querySelector("#sendBtn");
        //let val;
        // search.addEventListener("input", function(){
        //    val = this.value.toLowerCase();
        //     console.log(val);
        // });
        sendBtn.addEventListener("click", function(e){
            e.preventDefault();
            var val=document.getElementById("search").value.toLowerCase();
            var btn = this.id;
            console.log(val)
            //console.log(obj);
            $.ajax({
                url: "config/pretraga.php",
                type: "POST",
                dataType: "json",
                data: {vrednost: val,
                    dugme: btn},
                success: function(data)
                {
                    console.log(data);
                    if(data.length === 0)
                    {
                        alert("Proizvod koji ste uneli ne postoji u prodavnici.");
                    }
                    else
                    {
                        ispisArtikla(data);
                    }
                },
                error: function(xhr)
                {
                    console.log(xhr);
                }
            })
        })
    }
    if(window.location.pathname === "/bre/korisnik.php")
    {
        let btnOdgovor = document.querySelector("#btnOdgovor");
        btnOdgovor.addEventListener("click", function(){
            let idAnketa = this.value;
            let idOdgovor = document.querySelector('input[name="odgovor"]:checked').value;
            // let idOdgovor = document.querySelector('input[name="odgovor"]');

            if(idOdgovor === "1" || idOdgovor === "2")
            {
                let anketa = document.querySelector("#anketa");
                anketa.innerHTML = "<p class='mt-4 mb-4 ml-4'>Uspešno ste odgovorili na anketu!</p>";
                $.ajax({
                    url: "config/anketa.php",
                    type: "POST",
                    data:{
                        idAnketaPHP: idAnketa,
                        idOdgovorPHP: idOdgovor
                    },
                    success: function(result)
                    {
    
                    },
                    error: function(xhr)
                    {   
                        console.log(xhr);
                    }
                });
            }
            else
            {
                alert("Greska");
            }
        });
    }
});


function checkForm()
{
    let counter = 0; //Brojac koji ce ako bude sve validno da vrati broj 3

    let errName = document.getElementById("error-name");
    let name = document.getElementById("name");

    let regExpNameSurname = /^[A-ZŠĐŽČĆ][a-zšđžčć]{2,12}$/;
    let valid = true;
    if(name.value === "")
    {
        valid = false;
        name.style.borderBottom = "1px solid #ff0000";
        errName.innerHTML = '<p class="error">The field Name is empty.</p>';
    }
    else
    {
        if(!regExpNameSurname.test(name.value))
        {
            valid = false;
            name.style.borderBottom = "1px solid #ff0000";
            errName.innerHTML = '<p class="error">Name is not in valid format. Name must start with first capital letter and to have minimum 3 characters and maximum 14 characters.</p>';
        }
        else
        {
            name.style.borderBottom = "1px solid #00ff00";
            counter++;
            valid = true;
            errName.innerHTML = "";
        }
    }


    let errEmail = document.getElementById("error-email");
    let email = document.getElementById("email");

    let regExpMail = /^[a-z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;

    if(email.value === "")
    {
        valid = false;
        email.style.borderBottom = "1px solid #ff0000";
        errEmail.innerHTML = "<p class='error'>Email field can't be empty!</p>";
    }
    else
    {
        if(!regExpMail.test(email.value))
        {
            valid = false;
            email.style.borderBottom = "1px solid #ff0000";
            errEmail.innerHTML = "<p class='error'>Email must start with small leter and must have @ for example (test@gmail.com).</p>";
        }
        else
        {
            email.style.borderBottom = "1px solid #00ff00";
            counter++;
            valid = true;
            errEmail.innerHTML = "";
        }
    }

    let phone = document.getElementById("phone");
    let errPhone = document.getElementById("error-phone");
    let regExpPhone = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;

    if(phone.value === "")
    {
        valid = false;
        phone.style.borderBottom = "1px solid #ff0000";
        errPhone.innerHTML = "<p class='error'>Phone field can't be empty!</p>";
    }
    else
    {
        if(!regExpPhone.test(phone.value))
        {
            valid = false;
            phone.style.borderBottom = "1px solid #ff0000";
            errPhone.innerHTML = "<p class='error'>Broj telefona moze poceti sa + (+381) ili 06(4)</p>";
        }
        else
        {
            phone.style.borderBottom = "1px solid #00ff00";
            counter++;
            valid = true;
            errPhone.innerHTML = "";
        }
    }

    if(counter === 3)
    {
        alert("TRUE");
    }
    else
    {
        alert(false);
    }
    // if(counter === 3)
    // {
    //     document.getElementById("myModal").style.display = "block";
    //     let span = document.getElementsByClassName("close")[0];
    //     span.addEventListener("click", () => {
    //         document.getElementById("myModal").style.display = "none";
    //     })

    //     let message = document.getElementById("message");
    //     message.innerHTML = `<p>Your parameter sent to the server. This is your data:</p>
    //     <table class="table-responsive table table-center mt-3 d-flex justify-content-center">
    //     <tr>
    //         <td>Name: </td>
    //         <td class="text-blue">${name.value}</td>
    //     </tr>
    //         <td>Surame: </td>
    //         <td class="text-blue">${surname.value}</td>
    //     </tr>
    //     <tr>
    //         <td>E-mail: </td>
    //         <td class="text-blue">${email.value}</td>
    //     </tr>
    //     <tr>
    //         <td>Address: </td>
    //         <td class="text-blue">${address.value}</td>
    //     </tr>
    //     </table><br/>`
    //     console.log("jesteeee");
    // }
    // else
    // {
    //     console.log("Nije bajo");
    // }
}

function ispisArtikla(results)
{
    let proizvodi = document.querySelector("#proizvodi");
    let ispis = "";
    for(let result of results)
    {
        ispis += `<article class='w-50 border mr-2 mb-3 col-lg-3 pt-3 pb-3 proizvodi'>
        <a href='proizvod.php?id=${result.idProizvod}'><img src='images/proizvodi/${result.src}' alt='${result.alt}' class='img-fluid mb-2'/></a>
        <p>Naziv: ${result.naziv}</p>
        <p>Veličina: ${result.velicina}</p>
        <p>Cena:${result.cena} dinara</p>
    </article>`
    }
    proizvodi.innerHTML = ispis;
}
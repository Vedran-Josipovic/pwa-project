<?php
include 'connect.php';
define('UPLPATH', 'img/');
$razina = 0;
$registriranKorisnik = false;
$msg = '';

if(isset($_POST["posalji"])){
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $username = $_POST["username"];
    $lozinka = password_hash($_POST["password1"], CRYPT_BLOWFISH);
    if(isset($_POST["admin"])){
        $razina = 1;
    }

    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if(mysqli_stmt_num_rows($stmt) > 0){
        $msg = 'Korisnik već postoji!';
    } else {
        $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $username, $lozinka, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = true;
            $msg = 'Uspješno ste registrirani!';
        }
    }
    echo $msg;
}
mysqli_close($dbc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Logo">
        </div>
        <div class="header-content">
            <h1>Štern časopis</h1>
            <nav class>
                <ul>
                    <li><a href="index.php">Početna</a></li>
                    <li><a href="kategorija.php?kategorija=Igrice">Igrice</a></li>
                    <li><a href="kategorija.php?kategorija=Knjige">Knjige</a></li>
                    <li><a href="administrator.php">Administracija</a></li>
                    <li><a href="unos.php">Unos</a></li>
                    <li><a href="registracija.php">Registracija</a></li>
                    <li><a href="prijava.php">Prijava</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div id="content">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <span id="porukaIme" class="error"></span>
                    <label for="name">Ime:</label>
                    <input type="text" class="form-control" id="name" name="ime">
                </div>

                <div class="form-group">
                    <span id="porukaPrezime" class="error"></span>
                    <label for="surname">Prezime:</label>
                    <input type="text" class="form-control" id="surname" name="prezime">
                </div>

                <div class="form-group">
                    <span id="porukaUsername" class="error"></span>
                    <label for="username">Korisničko ime:</label>
                    <input type="text" class="form-control" id="korisnickoIme" name="username">
                </div>

                <div class="form-group">
                    <span id="porukaPassword1" class="error"></span>
                    <label for="password">Lozinka:</label>
                    <input type="password" class="form-control" id="lozinka1" name="password1">
                </div>

                <div class="form-group">
                    <span id="porukaPassword2" class="error"></span>
                    <label for="password">Ponovite lozinku:</label>
                    <input type="password" class="form-control" id="lozinka2" name="password2">
                </div>

                <div class="form-group">
                    <label for= "admin ">Želim biti administrator</label>
                    <input type="checkbox" id="admin" name="admin" value="admin">
                </div>


                <button type="submit" class="btn btn-primary" name="posalji" id="submit">Prijavi se</button>
            </form>
        </div>

    </main>

    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>

<script >
        document.getElementById("submit").onclick = function(event) {
            var slanjeForme = true;
            
            var poljeIme = document.getElementById("name");
            var ime = document.getElementById("name").value;
            if (ime.length == 0) {
                slanjeForme = false;
                poljeIme.style.border = "1px dashed red";
                document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
                document.getElementById("porukaIme").style.color = "red";
            } else {
                poljeIme.style.border = "1px solid green";
                document.getElementById("porukaIme").innerHTML = "";
            }

            var poljePrezime = document.getElementById("surname");
            var prezime = document.getElementById("surname").value;
            if (prezime.length == 0) {
                slanjeForme = false;
                poljePrezime.style.border = "1px dashed red";
                document.getElementById("porukaPrezime").innerHTML = "<br>Unesite prezime!<br>";
                document.getElementById("porukaPrezime").style.color = "red";
            } else {
                poljePrezime.style.border = "1px solid green";
                document.getElementById("porukaPrezime").innerHTML = "";
            }

            var poljeUsername = document.getElementById("korisnickoIme");
            var username = document.getElementById("korisnickoIme").value;
            if (username.length == 0) {
                slanjeForme = false;
                poljeUsername.style.border = "1px dashed red";
                document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
                document.getElementById("porukaUsername").style.color = "red";
            } else {
                poljeUsername.style.border = "1px solid green";
                document.getElementById("porukaUsername").innerHTML = "";
            }

            var poljePass = document.getElementById("lozinka1");
            var pass = document.getElementById("lozinka1").value;
            var poljePassRep = document.getElementById("lozinka2");
            var passRep = document.getElementById("lozinka2").value;
            if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                slanjeForme = false;
                poljePass.style.border = "1px dashed red";
                poljePassRep.style.border = "1px dashed red";
                document.getElementById("porukaPassword1").innerHTML = "<br>Lozinke nisu iste!<br>";
                document.getElementById("porukaPassword2").innerHTML = "<br>Lozinke nisu iste!<br>";
                document.getElementById("porukaPassword1").style.color = "red";
                document.getElementById("porukaPassword2").style.color = "red";
            } else {
                poljePass.style.border = "1px solid green";
                poljePassRep.style.border = "1px solid green";
            }

            if (slanjeForme == false) {
                event.preventDefault();
            }
        };
</script>
</html>

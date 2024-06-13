<?php
include 'connect.php';
define('UPLPATH', 'img/');
session_start();
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
        <form method="post" class="form">
            <div class="form-group">
                <label for="username">Korisničko ime:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Lozinka:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
            <br><br>
            <label><a href="registracija.php">Registriraj se</a></label>
        </form>
        <div id="form">
        <?php
    if(isset($_POST["submit"])){
        $korisnicko_ime = $_POST['username'];
        $lozinka = $_POST['password'];
        $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);

        $sql="SELECT lozinka, razina FROM korisnik WHERE korisnicko_ime=?";

        $stmt=mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt,'s',$korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        mysqli_stmt_bind_result($stmt, $loz, $levelKorisnika);

        if(mysqli_stmt_fetch($stmt)){
            if(password_verify($lozinka,$loz)&&mysqli_stmt_num_rows($stmt) > 0) {
                $_SESSION["uspjesnaPrijava"]=true;
                if($levelKorisnika == 1) {
                    $_SESSION["admin"]=true;
                } else {
                    $_SESSION["admin"]=false;
                }
                $_SESSION['username'] = $korisnicko_ime; 
                $_SESSION['level'] = $levelKorisnika;  
                echo "<p  class='poruka'>Prijava uspješna!</p><br>";
            } else {
                $_SESSION["uspjesnaPrijava"]=false;
                echo "<p class='poruka'>Unijeli ste pogrešno korisničko ime ili lozinku.</p>";
            }
        }else{
            $_SESSION["uspjesnaPrijava"]=false;
            echo "<p class='poruka'>Unijeli ste korisničko ime koje ne postoji, molimo Vas da se registrirate.</p>";
        };
    }
    ?>  
    </div>

    </main>

    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>
</html>
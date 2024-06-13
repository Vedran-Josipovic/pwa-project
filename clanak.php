<?php 
include 'connect.php';
define('UPLPATH', 'img/');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Članak</title>
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
            <hr>
            <div id='clanak'>
                <?php
                    $id = $_GET['id'];
                    $kategorija = $_GET['kategorija'];
                    $query = "SELECT * FROM clanci where id=$id";
                    $result = mysqli_query($dbc, $query);
                    $row = mysqli_fetch_array($result);
                    echo "  <div id='section-naslov'>
                                <a href='kategorija.php?kategorija=".$row['kategorija']."'>".$row['kategorija']." </a>
                            </div>
                            <div id=clanak-naslov'>
                                <h2><b>".$row['naslov']."</b></h2>
                            </div>
                            <img src='". UPLPATH . $row['slika'] ."' alt=''>
                            <br><br>
                            <div id='tekst'>
                                <b> 
                                    ".$row['sazetak']." 
                                </b>
                                <br><br>
                                ".$row['tekst']."
                                <br><br>
                            </div>
                            ";
                ?> 
            </div>
        </div>
    </main>
    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>
</html>
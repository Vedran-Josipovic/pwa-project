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
    <title>Početna</title>
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
        <section class="section-igrice">
            <h2>IGRICE ></h2>
            <div class="articles">
                <?php
                    $query = "SELECT * FROM clanci WHERE arhiva=1 AND kategorija='Igrice' LIMIT 3";
                    $result = mysqli_query($dbc, $query);
                    while($row = mysqli_fetch_array($result)) {
                        echo '<article>';
                        echo '<img src="img/' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                        echo '
                            <a href="clanak.php?id='.$row['id'].'&kategorija='.$row['kategorija'].'"><h3>'.$row['naslov'].'</h3></a>
                            ';
                        echo '<p>' . $row['sazetak'] . '</p>';
                        echo '</article>';
                    }
                ?> 
            </div>
        </section>

        <section class="section-knjige">
            <h2>KNJIGE ></h2>
            <div class="articles">
                <?php
                    $query = "SELECT * FROM clanci WHERE arhiva=1 AND kategorija='Knjige' LIMIT 3";
                    $result = mysqli_query($dbc, $query);
                    while($row = mysqli_fetch_array($result)) {
                        echo '<article>';
                        echo '<img src="img/' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                        echo '<a href="clanak.php?id='.$row['id'].'&kategorija='.$row['kategorija'].'"><h3>'.$row['naslov'].'</h3></a>';
                        echo '<p>' . $row['sazetak'] . '</p>';
                        echo '</article>';
                    }
                ?> 
        </div>
    </section>
    </main>
    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>
</html>
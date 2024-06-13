<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $picture = $_FILES['picture']['name'];
    $title=$_POST['title'];
    $summary=$_POST['summary'];
    $content=$_POST['content'];
    $category=$_POST['category'];
    $display = isset($_POST['display']) ? 1 : 0;
    $picture = "";
    $today = date("d-m-Y");

    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == UPLOAD_ERR_OK) {
        $image_name = uniqid() . '_' . basename($_FILES["picture"]["name"]);
        $target_path = "img/" . $image_name;
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_path)) {
            $picture = $image_name;
        } else {
            echo "Greška prilikom spremanja slike.";
            $picture = "";
        }
    } else {
        echo "Slika nije unesena.";
        $image = "";
    }

    

    $query = "INSERT INTO clanci (datum, naslov, sazetak, tekst, slika, kategorija, arhiva ) VALUES ('$today' ,'$title', '$summary', '$content', '$picture', '$category', '$display')";
    $result = mysqli_query($dbc, $query) or die('Error querying databese.');
    mysqli_close($dbc);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uneseni članak</title>
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
                </ul>
            </nav>
        </div>
</header>

<main>
    <section>
        <div role="main">
            <div>
                <h1 class="category" id="category"><?php echo $category; ?></h1>
                <h2 class="title"><?php echo $title; ?></h2>
                <p>AUTOR:</p>
                <p>OBJAVLJENO: <span id="published-date"></span></p>
            </div>

            <section class="picture">
                <?php 
                if (!empty($picture)) { 
                    echo "<img src='img/$picture' alt='Slika'"; 
                } else {
                    echo "<p>Nema slike.</p>";
                }
                ?>
            </section>

            <section class="summary">
                <p><?php echo $summary; ?></p>
            </section>

            <section class="content">
                <p><?php echo $content; ?></p>
            </section>
        </div>
    </section>
</main>





<footer>
    <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
</footer>


<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Load the header content
            fetch('header.html')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('header-placeholder').innerHTML = data;
                });

            // Insert today's date
            const today = new Date();
            const formattedDate = today.toLocaleDateString('en-GB', { 
                day: '2-digit', month: '2-digit', year: 'numeric' 
            });
            document.getElementById('published-date').textContent = formattedDate;
        });
    </script>
</body>
</html>

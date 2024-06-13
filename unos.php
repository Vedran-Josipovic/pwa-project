<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Unos članaka</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
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

        <section>
            <h1>Unesi članak</h1>
            <form action="skripta.php" method="POST" enctype="multipart/form-data" class="container" >
                <div class="form-group">
                    <label for="title">Naslov članka:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                    <div id="porukaTitle" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="summary">Sažetak:</label>
                    <textarea id="summary" name="summary" class="form-control" rows="2" required></textarea>
                    <div id="porukaAbout" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="content">Sadržaj:</label>
                    <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
                    <div id="porukaContent" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="category">Odaberi kategoriju</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="" selected disabled hidden>Select</option>
                        <option value="Igrice">Igrice</option>
                        <option value="Knjige">Knjige</option>
                    </select>
                    <div id="porukaKategorija" class="error"></div>
                </div>
                <div class="form-group">
                    <label for="picture">Slika:</label>
                    <input type="file" id="picture" name="picture" class="form-control-file" accept="image/*" required>
                    <div id="porukaSlika" class="error"></div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" id="display" name="display" class="form-check-input">
                    <label for="display" class="form-check-label">Prikaži na stranici</label>
                </div>
                <button type="submit" id="submit" class="btn btn-primary">Pošalji</button>
            </form>
        </section>

        <script>
            document.getElementById("submit").onclick = function(event) {
                var slanjeForme = true;
                
                var poljeTitle = document.getElementById("title");
                var title = document.getElementById("title").value;
                if (title.length < 3 || title.length > 30) {
                    slanjeForme = false;
                    poljeTitle.style.border = "1px dashed red";
                    document.getElementById("porukaTitle").innerHTML = "Naslov članka mora imati između 3 i 30 znakova!<br>";
                    document.getElementById("porukaTitle").style.color = "red";
                } else {
                    poljeTitle.style.border = "1px solid green";
                    document.getElementById("porukaTitle").innerHTML = "";
                }
                
                var poljeAbout = document.getElementById("summary");
                var about = document.getElementById("summary").value;
                if (about.length < 10 || about.length > 100) {
                    slanjeForme = false;
                    poljeAbout.style.border = "1px dashed red";
                    document.getElementById("porukaAbout").innerHTML = "Sadržaj mora imati između 10 i 100 znakova!<br>";
                    document.getElementById("porukaAbout").style.color = "red";
                } else {
                    poljeAbout.style.border = "1px solid green";
                    document.getElementById("porukaAbout").innerHTML = "";
                }
                
                var poljeContent = document.getElementById("content");
                var content = document.getElementById("content").value;
                if (content.length == 0) {
                    slanjeForme = false;
                    poljeContent.style.border = "1px dashed red";
                    document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
                    document.getElementById("porukaContent").style.color = "red";
                } else {
                    poljeContent.style.border = "1px solid green";
                    document.getElementById("porukaContent").innerHTML = "";
                }
                
                var poljeSlika = document.getElementById("picture");
                var pphoto = document.getElementById("picture").value;
                if (pphoto.length == 0) {
                    slanjeForme = false;
                    poljeSlika.style.border = "1px dashed red";
                    document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
                    document.getElementById("porukaSlika").style.color = "red";
                } else {
                    poljeSlika.style.border = "1px solid green";
                    document.getElementById("porukaSlika").innerHTML = "";
                }
                
                var poljeCategory = document.getElementById("category");
                
                if (poljeCategory.selectedIndex == 0) {
                    slanjeForme = false;
                    poljeCategory.style.border = "1px dashed red";
                    document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
                    document.getElementById("porukaKategorija").style.color = "red";
                } else {
                    poljeCategory.style.border = "1px solid green";
                    document.getElementById("porukaKategorija").innerHTML = "";
                }
                
                if (!slanjeForme) {
                    event.preventDefault();
                }
            };
        </script>

    </main>

    

    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>
</html>

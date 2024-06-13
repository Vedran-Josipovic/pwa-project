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
                    <li><a href="igrice.php">Igrice</a></li>
                    <li><a href="knjige.php">Knjige</a></li>
                    <li><a href="administrator.php">Administracija</a></li>
                    <li><a href="unos.php">Unos</a></li>
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
                </div>
                <div class="form-group">
                    <label for="summary">Sažetak:</label>
                    <textarea id="summary" name="summary" class="form-control" rows="2" required></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Sadržaj:</label>
                    <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Odaberi kategoriju</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="" selected disabled hidden>Select</option>
                        <option value="Igrice">Igrice</option>
                        <option value="Knjige">Knjige</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="picture">Slika:</label>
                    <input type="file" id="picture" name="picture" class="form-control-file" accept="image/*">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" id="display" name="display" class="form-check-input">
                    <label for="display" class="form-check-label">Prikaži na stranici</label>
                </div>
                <button type="submit" class="btn btn-primary">Pošalji</button>
            </form>
        </section>

    </main>

    

    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>
</html>

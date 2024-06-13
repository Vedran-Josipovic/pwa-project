<?php
session_start();
include 'connect.php';
define('UPLPATH', 'img/');

$uspjesnaPrijava = isset($_SESSION['uspjesnaPrijava']) ? $_SESSION['uspjesnaPrijava'] : false;
$admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : false;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$level = isset($_SESSION['level']) ? $_SESSION['level'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
            <div id="form">
                <?php
                if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['username']) && $level == 1)) {
                    $query = "SELECT * FROM clanci";
                    $result = mysqli_query($dbc, $query);
                    while($row = mysqli_fetch_array($result)) {
                
                    echo '<form enctype="multipart/form-data" action="" method="POST" class="p-4 border rounded bg-light">
                            <div class="form-item">
                                <label for="title">Naslov članka:</label>
                                <div class="form-field">
                                    <input type="text" name="title" class="form-control" value="'.$row['naslov'].'">
                                </div>
                            </div>
                            <div id="form-item">
                                <label for="about">Sažetak: </label>
                                <div id="form-field">
                                    <textarea name="about" id="textarea" cols="30" rows="10" class="form-control">'.$row['sazetak'].'</textarea>
                                </div>
                            </div>

                            <div id="form-item">
                                <label for="sadrzaj">Tekst članka: </label>
                                <div id="form-field">
                                    <textarea name="sadrzaj" id="textarea" cols="30" rows="10" class="form-control">'.$row['tekst'].'</textarea>
                                </div>
                            </div>
                            <div class="form-item">
                                <label for="photo">Slika:</label>
                                <div class="form-field">
                                <input type="file" class="input-text" id="slika" name="photo"/>
                                <br><img src="' . UPLPATH . $row['slika'] . '" width="100px">
                                </div>
                            </div>
                            <div class="form-item">
                                <label for="category">Kategorija:</label>
                                <div class="form-field">
                                    <select name="category" id="kategorija" class="form-control" ">
                                        <option value="Igrice" ' . ($row['kategorija'] == 'Igrice' ? ' selected="true"' : '') . '>Igrice</option>
                                        <option value="Knjige" ' . ($row['kategorija'] == 'Knjige' ? ' selected="true"' : '') . '>Knjige</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-item">
                                <label>Spremanje - Arhiviranje: 
                                <div class="form-field">';
                                    if($row['arhiva'] == 0) {
                                        echo '<input type="checkbox" name="archive" id="archive"/> Želiš li prikazati članak na stranici?';
                                    } else {
                                        echo '<input type="checkbox" name="archive" id="archive" checked="true"/> Želiš li prikazati članak na stranici?';
                                    }
                        echo '  </div>
                                </label>
                            </div>
                            <div class="form-item">
                                <input type="hidden" name="id" class="form-control" value="'.$row['id'].'">
                                <input type="hidden" name="existing_image" value="' . $row['slika'] . '">
                                <button type="reset" class="btn btn-secondary" value="Poništi">Poništi promjene</button>
                                <button type="submit" class="btn btn-primary" name="update" value="Prihvati"> Izmjeni</button>
                                <button type="submit" class="btn btn-danger" name="delete" value="Izbriši"> Izbriši</button>
                            </div>
                        </form><br><hr><br>';
                        }
                        }else if ($uspjesnaPrijava == true && $admin == false) {
                            echo '<p class="poruka">Bok ' . $username . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
                        } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
                            echo '<p class="poruka">Bok ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
                        } else if ($uspjesnaPrijava == false) {
                            header("Location: prijava.php");
                            exit;
                        }
                
                
                        if(isset($_POST['delete'])){
                            $id=$_POST['id'];
                            $query = "DELETE FROM clanci WHERE id=$id ";
                            $result = mysqli_query($dbc, $query);
                        }


                        if(isset($_POST['update'])){
                            $picture = $_FILES['photo']['name'];
                            $existing_image = $_POST['existing_image'];
                            $title=$_POST['title'];
                            $about=$_POST['about'];
                            $content=$_POST['sadrzaj'];
                            $category=$_POST['category'];
                            if(isset($_POST['archive'])){
                                $archive=1;
                            }else{
                                $archive=0;
                            }

                            if (!empty($picture)) {
                                $target_dir = UPLPATH . $picture;
                                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir);
                            } else {
                                $picture = $existing_image;
                            }

                            $id=$_POST['id'];
                            $query = "UPDATE clanci SET naslov='$title', sazetak='$about', tekst='$content', 
                            slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id ";
                            $result = mysqli_query($dbc, $query);   
                }
                $query = "SELECT * FROM clanci";
                $result = mysqli_query($dbc, $query);       
                ?> 
            </div>
        </div>
    </main>
    <footer>
        <p>Vedran Josipović | vjosipovi@tvz.hr | 2024. | © štern.hr d.o.o</p>
    </footer>
</body>
</html>
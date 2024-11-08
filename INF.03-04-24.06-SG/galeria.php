<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h2>Zdjęcia</h2>
    </header>
    <main>
        <section id="lewy">
            <h2>Tematy zdjęć</h2>
            <ol>
                <li>Zwięrzeta</li>
                <li>Krajobrazy</li>
                <li>Miasta</li>
                <li>Przyroda</li>
                <li>Samochody</li>
            </ol>
        </section>
        <section id="srodkowy">
            <?php
                $baza = mysqli_connect('localhost','root','','galeria');
                $sql = "SELECT zdjecia.plik, zdjecia.tytul,zdjecia.polubienia,
                        autorzy.imie,autorzy.nazwisko FROM zdjecia INNER JOIN autorzy ON 
                        autorzy.id = zdjecia.autorzy_id ORDER BY `autorzy`.`nazwisko` ASC;";
                $wynik = mysqli_query($baza, $sql);
                while($wiersz = mysqli_fetch_array($wynik)){
                    echo "<div class='blok-skryptu'>";
                    echo "<img src='{$wiersz[0]}' alt='zdjecie'>";
                    echo "<h3>{$wiersz[1]}</h3>";
                    if($wiersz[2]>40){
                        echo "<p>Autor: {$wiersz[3]} {$wiersz[4]}.<br> Wiele osób polubiło ten obraz.</p>";

                    }
                    else{
                        echo "<p>Autor: {$wiersz[3]} {$wiersz[4]}.</p>";
                    }
                    echo "<a href='{$wiersz[0]}' download>Pobierz</a>";
                    echo "</div>";
                }
            ?>
        </section>
        <section id="prawy">
            <h2>Najbardziej lubiane</h2>
            <?php
                $sql2 = "SELECT tytul,plik FROM `zdjecia` WHERE polubienia >=100; ";
                $wynik2 = mysqli_query($baza, $sql2);
                while($wiersz = mysqli_fetch_array($wynik2)){
                    echo "<img src='{$wiersz[1]}' alt='{$wiersz[0]}'>";
                }
            ?>
            <strong>Zobacz wszystkie zdjęcia</strong>
        </section>
    </main>
    <footer>
        <h5>Stronę wykonał: barmc</h5>
    </footer>
</body>
</html>
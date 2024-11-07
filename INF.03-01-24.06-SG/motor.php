<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motocykle</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <img id="motor-photo" src="motor.png" alt="motocykl">
    <header>
        <h1>Motocykle - moja pasja</h1>
    </header>
    <main>
        <section id="lewy">
            <h2>Gdzie pojechać?</h2>
            <?php
                $baza = mysqli_connect('localhost','root','','motory');
                $sql = "SELECT wycieczki.nazwa, wycieczki.opis, wycieczki.poczatek, zdjecia.zrodlo FROM wycieczki INNER JOIN zdjecia ON zdjecia.id = wycieczki.zdjecia_id; ";
                $wynik = mysqli_query($baza, $sql);
                while($wiersz = mysqli_fetch_array($wynik)){
                    echo "<dl>";
                    echo "<dt>{$wiersz[0]}, rozpoczyna się w {$wiersz[2]}, <a href='{$wiersz[3]}'>zobacz zdjecie</a></dt>";
                    echo "<dd>{$wiersz[1]}</dd>";
                    echo "</dl>";
                }
            ?>
        </section>  
        </section>
        <section id="prawy-gora">
            <h2>Co kupić?</h2>
            <ol>
                <li>Honda CBR125R</li>
                <li>Yamaha YBR125</li>
                <li>Honda VFR800i</li>
                <li>Honda CBR1100XX</li>
                <li>BMW R1200GS LC</li>
            </ol>
        </section>
        <section id="prawy-dol">
            <h2>Statystyki</h2>
            <p>Wpisanych wycieczek:
            <?php
                $sql2 = "SELECT COUNT(*) FROM wycieczki; ";
                $wynik2 = mysqli_query($baza, $sql2);
                $wiersz2 = mysqli_fetch_array($wynik2);
                echo $wiersz2[0];
                mysqli_close($baza);
            ?></p>
            <p>Użytkowników forum: 200</p>
            <p>Przesłanych zdjęć: 1300</p>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał barmc</p>
    </footer>
</body>
</html>
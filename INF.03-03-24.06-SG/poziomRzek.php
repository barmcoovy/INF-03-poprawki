<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poziomy rzek</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <section id="header-lewy">
            <img src="obraz1.png" alt="Mapa Polski">
        </section>
        <section id="header-prawy">
            <h1>Rzeki w województwie dolnośląskim</h1>
        </section>
    </header>
    <nav>
        <form action="#" method="post">
            <input type="radio" name="radio" value="1"><span class="radio-text">Wszystkie</span>
            <input type="radio" name="radio" value="2"><span class="radio-text">Ponad stan ostrzegawczy</span>
            <input type="radio" name="radio" value="3"><span class="radio-text">Ponad stan alarmowy    </span>    
            <button type="submit">Pokaż</button>
        </form>
    </nav>
    <main>
        <section id="lewy">
            <h3>Stan na dzień 2022-05-05</h3>
            <table>
                <tr>
                    <th>Wodomierz</th>
                    <th>Rzeka</th>
                    <th>Ostrzegawczy</th>
                    <th>Alarmowy</th>
                    <th>Aktualny</th>
                </tr>
                <?php
                    $baza = mysqli_connect('localhost','root','','rzeki');
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $radio = $_POST['radio'];
                        if($radio==1){
                            $sql = "SELECT wodowskazy.nazwa, wodowskazy.rzeka,wodowskazy.stanOstrzegawczy, 
                            wodowskazy.stanAlarmowy, pomiary.stanWody FROM wodowskazy INNER JOIN pomiary 
                            ON pomiary.wodowskazy_id = wodowskazy.id WHERE pomiary.dataPomiaru = '2022-05-05';";
                            $wynik = mysqli_query($baza, $sql);
                            while($wiersz = mysqli_fetch_array($wynik)){
                                echo "<tr>";
                                echo "<td>{$wiersz[0]}</td>";
                                echo "<td>{$wiersz[1]}</td>";
                                echo "<td>{$wiersz[2]}</td>";
                                echo "<td>{$wiersz[3]}</td>";
                                echo "<td>{$wiersz[4]}</td>";
                                echo "</tr>";
                            }
                        }
                        else if($radio==2){
                            $sql = "SELECT wodowskazy.nazwa, wodowskazy.rzeka,wodowskazy.stanOstrzegawczy, 
                                    wodowskazy.stanAlarmowy, pomiary.stanWody FROM wodowskazy INNER JOIN pomiary 
                                    ON pomiary.wodowskazy_id = wodowskazy.id WHERE pomiary.dataPomiaru = '2022-05-05' AND stanWody > stanOstrzegawczy;";
                            $wynik = mysqli_query($baza, $sql);
                            while($wiersz = mysqli_fetch_array($wynik)){
                                echo "<tr>";
                                echo "<td>{$wiersz[0]}</td>";
                                echo "<td>{$wiersz[1]}</td>";
                                echo "<td>{$wiersz[2]}</td>";
                                echo "<td>{$wiersz[3]}</td>";
                                echo "<td>{$wiersz[4]}</td>";
                                echo "</tr>";
                            }
                        }
                        else if($radio==3){
                            $sql = "SELECT wodowskazy.nazwa, wodowskazy.rzeka,wodowskazy.stanOstrzegawczy, 
                                    wodowskazy.stanAlarmowy, pomiary.stanWody FROM wodowskazy INNER JOIN pomiary 
                                    ON pomiary.wodowskazy_id = wodowskazy.id WHERE pomiary.dataPomiaru = '2022-05-05' AND stanWody < stanOstrzegawczy;";
                            $wynik = mysqli_query($baza, $sql);
                            while($wiersz = mysqli_fetch_array($wynik)){
                                echo "<tr>";
                                echo "<td>{$wiersz[0]}</td>";
                                echo "<td>{$wiersz[1]}</td>";
                                echo "<td>{$wiersz[2]}</td>";
                                echo "<td>{$wiersz[3]}</td>";
                                echo "<td>{$wiersz[4]}</td>";
                                echo "</tr>";
                            }
                        }
                    }
                ?>
            </table>
        </section>
        <section id="prawy">
            <h3>Informacje</h3>
            <ul>
                <li>Brak ostrzeżeń o burzach z gradem</li>
                <li>Smog w mieście Wrocłąw</li>
                <li>Silny wiatr w Karkonoszach</li>
            </ul>
            <h3>Średnie stany wód</h3>
            <?php
                $sql2 = "SELECT dataPomiaru, AVG(stanWody) FROM pomiary GROUP BY dataPomiaru;";
                $wynik2 = mysqli_query($baza, $sql2);
                while($wiersz2 = mysqli_fetch_array($wynik2)){
                    echo "<p>{$wiersz2[0]}: {$wiersz2[1]}</p>";
                }
            ?>
            <a href="https://komunikaty.pl/">Dowiedz się więcej</a>
            <img src="obraz2.jpg" alt="rzeka">
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: barmc</p>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">


</head>

<body>
    <main>

        <div class="background-div"></div>
        <div class="wrapper leaderboard">
            <?php
            $file = fopen("./csv/bestenliste.csv", "r");
            if ($file) {
                $data = [];

                while (($row = fgetcsv($file, 1000, ";")) !== false) {
                    $data[] = $row;
                }

                usort($data, function ($a, $b) {
                    $percentageA = floatval($a[2]); // Konvertiere die Prozentzahl zu einer Gleitkommazahl
                    $percentageB = floatval($b[2]);

                    return $percentageB - $percentageA;
                });

                echo "<h2 class='headline'>Rangliste</h2>";
                echo "<table>";
                echo "<tr><th style='padding-right: 30px;'>Platz  </th><th>Punkte  </th><th>Prozente erreicht  </th></tr>";

                // Begrenze die Anzeige auf maximal 10 Einträge
                $counter = 0;
                $platz = 1;

                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>{$platz}</td>";
                    echo "<td>{$row[1]}</td>";
                    echo "<td>{$row[2]}</td>";
                    echo "</tr>";

                    $counter++;
                    $platz++;

                    if ($counter >= 15) {
                        break;
                    }
                }

                echo "</table>";
                fclose($file);
            } else {
                echo "Die Datei konnte nicht geöffnet werden.";
            }
            ?>
        </div>
        <div class="button">
            <a href="./play/index.php"><button>Spielen</button></a>
            <a href="./Login/login.php"><button>Admin Login</button></a>
        </div>
    </main>
    
</body>

</html>
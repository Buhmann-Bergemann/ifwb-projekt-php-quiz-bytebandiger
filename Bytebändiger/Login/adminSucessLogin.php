<?php
session_start();

// Check if the form is submitted

        $handle = fopen("./logindata.csv", "r");

        while (($line = fgets($handle)) !== FALSE) {
            $data = explode(';', $line);
            $data[0] = trim($data[0]);
            $data[1] = trim($data[1]);

            if ($data[0] == $_SESSION['username'] && $data[1] == $_SESSION['password']) {
                $success = true;
                break;
            }
        }

        if(!$success) {
            echo "Login ungültig";
            echo $_SESSION['username'];
            
            echo $_SESSION['password'];
            exit;
        }


?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./adminstyle.css">
</head>

<body>
    <h1 class="flex headertext">Admin Dashboard</h1>
    <?php
if (isset($_POST['delete'])) {
    // Wenn der "Löschen"-Button gedrückt wurde
    deleteRow($_POST['questionr']);
}
 
if (isset($_POST['edit'])) {
    // Wenn der "Bearbeiten"-Button gedrückt wurde
    // Lese die Daten aus dem Formular
    $questionr = $_POST['questionr'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];
    $answer5 = $_POST['answer5'];
 
    // Code zum Bearbeiten der Zeile
    editRow($questionr, $answer1, $answer2, $answer3, $answer4, $answer5);
}
 
function deleteRow($questionr) {
    // Code zum Löschen der Zeile, den du bereits implementiert hast
    $lines = file("fragen.csv", FILE_IGNORE_NEW_LINES);
 
    foreach ($lines as $key => $line) {
        $values = explode(';', $line);
        $entryIdentifier = htmlspecialchars($values[0]);
 
        if (trim($entryIdentifier) == trim($questionr)) {
            unset($lines[$key]);
            break;
        }
    }
 
    file_put_contents("fragen.csv", implode("\n", $lines));
}
 
function editRow($questionr, $answer1, $answer2, $answer3, $answer4, $answer5) {
    // Code zum Bearbeiten der Zeile
    $lines = file("fragen.csv", FILE_IGNORE_NEW_LINES);
 
    foreach ($lines as $key => $line) {
        $values = explode(';', $line);
        $entryIdentifier = htmlspecialchars($values[0]);
 
        if (trim($entryIdentifier) == trim($questionr)) {
            // Bearbeite die gefundene Zeile
            $lines[$key] = "$questionr;$answer1;$answer2;$answer3;$answer4;$answer5";
            break;
        }
    }
 
    file_put_contents("fragen.csv", implode("\n", $lines));
}
function addRow($questionr, $answer1, $answer2, $answer3, $answer4, $answer5) {
    // Code zum Hinzufügen einer neuen Zeile
    $newLine = "$questionr;$answer1;$answer2;$answer3;$answer4;$answer5";

    file_put_contents("/fragen.csv", PHP_EOL . $newLine, FILE_APPEND);
}

$f = fopen("fragen.csv", "r");
while (($line = fgetcsv($f)) !== false) {
    echo "<form method='post' action='adminSucessLogin.php'>"; // Formular für jedes Datenelement
 
    echo "<label style='font-size: x-large'> Frage: ";
    echo "</label>\n";
 
    $values = explode(';', $line[0]);
    $entryIdentifier = htmlspecialchars($values[0]);
 
    echo "<input class='questions' name='questionr' value='" . htmlspecialchars($values[0]) . "'>";
    echo "<input class='questions ' name='answer1' value='" . htmlspecialchars($values[1]) . "'>";
    echo "<input class='questions' name='answer2' value='" . htmlspecialchars($values[2]) . "'>";
    echo "<input class='questions' name='answer3' value='" . htmlspecialchars($values[3]) . "'>";
    echo "<input class='questions' name='answer4' value='" . htmlspecialchars($values[4]) . "'>";
    echo "<input class='questions' name='answer5' value='" . htmlspecialchars($values[5]) . "'>";
    echo "<input class='button' type='submit' name='delete' value='Löschen'>";
    echo "<input class='button' type='submit' name='edit' value='Bearbeiten'>" . "<br>";
 
    echo "</form>";
}
fclose($f);

?>
<form method='post' id="newQuestionForm">
        <label>Frage: </label>
        <!-- Hier füge die Felder für die neue Frage hinzu -->
        <input name='newQuestionr' class="questions" placeholder='Neue Frage'>
        <input name='newAnswer1' class='questions' placeholder='Antwort 1' required>
        <input name='newAnswer2' class='questions' placeholder='Antwort 2' required>
        <input name='newAnswer3' class='questions' placeholder='Antwort 3' required>
        <input name='newAnswer4' class='questions' placeholder='Antwort 4' required>
        <input name='newAnswer5' class='questions' placeholder='Antwort 5' required>
        <button type='submit' class='button' name='add' class='loginButton'>Fragen Hinzufügen</button>
    </form>
 
</body>
</html>
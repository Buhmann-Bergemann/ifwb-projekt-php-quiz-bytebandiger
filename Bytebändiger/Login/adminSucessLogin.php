<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!strlen($username) || !strlen($password)) {
        echo 'Please enter both username and password.';
    } else {
        $success = false;

        $handle = fopen("./logindata.csv", "r");

        while (($line = fgets($handle)) !== FALSE) {
            $data = explode(';', $line);
            $data[0] = trim($data[0]);
            $data[1] = trim($data[1]);

            if ($data[0] == $username && $data[1] == $password) {
                $success = true;
                break;
            }
        }

        fclose($handle);

        if ($success) {
        } else {
            header("Location:./login.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./adminstyle.css">
</head>

<body>
    <h1 class="flex headertext">Admin Dashboard</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "<html><body><div class='flex'><Form>";
        $f = fopen("fragen.csv", "r");
        while (($line = fgetcsv($f)) !== false) {
            echo "<label>";
            echo "</Label>\n";
            $values = explode(";", $line[0]);
            echo "<input class='questions' value='" . htmlspecialchars($values[0]) . "'>";
            echo "<input class='questions' value='" . htmlspecialchars($values[5]) . "'>";
            echo "<input class='questions' value='" . htmlspecialchars($values[1]) . "'>";
            echo "<input class='questions' value='" . htmlspecialchars($values[2]) . "'>";
            echo "<input class='questions' value='" . htmlspecialchars($values[3]) . "'>";
            echo "<input class='questions' value='" . htmlspecialchars($values[4]) . "'>";
            echo "<input value=Bearbeiten type=Submit class='button'>";
            echo "<input value=Löschen type=Submit class='button'>" . "<br>";
        }
        fclose($f);
        echo "\n</html></body></div></Form>";
    }
    ?>

</body>

</html>
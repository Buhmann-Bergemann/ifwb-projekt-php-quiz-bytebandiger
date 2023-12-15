<?php
session_start();

function sanitizeInput($input)
{
    // Diese Funktion entfernt HTML- und PHP-Tags sowie Steuerzeichen aus dem Eingabestring
    return htmlspecialchars(strip_tags(trim($input)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzereingaben bereinigen
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Benutzereingaben in der Session speichern
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    // Weiterleitung nach erfolgreicher Anmeldung
    header("Location:./adminSucessLogin.php");
    exit(); // sicherstellen, dass der Code nach der Weiterleitung nicht mehr ausgeführt wird
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="flex wrapper">
        <form action="" method="post">
            <img class="flex" src="../img/kahoot_logo.png" alt="kahoot_Logo">
            <h1>Login </h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Benutzername" required>
                <i class='bx bx-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Passwort" required>
                <i class='bx bx-lock-alt'></i>
            </div>
            <button class="btn" type="submit">Anmelden</button>
        </form>
    </div>
</body>



</html>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div>
        <img src="../img/kahoot_Logo.png" alt="kahoot_Logo">
        <div class="login-container">
            <h1>Admin Login </h1>
            <form action="./adminSucessLogin.php" method="post">
                <input type="text" name="username" placeholder="Benutzername" required>


                <input type="password" name="password" placeholder="Passwort" required>

                <button type="submit">Anmelden</button>


            </form>
        </div>
    </div>
</body>



</html>
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
        $file = fopen("fragen.csv","r");
        print_r(fgetcsv($file));
        fclose($file);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Admin Dashboard</h1>
<button>Fragen Bearbeiten</button>
<button>Fragen Löschen</button>
<button>Bestenliste Zurücksetzen</button>
</body>
</html>
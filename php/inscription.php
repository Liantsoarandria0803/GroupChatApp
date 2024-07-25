<?php
session_start();

$servername = "localhost";
$username = "liantsoa";
$password = "liantsoa08"; // mot de passe anle admin 
$database = "ChatApp"; // nom de la base de donnée
$table = "users"; // nom de la table

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        // Prepare SQL statement
        $sql = $conn->prepare("INSERT INTO $table(username,password) VALUES (:username, :pass)");
        $sql->bindParam(':username', $username, PDO::PARAM_STR);
        $sql->bindParam(':pass', $pass, PDO::PARAM_STR);
        $sql->execute();

        // Getting user ID after registration
        $requete = $conn->prepare("SELECT * FROM $table WHERE BINARY username=:username AND BINARY password=:pass");
        $requete->bindParam(':username', $username, PDO::PARAM_STR);
        $requete->bindParam(':pass', $pass, PDO::PARAM_STR);
        $requete->execute();
        $resultats = $requete->fetchAll(PDO::FETCH_OBJ);

        if (!empty($resultats)) {
            $objectINfo = $resultats[0];
            $userId = $objectINfo->id;
            $retour['userName'] = $username;
            $retour['userId'] = $userId;
            $_SESSION['userName'] = $username;

            // Save the user name into a json file
            $fp = fopen('./../data/user.json', 'w');
            fwrite($fp, json_encode($retour));
            fclose($fp);

            header("Location: ./../app/messageGroupe.php");
            exit; // Ensure no further script execution
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
    <link rel="stylesheet" href="./../front/inscription.css">
</head>
<body>
    <form action="" method="post">
        <label for="username">Nom:</label>
        <input type="text" name="username">
        <label for="pass">Mot de passe</label>
        <input type="text" name="pass">
        <button type="submit">ENREGISTRER</button>
    </form>
</body>
</html>
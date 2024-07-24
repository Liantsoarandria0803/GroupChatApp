<?php
session_start();
$servername = "localhost";
$username = "liantsoa";
$password = "liantsoa08"; // mot de passe anle admin 
$database = "ChatApp"; // nom de la base de donnée
$table = "users"; // nom de la table
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $sql=$conn->prepare("INSERT INTO $table(username,password) VALUES ('$username','$pass')");
    $sql->execute();
    //getting id
    $requete = $conn->prepare("SELECT * FROM $table WHERE BINARY username='$username' AND BINARY password='$pass'");
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
    $objectINfo=$resultats['0'];
    $userId=$objectINfo->id;
    $retour['userName'] = $username;
    $retour['userId']= $userId;
    $_SESSION['userName'] = $username;
    // save the user name in to a json file
    $fp = fopen('./../data/user.json', 'w');
    fwrite($fp, json_encode($retour));
    fclose($fp);
    header("Location: ./../app/messageGroupe.php");
    
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
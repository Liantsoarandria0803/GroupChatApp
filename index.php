<?php
session_start();
$servername = "localhost";
$username = "liantsoa";
$password = "liantsoa08"; // mot de passe anle admin ana admnin
$database = "ChatApp"; // nom de la base de donnée
$table = "users"; // nom de la table
// se connecter avec mysql avec pdo
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    $user=$_POST['username'];
    $passwd=$_POST['password'];
    // detecter si ce login est dans le database 
    $sql = "SELECT * FROM $table WHERE BINARY username='$user' AND BINARY password='$passwd'";
    $result = $conn->query($sql);
    $requete = $conn->prepare("SELECT * FROM $table WHERE BINARY username='$user' AND BINARY password='$passwd'");
    $requete->execute();
    $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
    $objectINfo=$resultats['0'];
    $userId=$objectINfo->id;
    echo $userId;
    if ($result->rowCount() > 0) {

        $retour['userName'] = $user;
        $retour['userId']= $userId;
        $_SESSION['userName'] = $user;
        // save the user name in to a json file
        $fp = fopen('./data/user.json', 'w');
        fwrite($fp, json_encode($retour));
        fclose($fp);
        header("Location: ./app/messageGroupe.php");
    } else {
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
    <title>SMARTKAJY</title>
    <link rel="stylesheet" href="./front/login.css">
    <script src="./front/log.js"></script>
</head>
<body>
    <div class="body">
    <section>
        <div class="login">

            <form action="" method="post">
                   
                     <h3 class="title">RANDRIA'STASKS</h3>
                    <label for="username">Username</label>
                    <input type="text" name="username"placeholder="USERNAME" required>
                    <label for="password">Password</label>
                    <div id="password">
                        <input id="pass"type="password" name="password" placeholder="PASSWORD" required>
                        <img id="eye" src="./img/eye.svg" alt="">
                    </div>
                   <button type="submit"><h3 style="margin: 0;">LOG IN</h3></button>
            </form>
            
           
        </div>
    </section>
    </div>
    <div class="inscri">
        Si vous n'avez pas un compte inscrivez-vous
        <button><a href="./php/inscription.php">INSCRIPTION</a></button>
    </div>
    
    <script src="./front/passCache.js"></script>
</body>
</html>
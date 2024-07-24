<?php
session_start();
  if(isset($_SESSION['userName'])){
    $servername = "localhost";
    $username = "liantsoa";
    $password = "liantsoa08"; // mot de passe anle admin ana admnin
    $database = "ChatApp"; // nom de la base de donnée
    $table = "message"; // nom de la table
    // se connecter avec mysql avec pdo
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        $userId=$_POST['userId'];
        $username=$_POST['username'];
        $mess=$_POST['message'];
        $requete=$conn->prepare("INSERT INTO $table (userId,username,mess)VALUES('$userId','$username','$mess')");
        $requete->execute();
        header('Location: ./messageGroupe.php');
    }
    catch(PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
    }
}
  else{
    header('Location: ./../index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../front/style.css">
    <title>ChatApp</title>
</head>
<body>
  <h1 id="title">RANDRIA'STASKS</h1>
  <div id="flex"><h2 id="user"></h2><button id="delete"><a href="./../php/delete.php">DELETE MESSAGE</a></button><button id="deconnexion"><a href="./../php/deconnexiom.php">Deconnexion</a></button></div>
    <div id="ALLmessage">
    </div>
    <?php
    ?>
    <ul id="MessBox">

    </ul>
    <form action="" method="post" id="envoi">
        
    </form>
    <script src="../front/functio.js"></script>
</body>
</html>
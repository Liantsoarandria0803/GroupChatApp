<?php 
header('Content-Type: application/json');
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
        $requete=$conn->prepare("SELECT * FROM $table");
        $requete->execute();
        $resultats = $requete->fetchAll(PDO::FETCH_OBJ);
        $retour["message"] = $resultats;
        
        // Convert the array to JSON
        $jsonRetour = json_encode($retour);
        
        // Output the JSON string
        echo $jsonRetour;
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
else{
    header("Location : ./../index.php");
}
?>

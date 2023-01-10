<?php 
require_once('../../layout/head.php');
require_once "../db/connect.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}


$messages = [];
$sql = "SELECT name, email, phone, message FROM contact_requests";
if($stmt = $pdo->prepare($sql)){
    if($stmt->execute()){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($messages, $row);
        }
    } else{
        echo "Something went wrong.";
    }
}
unset($stmt);
?>

<html>
    <head>
        <link href="../../perfil.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/58423cd6a9.js" crossorigin="anonymous"></script>

        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>Messages</title>
    </head>

    <body>
        <?php require_once("../../layout/navbar.php");?>
        
        <div class="column">
            <h1 class="text-center mb-4">Messages</h1>
            
            <div class="container d-flex align-items-center flex-column gap-3">
            <?php foreach($messages as $row):?>
                <div class="message">
                    <div><i class="fa-solid fa-user"></i> <?php echo $row["name"]; ?></div>
                    <div><i class="fa-solid fa-phone"></i> <?php echo $row["email"]; ?></div>
                    <div><i class="fa-solid fa-envelope"></i> <?php echo $row["phone"]; ?></div>
                    <div> <?php echo $row["message"]; ?></div>
                </div>
            <?php endforeach;?>
            </div>
            
        </div>
    </body>
</html>
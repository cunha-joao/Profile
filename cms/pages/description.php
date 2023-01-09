<?php 
    require_once('../../layout/head.php');

    // Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

if($_SESSION["role"] != 1) {
    header("location: ../../index.php");
    exit;
}
?>


<html>
    <head>
        <link href="../../perfil.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <meta charset="UTF-8">
        <title>Description</title>
    </head>

    <body>
        <?php require_once("../../layout/navbar.php");?>

        <?php
        // Update the database
        require_once "../db/connect.php";
        $description="";

        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $description = trim($_POST["description"]);

            $sql = "UPDATE description SET description=:description WHERE id=1";

            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":description", $description, PDO::PARAM_STR);
                if($stmt->execute()){
                    header("Location: ../../index.php");
                }

                unset($stmt);
            }
        }
        ?>

        <div class="editing">
            <form class="form" method="post">
                <h2>About me</h2>
                <div>
                    <textarea rows="7" name="description" id="description" required placeholder="Description" class="mb-4"></textarea>
                </div>
                <div>
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
    </body>
</html>
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
        <title>Contacts</title>
    </head>

    <body>
        <?php require_once("../../layout/navbar.php");?> 

        <?php
        // Update the database
        require_once "../db/connect.php";
        $phone="";
        $email="";

        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $phone = trim($_POST["phone"]);
            $email = trim($_POST["email"]);

            $sql = "UPDATE contacts SET phone=:phone, email=:email WHERE id=1";

            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);

                if($stmt->execute()){
                    header("Location: ../../index.php");
                }
                unset($stmt);
            }
        }
        ?>
        <div class="editing">
            <form class="form" method="post">
                <h2>Contacts</h2>
                <div>
                    <input type="text" name="phone" id="phone" required placeholder="Phone Number">
                </div>
                <div>
                    <input type="email" name="email" id="email" required placeholder="Email" class="mb-4">
                </div>
                <div>
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
    </body>
</html>
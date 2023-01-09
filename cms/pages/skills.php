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

        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>Skills</title>
    </head>

    <body>
        <?php require_once("../../layout/navbar.php");?>
        
        <?php
        // Update the database
        require_once "../db/connect.php";
        $my_skills="";
        $languages="";
        $education="";

        if($_SERVER["REQUEST_METHOD"] == 'POST'){
            $my_skills = trim($_POST["my_skills"]);
            $languages = trim($_POST["languages"]);
            $education = trim($_POST["education"]);

            $sql = "UPDATE skills SET my_skills=:my_skills, languages=:languages, education=:education WHERE id=1";

            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":my_skills", $my_skills, PDO::PARAM_STR);
                $stmt->bindParam(":languages", $languages, PDO::PARAM_STR);
                $stmt->bindParam(":education", $education, PDO::PARAM_STR);

                if($stmt->execute()){
                    header("Location: ../../index.php");
                }
                unset($stmt);
            }
        }
        ?>
        <div class="editing">
            <form class="form" method="post">
                <h2>Skills</h2>
                <div>
                    <input type="text" name="my_skills" id="my_skills" required placeholder="Skills">
                </div>
                <div>
                    <input type="text" name="languages" id="languages" required placeholder="Languages">
                </div>
                <div>
                    <input type="text" name="education" id="education" required placeholder="Education" class="mb-4">
                </div>
                <div>
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
    </body>
</html>
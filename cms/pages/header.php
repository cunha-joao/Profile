<?php 
    require_once('../../layout/head.php');
    require_once "../db/connect.php";

    // Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

if($_SESSION["role"] != 1) {
    header("location: ../../index.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $file = $_FILES["avatar"];
    $target_file = basename($file["name"]);

    if($file["size"] > 0){
        move_uploaded_file($file["tmp_name"], "../../assets/" . $target_file);

        $sql = "UPDATE header SET image_path=:path WHERE id=1";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":path", $target_file, PDO::PARAM_STR);

            $stmt->execute();
            unset($stmt);
        }
    }

    $name = trim($_POST["name"]);

    $sql = "UPDATE header SET name=:name WHERE id=1";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);

         if($stmt->execute()){
            header("Location: ../../index.php");
        } 
        unset($stmt);
    }
}
        

    $sql = "SELECT name FROM header WHERE id = 1";
    if($stmt = $pdo->prepare($sql)){
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $name = $row["name"];
            }
        }
    }
    unset($stmt);
?>

<html>
    <head>
        <link href="../../perfil.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <meta charset="UTF-8">
        <title>Header</title>
    </head>

    <body>
        <?php require_once("../../layout/navbar.php");?>

        <div class="editing">
            <form method="post" action="header.php" enctype="multipart/form-data" class="form">
                <input type="text" name="name" id="name" value="<?= $name ?>" placeholder="Full Name">
                <input type="file" name="avatar" id="avatar" accept="image/png, image/jpeg">

                <input type="submit" value="Save">
            </form>
        </div>
    </body>
</html>
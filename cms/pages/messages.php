<?php 
require_once('../../layout/head.php');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}
if($_SESSION["role"] != 2) {
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
        
    </body>
</html>
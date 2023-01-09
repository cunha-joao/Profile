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

        <title>Editing</title>
    </head>

    

    <body>
        <?php require_once("../../layout/navbar.php");?>


        <div class="container">
            <div class="row">
                <div class="editing-options col p-2">
                    <h1>Editing</h1>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="./header.php">Title</a></li>
                        <li  class="list-group-item"><a href="./description.php">About me</a></li>
                        <li class="list-group-item"><a href="./contacts.php" >Contacts</a></li>
                        <li class="list-group-item"><a href="./skills.php" >Skills</a></li>
                        <li class="list-group-item"><a href="./manager.php" >Register Manager</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
    </body>
</html>

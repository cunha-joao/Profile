<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}
?>

<html>
    <head>
        <link href="../../perfil.css" rel="stylesheet">

        <meta charset="UTF-8">
        <title>Editing</title>
    </head>

    <body>
        <div class="editing-options">
            <h2>Editing</h2>
            <div>
                <a href="./header.php" class="nav-link">Title</a>
            </div>
            <div>
                <a href="./description.php" class="nav-link">About me</a>
            </div>
            <div>
                <a href="./contacts.php" class="nav-link">Contacts</a>
            </div>
            <div>
                <a href="./skills.php" class="nav-link">Skills</a>
            </div>
            <div>
                <a href="../auth/logout.php">Sign out</a>
            </div>
        </div>
    </body>
</html>

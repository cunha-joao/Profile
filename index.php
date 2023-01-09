<?php
require_once('./layout/head.php');
require_once('./cms/db/connect.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="./perfil.css" rel="stylesheet">
        <!--Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <!--Icons-->
        <script src="https://kit.fontawesome.com/58423cd6a9.js" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>Curriculum Creator</title>
    </head>

    <body>
        <?php require_once("./layout/navbar.php");?>


        <div class="curriculo">
           
            <div class="header">
                <div class="img">
                    <img src="./assets/Profile.jpg">
                </div>
                <div class="name-title">João Carlos Ribeiro da Cunha</div>
            </div>

            <div class="profile">
                <h2>About me:</h2>
                I'm an autonomous person who likes to overcome challenges in creative ways. I like to spend most of my free time
                relaxing or learning new things and I love working with computers specialy when it comes to programming.
            </div>

            <div class="content">
                <div class="column">
                    <h2>Contacts</h2>
                    <div><i class="fa-solid fa-phone"></i> 966 686 606</div>
                    <div><i class="fa-solid fa-envelope"></i> joao.c.r.c@hotmail.com</div>
                    <div>
                        You can either contact me trough my <a href="tel:966686606">phone number</a>
                        or my <a href="mailto:joao.c.r.c@hotmail.com">email</a>.<br/>
                    </div>
                </div>

                <div class="column">
                    <h2>Skillset</h2>
                    <div><i class="fa-solid fa-star"></i> Autonomous, Empathetic, Flexible</div>
                    <div><i class="fa-solid fa-language"></i> Portuguese, English</div>
                    <div><i class="fa-solid fa-graduation-cap"></i> High School Graduate (Ciências e Tecnologia)</div>
                </div>
            </div>

            <form class="form">
                <h2>Contact me</h2>
                <div>
                    <input type="text" name="name" id="name" required placeholder="Name">
                </div>
                <div>
                    <input type="text" name="email" id="email" required placeholder="Email">
                </div>
                <div>
                    <input type="text" name="phone" id="phone" required placeholder="Phone">
                </div>
                <div>
                    <textarea rows="5" name="message" id="message" required placeholder="Message"></textarea>
                </div>
                <div>
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
    </body>
</html>
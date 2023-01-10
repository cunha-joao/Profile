<?php
require_once('./layout/head.php');
require_once "./cms/db/connect.php";

$name = $email = $phone = $message = "";
$name_err = $email_err = $phone_err = $message_err = $message_success = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    if(empty(trim($name))){
        $name_err = "Please enter your name.";
    }
    
    if(empty($email)){
        $email_err = "Please enter an email.";
    }

    if(empty($phone)){
        $phone_err = "Please enter a phone number.";
    }

    if(empty(trim($message))){
        $message_err = "Please enter your message.";
    }

    if(empty($name_err) && empty($email_err) && empty($phone_err) && empty($message_err)){
        $sql = "INSERT INTO `contact_requests` (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
        
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email , PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone , PDO::PARAM_STR);
            $stmt->bindParam(":message", $message , PDO::PARAM_STR);

            if($stmt->execute()) {
                $message_success = "Message sent successfully!";
            }

            unset($stmt);
        }
    }
}
            
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


        <div class="curriculo mb-4">
           
            <div class="header">
                <div class="img">
                    <img src="./assets/Profile.jpg">
                </div>
                <div class="name-title">João Carlos Ribeiro da Cunha</div>
            </div>

            <?php // Read "About me"
            require_once "./cms/db/connect.php";
            $sql = "SELECT description FROM description WHERE id = 1";
            if($stmt = $pdo->prepare($sql)){
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $description = $row["description"];
                    }
                } else{
                    echo "Something went wrong.";
                }
            }
            unset($stmt);
            ?>
            <div class="profile">
                <h2>About me:</h2>
                <p><?php echo $row["description"]; ?></p>
            </div>

            <div class="content">
                <div class="column">
                    <?php // Read "Contacts"
                    require_once "./cms/db/connect.php";
                    $sql = "SELECT phone, email FROM contacts WHERE id = 1";
                    if($stmt = $pdo->prepare($sql)){
                        if($stmt->execute()){
                            if($stmt->rowCount() == 1){
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $phone = $row["phone"];
                                $email = $row["email"];
                            }
                        } else{
                            echo "Something went wrong.";
                        }
                    }
                    unset($stmt);
                    ?>
                    <h2>Contacts</h2>
                    <div><i class="fa-solid fa-phone"></i> <?php echo $row["phone"]; ?></div>
                    <div><i class="fa-solid fa-envelope"></i> <?php echo $row["email"]; ?></div>
                    <div>
                        You can either contact me trough my <a href="tel:<?php echo $row["phone"]; ?>">phone number</a>
                        or my <a href="mailto:<?php echo $row["email"]; ?>">email</a>.<br/>
                    </div>
                </div>

                <div class="column">
                    <?php // Read "Skills"
                    require_once "./cms/db/connect.php";
                    $sql = "SELECT my_skills, languages, education FROM skills WHERE id = 1";
                    if($stmt = $pdo->prepare($sql)){
                        if($stmt->execute()){
                            if($stmt->rowCount() == 1){
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $my_skills = $row["my_skills"];
                                $languages = $row["languages"];
                                $education = $row["education"];
                            }
                        } else{
                            echo "Something went wrong.";
                        }
                    }
                    unset($stmt);
                    ?>
                    <h2>Skillset</h2>
                    <div><i class="fa-solid fa-star"></i> <?php echo $row["my_skills"]; ?></div>
                    <div><i class="fa-solid fa-language"></i> <?php echo $row["languages"]; ?></div>
                    <div><i class="fa-solid fa-graduation-cap"></i> <?php echo $row["education"]; ?></div>
                </div>
            </div>
            
            <form class="form" method="post">
                <?php if(!empty(trim($message_success))):?>
                    <div class="alert alert-success"><?= $message_success ?></div>
                <?php endif; ?>
                <h2>Contact me</h2>
                <div>
                    <input type="text" name="name" id="name" required placeholder="Name">
                </div>
                <div>
                    <input type="email" name="email" id="email" required placeholder="Email">
                </div>
                <div>
                    <input type="number" name="phone" id="phone" required placeholder="Phone">
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
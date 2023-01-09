<?php
    require_once('../../layout/head.php');
    
    // Include connect file
    require_once "../db/connect.php";

    
    // Define variables and initialize with empty values
    $name = $password = "";
    $name_err = $password_err = "";
 
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name = trim($_POST["name"]);
        $password = trim($_POST["password"]);

        // Validate username
        if(empty($name)){
            $name_err = "Please enter a username.";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
            $name_err = "Username can only contain letters, numbers, and underscores.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM `user` WHERE name = :name";
        
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                        
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $name_err = "This username is already taken.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                unset($stmt);
            }
        }
    
        // Validate password
        if(empty(trim($password))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        }
    
        // Check input errors before inserting in database
        if(empty($name_err) && empty($password_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO `user` (name, password) VALUES (:name, :password)";
            
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters

                $hashed = password_hash($password, PASSWORD_DEFAULT);

                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":password", $hashed , PDO::PARAM_STR);
                        
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $sql = "INSERT INTO `user_role` (user_id, role_id) VALUES ((SELECT id FROM `user` WHERE name=:name), 1)";

                    if($stmt = $pdo->prepare($sql)) {
                        $stmt->bindParam(":name", $name, PDO::PARAM_STR);

                        if($stmt->execute()) {
                            
                            // Redirect to login page
                            header("location: ../auth/login.php");
                        }else {
                            $stmt = $pdo->prepare("DELETE FROM `user` WHERE name = :name");

                            $stmt->bindParam(":name", $name, PDO::PARAM_STR);

                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                unset($stmt);
            }

        }
    // Close connection
    unset($pdo);
}
?>

<html>
    <head>
        <link href="../../perfil.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <meta charset="UTF-8">
        <title>Register</title>
    </head>

    <body>
        <?php require_once("../../layout/navbar.php");?>

        <div class="register">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Register</h2>

                <?php 
                    if(!empty($name_err)){
                        echo '<div class="alert alert-danger">' . $name_err . '</div>';
                    }
                    
                    if(!empty($password_err)){
                        echo '<div class="alert alert-danger">' . $password_err . '</div>';
                    }     
                ?>

                <div>
                    <input type="text" name="name" value="<?php echo $name; ?>" id="name" required placeholder="Username">
                </div>
                <div>
                    <input type="password" name="password" value="<?php echo $password; ?>" id="password" required placeholder="Password" class="mb-4">
                </div>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </body>
</html>
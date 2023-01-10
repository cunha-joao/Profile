<?php 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../index.php");
    exit;
}
 
// Include config file
require_once "../db/connect.php";
 
// Define variables and initialize with empty values
$name = "";
$name_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate credentials
    if(empty($name_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, name, password, ur.role_id as role FROM `user`, `user_role` as ur WHERE name = :name AND ur.user_id = user.id";
        
        if($stmt = $pdo->prepare($sql)){
            $param_name = trim($_POST["name"]);
            $param_password = trim($_POST["password"]);
            
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            
            // Set parameters
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $name = $row["name"];
                        $role = $row["role"];
                        $hashed_password = $row["password"];


                        if(password_verify($param_password, $hashed_password)){
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["role"] = $role;
                            
                            // Redirect user to welcome page
                            header("location: ../pages/options.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username.";
                }
            } else{
                echo "Something went wrong. Please try again.";
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
        <title>Login</title>
    </head>

    <body>
     <?php require_once("../../layout/navbar.php");?>

        <div class="container">
            <div class="row">
                <div class="login col">
                
                <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h1>Login</h1>

                    <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                    ?>

                        <input type="text" name="name" value="<?php echo $name; ?>" id="name" required placeholder="Username">
                        <input type="password" name="password" id="password" required placeholder="Password" class="mb-4">
                        <input type="submit" value="Login">
                        <a href="../pages/register.php">Don't have an account? Register here.</a>
                </form>
                </div>
                
            </div>
            
        </div>
        
    </body>
</html>
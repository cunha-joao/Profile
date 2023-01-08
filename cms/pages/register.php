<?php
    // Include connect file
    require_once "../db/connect.php";
    
    // Define variables and initialize with empty values
    $name = $password = "";
    $name_err = $password_err = "";
 
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate username
        if(empty(trim($_POST["name"]))){
            $name_err = "Please enter a username.";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))){
            $name_err = "Username can only contain letters, numbers, and underscores.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM `user` WHERE name = :name";
        
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            
                // Set parameters
                $param_name = trim($_POST["name"]);
            
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $name_err = "This username is already taken.";
                    } else{
                        $name = trim($_POST["name"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                unset($stmt);
            }
        }
    
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
    
        // Check input errors before inserting in database
        if(empty($name_err) && empty($password_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO `user` (name, password) VALUES (:name, :password)";
         
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
                // Set parameters
                $param_name = $name;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Redirect to login page
                    header("location: ../auth/login.php");
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

        <meta charset="UTF-8">
        <title>Register</title>
    </head>

    <body>
        <div class="register">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Register</h2>
                <div>
                    <input type="text" name="name" value="<?php echo $name; ?>" id="name" required placeholder="Username">
                </div>
                <div>
                    <input type="password" name="password" value="<?php echo $password; ?>" id="password" required placeholder="Password">
                </div>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </body>
</html>
<!--Model-->
<?php
    session_start();

    //checking if there is no missing data in the post request.
    if(isset($_POST["email"]) && isset($_POST["pass"])){

        //check if the email has "@"
        if(strpos($_POST["email"], "@")){

            //check for the correct password
            if($_POST["pass"] == "php123"){
                //succesful redirect to autos
                $_SESSION["success"] = "Login Sucessfull";
                $_SESSION["name"] = $_POST["email"];
                error_log("Login success ".$_POST["email"]);
                header("location: autos.php?name=".urlencode($_POST["email"]));
                return;
            }
            else{
                $_SESSION["error"] = "Incorrect password";
                error_log("Login fail ".$_POST["email"]." ".$_POST["pass"]);
                header("location: login.php");
                return;
            }
        }
        else{
            $_SESSION["error"] = "Email must have an at-sign (@)";
            error_log("Login fail ".$_POST["email"]." ".$_POST["pass"]);
            header("location: login.php");
            return;
        }
        
    }

    //missing data
    if(isset($_POST["email"]) && strlen($_POST["email"]) < 4 || isset($_POST["pass"]) && strlen($_POST["pass"]) < 4){
        $_SESSION["error"] = "Email and password are required";
        header("location: login.php");
        return;
    }

?>


<!-- View -->
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <title>Michael Rodriguez</title>
</head>

<body>
    <?php
    //default flash messages

    //success
     if(isset($_SESSION["success"])){
        echo("<p class='success'>".$_SESSION["success"].".</p>");
        unset($_SESSION["success"]);
    }

    //error
    
    if(isset($_SESSION["error"])){
        echo("<p class='error'>".$_SESSION["error"].".</p>");
        unset($_SESSION["error"]);
    }
    
    //this is just to welcome the user.
    if(isset($_SERVER["name"])){
        echo('<h3 class="row">Welcome '.htmlentities($_SERVER["name"]).'!</h3>');
    }
    
    ?>

    <main>
        <div class="row">
            <h3>Login</h3>
        </div>
        <form method="POST">
            <div class="row">
                <label for="email">E-mail<label>
                <input id="email" type="text" name="email" placeholder="Enter your E-mail"></input>
            </div>
            <div class="row">
                <label for="pass">Password<label>
                <input id="pass" type="password" name="pass" placeholder="Enter your password"></input>
            </div>
            <input type="submit" value="Submit" name="Submit"></input>

        </form>

        <div class="row">
            <p>If you don't know the right password please check the html content or the console log as a developer.<br>Just saying!</p>
        </div>
        
        <div class="row">
            <a href="./index.php">BackHome</a>
        <div>
    </main>



</body>

</html>
<!--Model-->
<?php
    require_once "pdo.php";
    session_start();
    
    //check for the session value of name
    if(!isset($_SESSION["name"])){
        die("ACCESS DENIED");
    }
    
    //adding the cars to the database
    if(isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"]) && isset($_POST["model"]) && strlen($_POST["make"]) > 1){
        
        // data validation.
        if(is_numeric($_POST["year"]) && is_numeric($_POST["mileage"])){
            //sql query
            $query = "INSERT INTO autos (make, year, mileage, model) 
            VALUES ( :mk, :yr, :mi, :mo)";
            //using PDO
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mo' => $_POST['model'],
                ':mi' => $_POST['mileage'])
            );
            $_SESSION["success"] = "added";
            header("location: index.php");
            return;
        }
        else{
            $_SESSION["error"] = "Mileage and year must be numeric";
            error_log("Login fail ".$_POST["email"]." ".$_POST["pass"]);
            header("location: add.php");
            return;
        }
        
    }

    //missing data
    if(isset($_POST["make"]) && strlen($_POST["make"]) <= 1){
        $_SESSION["error"] = "All values are required";
        header("location: add.php");
        return;
    }
    
?>


<!-- View -->
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <title>Michael Rodríguez Gamboa</title>
</head>

<body>
    
    <header>
        <h2>Add Autos to Database</h2>
    </header>

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
        if(isset($_SESSION["name"])){
            echo('<h3 class="row">Welcome '.htmlentities($_SESSION["name"]).'!</h3>');
        }
        
    ?>

    <main>
        <form method="POST">
            <div class="row">
                <label for="make">Make<label>
                <input id="make" type="text" name="make" placeholder="Car brand"></input>
            </div>
            <div class="row">
                <label for="model">Model<label>
                <input id="model" type="text" name="model" placeholder="Model of the car"></input>
            </div>
            <div class="row">
                <label for="year">Year<label>
                <input id="year" type="text" name="year" placeholder="Year of the car"></input>
            </div>
            <div class="row">
                <label for="mileage">Mileage<label>
                <input id="mileage" type="text" name="mileage" placeholder="Mileage of the car"></input>
            </div>
            
            <div id="buttons" class="row">
                <input type="submit" value="Add new"></input>
                <input type="button" value="Cancel" onclick='location.href="./index.php"'></input>
            </div>
        </form>
    </main>

</body>

</html>
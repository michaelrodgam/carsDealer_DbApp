<!--Model-->
<?php
    require_once "pdo.php";
    session_start();
    
    //check for the session value of name
    if(!isset($_SESSION["name"])){
        die("ACCESS DENIED");
    }
    
    if(!isset($_GET["id"])){
        die("Missing id");
    }
    
    //adding the cars to the database
    if(isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"]) && isset($_POST["model"]) && strlen($_POST["make"]) > 1){
        
        // data validation.
        if(is_numeric($_POST["year"]) && is_numeric($_POST["mileage"])){
            
            //sql query
            $query = "UPDATE autos SET make = :mk, year = :yr, mileage= :mi, model= :mo 
                WHERE auto_id = :id";
            
            //using PDO
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mo' => $_POST['model'],
                ':id' => $_POST['auto_id'],
                ':mi' => $_POST['mileage'])
            );
            $_SESSION["success"] = "Record edited";
            header("location: index.php");
            return;
        }
        else{
            $_SESSION["error"] = "Mileage and year must be numeric";
            error_log("Login fail ".$_POST["email"]." ".$_POST["pass"]);
            header("location: index.php");
            return;
        }
        
    }

    //missing data
    if(isset($_POST["make"]) && strlen($_POST["make"]) <= 1){
        $_SESSION["error"] = "Make is required";
        header("location: index.php");
        return;
    }
    
    //getting the values to display it below
    $query2 = "SELECT * FROM autos WHERE auto_id = :id";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute(array(":id" => $_GET["id"]));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    if($row === false){
        $_SESSION['error'] = 'Bad value for user_id';
        header( 'Location: index.php' ) ;
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
            <div class="row">
                <h2>Edit Autos Data</h2>
            </div>
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
    ?>

    <main>
        <form method="POST">
            <input type="hidden" name="auto_id" value=<?= $row["auto_id"]?>>
            <div class="row">
                <label for="make">Make<label>
                <input id="make" type="text" name="make" value=<?= $row["make"]?> placeholder="Car brand">
            </div>
            <div class="row">
                <label for="model">Model<label>
                <input id="model" type="text" name="model" value=<?= $row["model"]?> placeholder="Model of the car">
            </div>
            <div class="row">
                <label for="year">Year<label>
                <input id="year" type="text" name="year" value=<?= $row["year"]?> placeholder="Year of the car">
            </div>
            <div class="row">
                <label for="mileage">Mileage<label>
                <input id="mileage" type="text" name="mileage" value=<?= $row["mileage"]?> placeholder="Mileage of the car">
            </div>
            <div id="formButtons" class="row">
                <input type="submit" value="Save"></input>
                <input type="button" value="Cancel" onclick='location.href="./index.php"'>
            </div>
        </form>
    </main>

</body>

</html>
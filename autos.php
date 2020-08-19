<!--Model-->
<?php
    require_once "pdo.php";
    session_start();
    
    //check for the get value of name
    if(!isset($_GET["name"])){
        die("Name parameter missing");
    }
    
    //adding the cars to the database
    if(isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"]) && strlen($_POST["make"]) > 1){
        
        // data validation.
        if(is_numeric($_POST["year"]) && is_numeric($_POST["mileage"])){
            //sql query
            $query = "INSERT INTO autos (make, year, mileage) 
            VALUES ( :mk, :yr, :mi)";
            //using PDO
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage'])
            );
            $_SESSION["success"] = "Record inserted";
            header("location: autos.php?name=".urlencode($_SESSION["name"]));
            return;
        }
        else{
            $_SESSION["error"] = "Mileage and year must be numeric";
            error_log("Login fail ".$_POST["email"]." ".$_POST["pass"]);
            header("location: autos.php?name=".urlencode($_SESSION["name"]));
            return;
        }
        
    }

    //missing data
    if(isset($_POST["make"]) && strlen($_POST["make"]) <= 1){
        $_SESSION["error"] = "Make is required";
        header("location: autos.php?name=".urlencode($_SESSION["name"]));
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
        <div class="row">
            <h3>Autos</h3>
        </div>
        
        <form method="POST">
            <div class="row">
                <label for="make">Make<label>
                <input id="make" type="text" name="make" placeholder="Car brand"></input>
            </div>
            <div class="row">
                <label for="mileage">Mileage<label>
                <input id="mileage" type="text" name="mileage" placeholder="Mileage of the car"></input>
            </div>
            <div class="row">
                <label for="year">Year<label>
                <input id="year" type="text" name="year" placeholder="Year of the car"></input>
            </div>
            <div class="row">
                <input type="submit" value="Add" name="Add"></input>
            </div>
        </form>

        <?php 
            
            //showing the content of the database
            $stmt2 = $pdo->query("SELECT * FROM autos");
            $rows = array();
            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $rows[count($rows)] = $row;
            }
            
            echo('<div class="row"><h3>Cars list:</h3>');
            echo('<div class="row"><ul>');

            if(count($rows) > 0){
                for($i = 0; $i < count($rows); $i++){
                    echo("<li> Car: ".htmlentities($rows[$i]["make"]).". Mileage: ".$rows[$i]["mileage"].". Year: ".$rows[$i]["year"].".</li>");
                }
            }
            else{
                echo("<li>Nothing to show from the database</li>");
            }

            echo("</ul></div></div>");
            
        ?>
        
        <div class="row">
            <a href="./index.php">BackHome</a>
        </div>
        <div class="row">
            <a href="./logout.php">logout</a>
        </div>
        
        

    </main>

</body>

</html>
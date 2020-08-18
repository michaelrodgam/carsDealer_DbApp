<!--Model-->
<?php
    require_once "pdo.php";
    session_start();

    //check for the get value of name
    if(!isset($_GET["name"])){
        die("Name parameter missing");
    }

    //adding the cars to the database
    if(isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"])){
        
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
            <h3>Autos</h3>
        </div>
        <form method="POST">
            <div class="row">
                <label for="make">Make<label>
                <input id="make" type="text" name="make" placeholder="Enter the car brand and/or model"></input>
            </div>
            <div class="row">
                <label for="mileage">Mileage<label>
                <input id="mileage" type="text" name="mileage" placeholder="Enter the mileage of the car"></input>
            </div>
            <div class="row">
                <label for="year">Year<label>
                <input id="year" type="text" name="year" placeholder="Enter the year of the car"></input>
            </div>
            <div class="row">
                <input type="button" value="Add" name="add"></input>
            </div>
        </form>
        
        <div class="row">
            <a href="./index.php">BackHome</a>
        <div>
        <div class="row">
            <a href="./logout.php">Logout?</a>
        <div>
        
        <?php 

            //showing the content of the database
            $stmt2 = $pdo->query("SELECT make, mileage, year FROM autos");
            echo('<div class="row"><ul>');

            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                echo("<li>".htmlentities($row["make"])."</li>");
            }

            echo("</ul></div>");
        ?>

    </main>

</body>

</html>
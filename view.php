<!--Model-->
<?php
    require_once "pdo.php";
    session_start();

    //check for the session value of name
    if(!isset($_SESSION["name"])){
        die("Not logged in");
    }

?>

<!--View-->
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
            <h3>View Autos Data</h3>
        </div>

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
            <input type="button" value="Add New" onclick='location.href="./add.php"'></input>
        </div>
        
        <div class="row">
            <input type="button" value="Home"  onclick='location.href="./index.php"'></input>
            <input type="button" value="Logout" onclick='location.href="./logout.php"'></input>
        </div>
        
        <a href="./add.php">Add New</a>
        <a href="./logout.php">Logout</a>


    </main>

</body>

</html>
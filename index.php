<!--Model-->
<?php 
    require_once "pdo.php";
    session_start();

    if(!isset($_SESSION["name"])){
        header("location: ./login.php");
    }

?>


<!-- View -->
<html>

<head>
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">

    <title>Michael Rodríguez Gamboa</title>
</head>

<body>
    <header >
        <div id="imaContainer">
            <div id="innerContainer">
                <h2>Car Dealer Database Project</h2>
            </div>
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

    <?php 
            
            //showing the content of the database
            $stmt2 = $pdo->query("SELECT * FROM autos");
            $rows = array();
            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $rows[count($rows)] = $row;
            }
            
            echo('<div class="row"><h3>Welcome '.htmlentities($_SESSION["name"]).'<h3></div>');
            echo('<div id="TableInfo"><h4>Cars list:</h4>');
            
            if(count($rows) > 0){
                
                //making the table
                echo('<div class="showData"><table>');
                echo("<tr><th>Make</th><th>Model</th><th>Year</th><th>Mileage</th><th>Action</th></tr>");
                
                for($i = 0; $i < count($rows); $i++){
                    echo("<tr><td>".htmlentities($rows[$i]["make"])."</td><td>".htmlentities($rows[$i]["model"])."</td>");
                    echo("<td>".$rows[$i]["year"]."</td><td>".$rows[$i]["mileage"]."</td>");
                    
                    //these are the other buttons "Edit"/"Delete"
                    echo('<td><input type="button" value="Edit" onclick="location.href=&#34./edit.php?id='.$rows[$i]["auto_id"].'&#34">');
                    echo('<input type="button" value="Delete" onclick="location.href=&#34./delete.php?id='.$rows[$i]["auto_id"].'&#34"></td>');
                    echo("</tr>");
                }
                echo("</table></div>");
            }
            else{
                echo("<h3>No rows found</h3>");
            }
            echo("</div>");

            
            
        ?>

        <div id="Buttons" class="row">
            <input type="button" value="Add New" onclick='location.href="./add.php"'></input>
       
            <input type="button" value="Logout" onclick='location.href="./logout.php"'></input>
        </div>

</body>

</html>
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
        
    if(isset($_POST["id"])){
        //sql query
        $query = "DELETE FROM autos WHERE auto_id= :id";
            
        //using PDO
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':id' => $_POST['id']));
        $_SESSION["success"] = "Record deleted";
        header("location: index.php");
    }
    //getting the values to display it below
    $query2 = "SELECT * FROM autos WHERE auto_id = :id";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute(array(":id" => $_GET["id"]));
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
?>


 <!--view-->

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <title>Michael Rodríguez Gamboa</title>
</head>

<body>
    <header>
        <div class="row">
                <h2>Delete Data from Database</h2>
            </div>
    </header>
    <main>
        <div class="row">
            <h3>Confirm: Deleting of <?= htmlentities($row['make']) ?></h3>
        
            <form method="post">
                <input type="hidden" name="id" value="<?= $row['auto_id'] ?>">
                <input type="submit" value="Delete" name="delete">
                <input type="button" value="Cancel" onclick='location.href="./index.php"'>
            </form>
        </div>
    </main>
<body>
</html>
<!--Model-->
<?php 
session_start();

?>


<!-- View -->
<html>

<head>
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./styles/styles.css">

    <title>Michael Rodriguez</title>
</head>

<body>
    <header>
        <h3>Hello, this is Michael's Car Dealer Project</h3>
    </header>
    
   <?php
    if(isset($_SESSION["name"])){
        $href = "logout.php";
        $name = "Ready to Logout?";
        echo('<div class="row"><h3>Welcome '.htmlentities($_SESSION["name"]).'<h3></div>');
    }
    else{
        $href = "login.php";
        $name = "Please Login";
    }
   echo(
       '<div class="row">
            <a href="'.$href.'">'.$name.'</a> 
        </div>'
    );
   ?>

</body>

</html>
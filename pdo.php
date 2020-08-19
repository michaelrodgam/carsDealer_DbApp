<?php
    //this connect to the db;
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=misc","michael","zap"); 

    //this make the errors no visible to the user, do not show up.
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
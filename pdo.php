<?php
//This connect the app to the db.

$pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc', 'michael', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
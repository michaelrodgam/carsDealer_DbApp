<?php 
    //this just clear the session data, and log out the account. Easy, boy!
    session_start();
    session_destroy();
    header("location: index.php");
?>
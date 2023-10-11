<?php 
    session_start(); // start sess
    
    session_destroy(); // desttroy sess
    
    header('Location:index.php'); //redirection
    
    die();
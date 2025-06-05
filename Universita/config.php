<?php
    $host="localhost";
    $user="root";
    $pw="";
    $db="Universita";

    $conn= new mysqli($host, $user, $pw, $db);

    if($conn->connect_error){
        die("Errore: " .$conn->connect_error);
    }
?>
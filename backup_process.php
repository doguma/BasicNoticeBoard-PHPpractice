<?php

    header("Progma:no-cache");
    header("Cache-Control:no-cache, must-revalidate");

    require_once("dbconfig.php");


    $query = "UPDATE content SET backup=1 WHERE id='".$_GET['id']."'";
    $result = mysqli_query($conn, $query);
    header ("Location: list.php");

    
?>
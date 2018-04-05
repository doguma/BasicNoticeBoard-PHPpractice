<?php
    header("Progma:no-cache");
    header("Cache-Control:no-cache, must-revalidate");

    require_once("dbconfig.php");


    $query = "DELETE from content WHERE id='".$_GET['id']."'";
    $result = mysqli_query($conn, $query);
    header ("Location: list.php");




?>
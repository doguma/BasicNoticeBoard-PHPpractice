<?php

    header("Progma:no-cache");
    header("Cache-Control:no-cache, must-revalidate");

    require_once("dbconfig.php");
    $id = $_GET["id"];

    $title = trim($_POST["title"]);
    $writer = trim($_POST["writer"]);
    $content= trim($_POST["content"]);

if (empty($title) || empty($writer) || empty($content)) {
    echo "<script>
            alert('Type in valid input');
            window.location.href='list.php';
            </script>";
} elseif ($id != null) {

    $title = mysqli_real_escape_string($conn, $title);
    $writer = mysqli_real_escape_string($conn, $writer);
    $content = mysqli_real_escape_string($conn, $content);

    $query = "UPDATE content SET title='".$title."', writer='".$writer."', content='".$content."' WHERE id='".$id."'";
    $result = mysqli_query($conn, $query);
        
    if ($result == false) {
        echo "Failed to insert data into database<br>";
        echo "Error: ".mysqli_error($conn);
    } else {
        header("Location: detail.php?id=".$id);
    }

} else {
    $title = mysqli_real_escape_string($conn, $title);
    $writer = mysqli_real_escape_string($conn, $writer);
    $content = mysqli_real_escape_string($conn, $content);

    $query = "INSERT INTO content (title, writer, content)
        VALUES ('".$title."','".$writer."','".$content."')";
    $result = mysqli_query($conn, $query);
        
    if ($result == false) {
        echo "Failed to insert data into database<br>";
        echo "Error: ".mysqli_error($conn);
    } else {
        header("Location: list.php");
    }
}

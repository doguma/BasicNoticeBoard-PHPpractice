<?php
    header("Progma:no-cache");
    header("Cache-Control:no-cache, must-revalidate");

    require_once("dbconfig.php");
    $id = $_GET["id"];
?>

<!DOCTYPE html>
<html>

<head>  
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="write.css">
    <title> 21300254 - 도현진 Hyunjin Do </title>        
</head>

<body>

<?php
$query = "SELECT title, writer, content from content WHERE id='".$_GET['id']."'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
?>


<div class="container">
    <form class="form-horizontal" action="write_process.php?id=<?php echo $id?>" method="post">
        <div class="form-group">
            <label class="col-md-2 control-label">Title</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="title" value="<?php echo $row["title"]?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Writer</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="writer" value="<?php echo $row["writer"]?>" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Content</label>
            <div class="col-md-10">
                <textarea class="form-control" name="content" rows="10" required><?php echo $row["content"]?></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <button id = "tolist" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-warning" type="submit">Edit</button>
            </div>
        </div>

    </form>

</div>



<script>
        $(function(){

    $("#tolist").click(function(){
        location.href="list.php";
    });

});
</script>


<?php
}

?>
</body>
</html>

<script>
        function updatee2(id){
            location.href="write_process.php?id="+id;
            return true;
    }


</script>



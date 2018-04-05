<?php
    require_once("dbconfig.php");
    $id = $_GET["id"];
if ($id == null) {
    echo '<body>';
    echo '<script type="text/javascript">';
    echo 'alert("This is not the right access.");';
    echo 'window.location.href="list.php"';
    echo '</script>';
    echo '</body>';
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/js/bootstrap-dialog.min.js"></script>


    <title> 21300254 - 도현진 Hyunjin Do </title>
</head>

<body>

<div class="container">
    <?php

        $query = "SELECT title, writer, content, backup FROM content WHERE id= ".$id;
        $result = mysqli_query($conn, $query);

        

    while ($row = mysqli_fetch_array($result)) {
        $access = $row["backup"];

        if ($access) {
            echo "<script>
                alert('WRONG ACCESS: unavailable backup data');
                window.location.href='list.php';
                </script>";
        } else {
            echo "<div class='page-header'>";
            echo "<h1><small>Title:</small>".$row["title"]."</h1>";
            echo "</div>";
            echo "<div class='panel panel-default'>";
            echo "<div class='panel-heading'> Writer: ".$row["writer"]."</div>";
            echo "<div class='panel-body'>".nl2br($row["content"])."</div>";
            echo "</div>";
        }
    }
    
    ?>

<article>
<div class="pull-right">
 <input type="button" class="btn btn-warning" onClick="updatee(<?php echo $id ?>)" name="Update" value="Edit">
 <input type="button" class="btn btn-danger" onClick="deletee(<?php echo $id ?>)" name="Delete" value="Delete">
 <input type="button" class="btn btn-info" onClick="backupp(<?php echo $id ?>)" name="Backup" value="Backup">
</div>

<div class="pull-left"><button id = "tolist" class="btn btn-default" type="button">List</button>
</div>
<?php
        include 'footer.html';
    ?>
</div>
</article>
<script>
    function deletee(id){
        BootstrapDialog.confirm({
            title: 'Hi',
            message: 'Are you sure you want to delete this?',
            type: BootstrapDialog.TYPE_DEFAULT, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnCancelLabel: 'No', // <-- Default value is 'Cancel',
            btnOKLabel: 'Yes', // <-- Default value is 'OK',
            btnOKClass: 'btn-danger', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
                    location.href="delete_process.php?id="+id;
                    return true;
                }
            }
        });
    }


    function updatee(id){
            location.href="update_process.php?id="+id;
            return true;
    }

    function backupp(id){
        BootstrapDialog.confirm({
            title: 'Um',
            message: 'Are you sure you want to backup this post?',
            type: BootstrapDialog.TYPE_DEFAULT, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            btnCancelLabel: 'No', // <-- Default value is 'Cancel',
            btnOKLabel: 'Yes', // <-- Default value is 'OK',
            btnOKClass: 'btn-info', // <-- If you didn't specify it, dialog type will be used,
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
                    location.href="backup_process.php?id="+id;
                    return true;
                }
            }
        });
    }


    $(function(){

    $("#tolist").click(function(){
        location.href="list.php";
    });

});
</script>

</body>
</html>


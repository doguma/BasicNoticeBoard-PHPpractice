
 <?php
  require_once("dbconfig.php");
  $page = $_GET["page"];
 if ($page == null) {
     $page = 1;
 } else {
        $page = (int)$_GET["page"];
       }

    $items_per_page = $_GET['how_many'];

    if(!isset($items_per_page)){
            $items_per_page = 10;
            $offset= ($page-1) * $items_per_page;
    }else{
            $items_per_page = (int)$items_per_page;
            $offset= ($page-1) * $items_per_page;
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="list.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>21300254 - 도현진 Hyunjin Do</title>
  </head>

  <body>

    <div class="container" style="margin-top:50px;">
    <div class="float-left">
    <form name=search method=get action="<?=$PHP_SELF?>">
       
        <select class="selectpicker" name=field>
            <option value=title selected>title</option>
            <option value=writer>writer</option>
        </select>
        
        <input type=text name=search_word size=25 value=<?php $search_word = $_GET['search_word']; ?>>
        <input type=submit class="btn btn-info" value=search>
        <button id="btn2" class="btn btn-default" type="button"><span class="glyphicon glyphicon-refresh"></span></button>

    </form>

</div>
<div class="float-right">

    <form class="selectpicker" id=postnum method=get action="list.php">
        <select name=how_many onchange="this.form.submit();">
            <option value=10 <?php if($items_per_page==10){echo "selected";}?> > 10 posts each</option>
            <option value=5 <?php if($items_per_page==5) {echo "selected";}?> >5 posts each</option>
            <option value=15 <?php if($items_per_page==15) {echo "selected";}?> >15 posts each</option>
        </select>
        <noscript><input type="submit" value="Submit"></noscript>
    </form>    

</div>

          
      <table class="table table-hover">
        <thead>
          <tr>
            <th id="number">#</th>
            <th id="title">Title</th>
            <th id="writer">Writer</th>
            <th id="date">Date</th>
          </tr>
        </thead>
        <tbody>

    <?php

        $search_word = $_GET['search_word'];
        $field = $_GET['field'];

        if ($search_word==null) {
            $query = "SELECT id, title, writer, write_date FROM content WHERE backup != 1 LIMIT " .$offset.",".$items_per_page;
            $result = mysqli_query($conn, $query);
            $add_query = "";
            $add_url = "";

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["title"]."</td>";
                echo "<td>".$row["writer"]."</td>";

                $date = date_create($row["write_date"]);

                echo "<td>".date_format($date, "d/m/Y h:i A")."</td>";
                echo "</tr>";
  
            }

        }else if((0<=strlen(trim($search_word)) && strlen(trim($search_word))<2) || empty($search_word)){

            echo "<script>
            alert('Search word has to be at least two characters.');
            window.location.href='list.php';
            </script>";

        }else if(!empty(trim($search_word))){
            $add_query = "AND ".$field." like '%" . $search_word . "%' ";
            $add_url = "&search_word=".$search_word."&field=".$field;
            
                $query = "SELECT id, title, writer, write_date FROM content WHERE (backup != 1 ".$add_query.") LIMIT " .$offset.",".$items_per_page;
                $result = mysqli_query($conn, $query);
    
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["title"]."</td>";
                    echo "<td>".$row["writer"]."</td>";
    
                    $date = date_create($row["write_date"]);
    
                    echo "<td>".date_format($date, "d/m/Y h:i A")."</td>";
                    echo "</tr>";
            }
        }
            ?>

        </tbody>
      </table>

      <button id="btn" class="btn btn-default" type="button">Write</button>

      <div class="text-center">
        <ul class="pagination col-md-12">
            <?php


            $add_url2 = "&how_many=".$items_per_page;

            $query = "SELECT id FROM content WHERE (backup != 1 ".$add_query.")";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if (!($rows <= $items_per_page)) {
                if ($page == 1) {
                    echo "<li class='disabled'><a href='#'><span>&laquo;</span></a></li>";
                } else {
                    echo "<li><a href='list.php?page=".($page - 1)."&how_many=".$items_per_page.$add_url."'><span>&laquo;</span></a></li>";
                }
                for ($i = 1; $i <= (int)($rows / $items_per_page + 1); $i++) {
                    if ($page == $i) {
                        echo "<li class='active'><a href='list.php?page=".$i."&how_many=".$items_per_page.$add_url."'>".$i."</a></li>";
                    } else {
                        echo "<li><a href='list.php?page=".$i."&how_many=".$items_per_page.$add_url."'>".$i."</a></li>";
                    }
                }
                if ($page == (int)($rows / $items_per_page + 1)) {
                    echo "<li class='disabled'><a href='#'><span>&raquo;</span></a></li>";
                } else {
                    echo "<li><a href='list.php?page=".($page + 1)."&how_many=".$items_per_page.$add_url."'><span>&raquo;</span></a></li>";
                }
            } else {
                echo "<li class='disabled'><a href='#'><span>&laquo;</span></a></li>";
                echo "<li class='active'><a href='list.php?page=1'>1</a></li>";
              
                echo "<li class='disabled'><a href='#'><span>&raquo;</span></a></li>";
            }
            ?>
        </ul>
      </div>

      <script>
        $(function() {
          $("table > tbody > tr").click(function() {
            var number = $(this).find("td").eq(0).text();
            var url = "detail.php?id=" + number;
            location.href = url;
          });
          $("#btn").click(function() {
            location.href = "write.html";
          });
          $("#btn2").click(function() {
            location.href = "list.php";
          });
        });
      </script>


    <?php
        include 'footer.html';
    ?>

    </div>



  </body>
</html>
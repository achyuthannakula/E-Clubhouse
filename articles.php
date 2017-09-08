<?php
require('nav.html');
?>
<script>
document.getElementById("articles").className = 'bold active blue';
document.getElementById("page").innerHTML = 'Articles';
</script>
<main>
    <div class="container">
        <div class="row">
            <?php
            require("db_config.php");
            if(!isset($_GET['a'])&&!isset($_GET['t']))
              $q = "SELECT * FROM ARTICLES";
            else if(isset($_GET['a']) && strlen($_GET['a'])>0)
              $q = "SELECT * FROM ARTICLES WHERE author=".mysqli_real_escape_string($conn,$_GET['a']);
            else if(strlen($_GET['t'])>0)
              $q = "SELECT * FROM ARTICLES WHERE tag=".mysqli_real_escape_string($conn,$_GET['t']);
            else
              $q = "SELECT * FROM ARTICLES";
            $res = mysqli_query($conn,$q);
            if(is_bool($res) && !$res)
            {
              echo "Error!<br>Try again, Contact Administrator if problem persists";
              exit();
            }
            if(mysqli_num_rows($res)>0)
            {
              while($r = mysqli_fetch_assoc($res))
              {
                echo "<div class=\"col s12 m12\"><div id=\"atr-div\" class=\"card hoverable horizontal valign-wrapper\" style=\"overflow:hidden;\"><div class=\"card-image col s12 m6 l6\" style=\"margin-left:0px\"><a href=\"article.php?sno=".$r['sno']."\"><img class=\"responsive-img\" src=\"".$r['img']."\" style=\"margin-top:10px; margin-bottom:10px\"></a></div><div class=\"card-stacked col s12 m6 l6\"><div id=\"con-div\" class=\"card-content\" style=\"padding:0px\"><p class=\"blue-text\">"."<a href=\"articles.php?t=".$r['tag']."\">".$r['tag']."</a></P><a href=\"article.php?sno=".$r['sno']."\" style=\"color:#000000;\"> <span style=\"font-size:2rem;\">".$r['title']."</span></a><p class=\"grey-text text-darken-6\"><a href=\"articles.php?a=".$r['author']."\">".$r['author']."</a><span class=\"right\">".date('F j, Y',strtotime($r['dt']))."</span></p></div></div></div></div>";
              }
              exit();
            }
            else {
              echo "<br><br>No Articles Posted";
            }
            ?>

    </div>
  </div>
</main>
<?php
require('footer.html');
?>
<script>
if ( $(window).width() <= 739) {
document.getElementById("atr-div").className = 'card hoverable';
document.getElementById("con-div").style = '';
document.getElementById("art-span").style = 'font-size:1.5rem';
}
</script>

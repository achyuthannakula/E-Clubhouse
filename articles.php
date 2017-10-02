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
            $q = "SELECT * FROM ARTICLES ORDER BY sno DESC";
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
                echo "<div class=\"col s12 m12\"><div class=\"atr-div card hoverable horizontal valign-wrapper\" style=\"overflow:hidden;\"><div class=\"card-image col s12 m6 l6\" style=\"margin-left:0px\"><a href=\"article.php?sno=".$r['sno']."\"><img class=\"responsive-img\" src=\"".$r['img']."\" style=\"margin-top:10px; margin-bottom:10px\"></a></div><div class=\"card-stacked col s12 m6 l6\"><div class=\"con-div card-content\" style=\"padding:0px\"><p class=\"blue-text\">"."<a>".$r['tag']."</a></P><a href=\"article.php?sno=".$r['sno']."\" style=\"color:#000000;\"> <span style=\"font-size:2rem;\">".$r['title']."</span></a><p class=\"grey-text text-darken-6\"><a>".$r['author']."</a><span class=\"right\">".date('F j, Y',strtotime($r['dt']))."</span></p></div></div></div></div>";
              }
            }
            else {
              echo "<br><br>No Articles Posted";
            }
            ?>

    </div>
  </div>

</main>
<script>
if ( document.documentElement.clientWidth <= 739) {
  var cardClass1 = document.getElementsByClassName("atr-div");
  for(var i=0; i < cardClass1.length; i++){
    cardClass1[i].calssName = 'atr-div card hoverable';
  }
  var cardClass2 = document.getElementsByClassName("con-div");
  for(var i=0; i < cardClass2.length; i++){
    cardClass2[i].style = '';
  }
  var cardClass3 = document.getElementsByClassName("art-span");
  for(var i=0; i < cardClass3.length; i++){
    cardClass3[i].style = 'font-size:1.5rem';
  }
}
</script>
<?php
require('footer.html');
?>

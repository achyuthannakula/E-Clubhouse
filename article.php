<?php
require('nav.html');
?>
<script>
document.getElementById("articles").className = 'bold active blue';
document.getElementById("page").innerHTML = 'Articles';
</script>
<main>
  <?php
  $l=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  require("db_config.php");
  $q = "SELECT * FROM ARTICLES WHERE sno=".mysqli_real_escape_string($conn,$_GET['sno']);
  $res = mysqli_query($conn,$q);
  if(mysqli_num_rows($res)==1)
    $r=mysqli_fetch_assoc($res);
  echo "<div class=\"parallax-container\"><div class=\"parallax\"><img src=\"".$r['img']."\"></div></div><div class=\"container\"><h2 style=\"margin-bottom:-2%\">".$r['title']."</h2><br><h6 style=\"font-color:grey\">By <a href=\"articles.php?a=".$r['author']."\">".$r['author']."</a><br>".date('F j, Y',strtotime($r['dt']))."<a href=\"articles.php?t=".$r['tag']."\"><span class=\"green white-text right\" style=\"padding:5px;border-style: hidden;border-radius: 5px;margin-top:-5px\">#".$r['tag']."</span></h6></a><br><div class=\"addthis_inline_share_toolbox\"></div>".$r['content']."<div class=\"fb-like\" data-href=\"".$l."\" data-layout=\"button_count\" data-action=\"like\" data-size=\"large\" data-show-faces=\"false\" data-share=\"false\"></div><div class=\"fb-comments\" data-href=\"".$l."\" data-width=\"100%\" data-numposts=\"5\"></div></div>";?>

</main>
<?php
require('footer.html');
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d9480305e60186"></script>

<?php
require('nav.html');
?>
<script>
document.getElementById("session").className = 'bold active blue';
document.getElementById("page").innerHTML = 'Sessions';
</script>
<main>
    <div class="container">
        <div class="row">
          <?php
          require('db_config.php');
          $q = "SELECT * FROM SV";
          $res = mysqli_query($conn,$q);
          if(is_bool($res) && !$res)
          {
            echo "<h2>Error! Try Again Later!</h2>";
            exit();
          }
          if(mysqli_num_rows($res)>0)
          {
            while($row=mysqli_fetch_assoc($res))
            {
              echo "<div class=\"col s12 m12 l12\"><div class=\"card hoverable\"><div class=\"video-container\"><iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/videoseries?list=",$row['Link'],"\" frameborder=\"0\" allowfullscreen></iframe></div><div class=\"card-content\" style=\"padding-top:10px\"<p>",$row['Date'],"</p><div class=\"card-title grey-text text-darken-4\">",$row['Title'],"</div></div></div></div>";
            }
          }
          else {
            echo "<h2>No Videos posted yet!<br>Stay tuned for updates....</h2>";
            exit();
          }
          ?>
          </div>
        </div>
    </div>
</main>
<?php
require('footer.html');
?>

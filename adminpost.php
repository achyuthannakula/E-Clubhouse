<?php
session_start();
if( (!isset($_SESSION['username']) || strlen($_SESSION['username']) == 0) && (!isset($_SESSION['password']) || strlen($_SESSION['password']) == 0)  )
{
  $_SESSION['adminmsg'] = "Enter username and password to continue.";
  header("location: admin.php");
}
require('nav.html');
?>
<script>
document.getElementById("admin").className = 'bold active blue';
document.getElementById("page").innerHTML = 'Admin';
document.getElementById("admin2").innerHTML = 'Logout';
document.getElementById("admin2").href = 'logout.php';
</script>
        <main>
            <div class="container">
              <h3>Articles</h3>
              <form action="posta.php" method="POST" id="art" enctype="multipart/form-data">
                <div class="input-field">
                    <input type="text" name="title" data-length="60" maxlength="60" length="60" class="validate" required>
                    <label>Title</label>
                </div>
                  <textarea name="text" class="materialize-textarea" form="art"></textarea>
                  <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="file">
      </div>
      <div class="file-path-wrapper">
        <input name="filepath" class="file-path" type="text" placeholder="Upload file">
      </div>
      </div>
                  <div class="input-field">
                      <input type="text" name="img" data-length="200" maxlength="200" length="200" class="validate">
                      <label>Image Link</label>
                  </div>
                  <div class="input-field">
                      <input type="text" name="author" data-length="50" maxlength="50" length="50" class="validate" required>
                      <label>Author</label>
                  </div>
                  <div class="input-field">
                      <input type="text" name="tag" data-length="50" maxlength="50" length="50" class="validate" required>
                      <label>Tag</label>
                  </div>
                <input type="submit" name="submit" class="btn">
              </form>
              <h3>Workshop Videos</h3>
              <form action="postwv.php" method="post">
                <div class="input-field">
                    <input type="text" name="wvtitle" data-length="60"  maxlength="60" length="60" class="validate" required>
                    <label>Title</label>
                </div>
                <div class="input-field">
                    <input type="text" name="wvlink" data-length="150" required>
                    <label>Youtube Playlist ID</label>
                </div>
                <div class="input-field">
                <input type="date" name="wvdate" class="datepicker" required>
                <label>Date</label>
              </div>
                <input type="submit" name="submit" class="btn">
              </form>
              <h3>Session Videos</h3>
              <form action="postsv.php" method="post">
                <div class="input-field">
                    <input type="text" name="svtitle" data-length="60" maxlength="60" length="60" class="validate" required>
                    <label>Title</label>
                </div>
                <div class="input-field">
                    <input type="text" name="svlink" data-length="150" required>
                    <label>Youtube Playlist ID</label>
                </div>

                <div class="input-field">
                <input type="date" name="svdate" class="datepicker" required>
                <label>Date</label>
              </div>
                <input type="submit" name="submit" class="btn">
              </form>
</div>
        </main>
        <?php
        require('footer.html');
         ?>
         <?php
         if(isset($_SESSION['adminpostmsg']) && !empty($_SESSION['adminpostmsg']) && strlen($_SESSION['adminpostmsg'])>0)
         {
           $adminpostmsg=$_SESSION['adminpostmsg'];
           $_SESSION['adminpostmsg']="";
           echo  "<script type='text/javascript'>Materialize.toast('$adminpostmsg', 5000);</script>";
         }
        ?>
        <script src="ckeditor/ckeditor.js"></script>
        <script>CKEDITOR.replace('text');</script>

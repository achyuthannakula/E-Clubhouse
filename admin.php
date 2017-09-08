<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']) && strlen($_SESSION['username'])>0 && strlen($_SESSION['password'])>0)
{
  $URL="adminpost.php";
  echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
  exit();
}
require('nav.html');
?>
<script>
document.getElementById("admin").className = 'bold active blue';
document.getElementById("page").innerHTML = 'Admin Login';
</script>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 offset-m3" style="margin-top:10%">
                        <div class="card-panel">
                            <h4 class="blue-text center-align">Admin Login</h4>
                          <form method="post" action="">
                            <div class="input-field">
                              <input name="name" type="text">
                              <label for="name">User Name</label>
                            </div>
                              <div class="input-field">
                              <input name="pass" type="password">
                              <label for="pass">Password</label>
                            </div>
                              <input name="sub*9-" type="submit" class="btn" style="width:100%">
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
<?php
require('footer.html');
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["name"]) && !empty($_POST["pass"]) )
{
  require('db_config.php');
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $pass = mysqli_real_escape_string($conn,$_POST['pass']);
  $sel = "select * from account where username='$name' and password='$pass';";
  $arr = mysqli_query($conn,$sel);
  mysqli_close($conn);
  $_POST = array();
  if(is_bool($arr) && !$arr)
  {
      $_SESSION['adminmsg']="Error!!! Contact site admin if problem persists.";
  }
  if(mysqli_num_rows($arr) == 1)
  {
      $URL="adminpost.php";
      $_SESSION['adminpostmsg']="You have been successfully logged in.";
      $_SESSION['username'] = $name;
      $_SESSION['password'] = $pass;
      echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
      exit();
  }
  else {
      $_SESSION["adminmsg"] = "Username and Password are incorect";
  }
}
 ?>
<?php
if(isset($_SESSION['adminmsg']) && !empty($_SESSION['adminmsg']) && strlen($_SESSION['adminmsg'])>0)
{
  $adminmsg=$_SESSION['adminmsg'];
  $_SESSION['adminmsg']="";
  echo  "<script type='text/javascript'>Materialize.toast('$adminmsg', 4000);</script>";
}
 ?>

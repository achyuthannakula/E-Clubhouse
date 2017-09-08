<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['svtitle']) && !empty($_POST['svlink']))
{
  require('db_config.php');
  $title = mysqli_real_escape_string($conn,$_POST['svtitle']);
  $link = mysqli_real_escape_string($conn,$_POST['svlink']);
  $date = mysqli_real_escape_string($conn,$_POST['svdate']);
  $q = "INSERT INTO SV VALUES ('$title','$link','$date')";
  if(is_bool($conn))
  {
      $_SESSION['adminpostmsg']='Database connection error!<br>Contact Administrator if problem persists!';
      redirect('adminpost.php');}
  $res = mysqli_query($conn,$q);
  if(is_bool($res) && !$res)
  {
    $_SESSION['adminpostmsg']='Database error!<br>Contact Administrator if problem persists!';
    redirect('adminpost.php');
  }
  $_SESSION['adminpostmsg']='Session video posted succesfully';
  redirect('adminpost.php');
}
else
{
  $_SESSION['adminpostmsg']='Fill all fields!';
  redirect('adminpost.php');
}
function redirect($URL)
{
  echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
  echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
  exit();
}
 ?>

<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['title']) && !empty($_POST['text']))
{
  require('db_config.php');
  $title = mysqli_real_escape_string($conn,$_POST['title']);
  $content = mysqli_real_escape_string($conn,$_POST['text']);
  $author=mysqli_real_escape_string($conn,$_POST['author']);
  $tag=mysqli_real_escape_string($conn,$_POST['tag']);
  $link=$_POST['img'];
  $date=date("Y-m-d");
  var_dump($_FILES);
  var_dump($_POST);
  if($_FILES['file']['error']!=0 && empty($link))
                  {
                    $_SESSION['adminpostmsg']="Upload a file or enter a link!";
                    header("location: adminpost.php");
                    exit();
                  }
  if(empty($link))
  {
    $img_info=getimagesize($_FILES['file']['tmp_name']);
  var_dump($img_info);
  if(empty($img_info))
  {
    $_SESSION['adminpostmsg']="Not an image!";
    header("location: adminpost.php");
    exit();
  }
  $q="INSERT INTO ARTICLES (title,content,author,tag,dt) VALUES ('$title','$content','$author','$tag','$date')";
  if( mysqli_query($conn,$q) != 1){
    $_SESSION['adminpostmsg']="Error!,<br>Article not posted";
    header("location: adminpost.php");
    exit();
  }
  $row=mysqli_insert_id($conn);
  $ext  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
  var_dump($ext);
  var_dump($row);
  $ext = $row.".".$ext;
  if(!move_uploaded_file($_FILES['file']['tmp_name'],"uploads/".$ext))
                  {

                      $_SESSION['adminpostmsg']="File Copy Error!";
                      header("location: adminpost.php");
                      exit();
                  }
                  $ext="uploads/".$ext;
                  $q="UPDATE ARTICLES SET img='$ext' WHERE sno=$row";
                  if( mysqli_query($conn,$q) == 1)
                  {
                    $_SESSION['adminpostmsg']="Posted succesfully!";
                    header("location: adminpost.php");
                    exit();
                  }
                  else {
                    $_SESSION['adminpostmsg']="Database Error!";
                    header("location: adminpost.php");
                    exit();
                  }
}
else {
$q="INSERT INTO ARTICLES (title,content,author,tag,img,dt) VALUES ('$title','$content','$author','$tag','$link','$date')";
if( mysqli_query($conn,$q) == 1)
{
    $_SESSION['adminpostmsg']="Article posted successfully!";
    header("location: adminpost.php");
    exit();
}
else {
    $_SESSION['adminpostmsg']="Error!, Article not posted!";
    header("location: adminpost.php");
    exit();
}
}
}
else
{
    $_SESSION['adminpostmsg']="Data Inappropiate!";
    header("location: adminpost.php");
    exit();
}
 ?>

<?php
session_start();
$_SESSION=array();
$URL="admin.php";
$_SESSION['adminmsg']="You have succesfully logged out!";
echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
exit();
?>

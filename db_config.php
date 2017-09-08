<?php
$db_server="localhost";
$db_uname="root";
$db_pass="";
$db_name="admin";
$conn = mysqli_connect("$db_server","$db_uname","$db_pass","$db_name");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    exit();
}
?>

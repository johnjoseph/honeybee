<?php
session_start();
$me=$_REQUEST['me'];
$expire=time()-100;
setcookie('me',$me,$expire,'/');
require_once('connect.php');
$query="DELETE FROM `online` WHERE `name`='$me'";
$result=$mysqli->query($query);
$query="DELETE FROM `chat` WHERE `me`='$me' AND `you`='$me'";
$result=$mysqli->query($query);
echo "<div style='padding:50px 0 50px 0;text-align: center;font-family: ubuntu;font-size: 18px;color:#777;background-color:#f7f7f7;border:1px solid #d0d0d0;'>successfully logged out!</div>";
?>
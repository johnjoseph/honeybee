<?php
$me=$_POST['me'];
$you=$_POST['you'];
require_once('connect.php');
$query="DELETE FROM `chat` WHERE `me`='$me' AND `you`='$you'";
$result=$mysqli->query($query);
$query="DELETE FROM `chat` WHERE `me`='$you' AND `you`='$me'";
$result=$mysqli->query($query);
?>
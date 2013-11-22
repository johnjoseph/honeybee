<?php
require_once('connect.php');
$you=$_REQUEST['you'];
$me=$_REQUEST['me'];
if(!strcmp($_REQUEST['type'],'get'))
{
	$query="SELECT * FROM `chat` WHERE `me`='$you' AND `you`='$me' ORDER BY `timestamp` DESC";
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	if($row)
	{
		print_r(json_encode(array("message"=>$row['message'],"id"=>$row['id'])));
	}
	else
	{
		print_r(json_encode(array("message"=>'error',"id"=>0)));		
	}
}
else if(!strcmp($_REQUEST['type'],'put'))
{
	$query="SELECT max(`id`) FROM `chat` WHERE 1";
	$result=$mysqli->query($query);
	$row=$result->fetch_assoc();
	$message=$_REQUEST['message'];
	$ide=$row['max(`id`)']+1;
	$query="INSERT INTO `chat` (`id`,`me`,`you`,`message`) VALUES ('$ide','$me','$you','$message')";
	$result=$mysqli->query($query);	
}
?>
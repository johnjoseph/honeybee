<?php
require_once('connect.php');
$me=$_REQUEST['mine'];
$query="SELECT * FROM `online` WHERE `name`!='$me'";
$result=$mysqli->query($query);
while($row=$result->fetch_assoc())
{
	$nm=$row['name'];
	$query="SELECT * FROM `chat` WHERE `you`='$me' AND `me`='$nm'";
	$rslt=$mysqli->query($query);
	$rw=$rslt->fetch_assoc();
	$response="<a style='display:block;height:auto;color:#555;text-decoration:none;' target='_blank' href='chat.php?me=".$_REQUEST['mine']."&you=".$row['name']."'><div class='user' style='width:50%;padding:10px;float:left;clear:float;margin-top:2px;background-color:#f7f7f7;border:1px solid #d0d0d0;'>".$row['name'];
	$response.=($rw['me'])?"(".$rw['me']." has messaged you. Click to start chat.)</div></a>":"</div></a>";
	echo $response;
}
?>
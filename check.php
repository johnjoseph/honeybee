<?php
	$me=$_POST['name'];
	require_once('connect.php');
	$query="INSERT INTO `online` (`name`) VALUES ('$me')";
	$result=$mysqli->query($query);
	if(!$result) die(json_encode(array('status'=>"error")));
	echo json_encode(array('status'=>"success"));
?>
<?php
	session_start();
	$me=$_POST['me'];
	$time=60*60*24*5;
	$expire=time()+$time;
	setcookie('me',$me,$expire,'/');		
	$_COOKIE['me']=$me;
?>
<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
$me=$_REQUEST['me'];
$you=$_REQUEST['you'];
$fget=file_get_contents("http://www.impressen.com/store.php?type=get&me=$me&you=$you");
echo "data: ".$fget.PHP_EOL;
echo PHP_EOL;
flush();
?>
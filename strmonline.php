<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
$mine=$_REQUEST['mine'];
$fget=file_get_contents("http://www.impressen.com/getonline.php?mine=$mine");
if(!$fget) die();
echo "data: ".$fget.PHP_EOL;
echo PHP_EOL;
flush();
?>
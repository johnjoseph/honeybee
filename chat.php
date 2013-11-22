<?php
session_start();
?>
<html>
<?php
if(!isset($_COOKIE['me']))
{
	die("<div style='padding:50px 0 50px 0;text-align: center;font-family: ubuntu;font-size: 18px;color:#777;background-color:#f7f7f7;border:1px solid #d0d0d0;'>please login.<a href='shoutbox.php' style='color:#555;text-decoration:none;'>click to go back</a></div>");
}
if(strcmp($_COOKIE['me'],$_GET['me']))
{
	die("<div style='padding:50px 0 50px 0;text-align: center;font-family: ubuntu;font-size: 18px;color:#777;background-color:#f7f7f7;border:1px solid #d0d0d0;'>nice try mate. sorry to dissapoint you.<a href='shoutbox.php' style='color:#555;text-decoration:none;'>click to go back</a></div>");
}
if(!isset($_REQUEST['you']))
{
	die("<div style='padding:50px 0 50px 0;text-align: center;font-family: ubuntu;font-size: 18px;color:#777;background-color:#f7f7f7;border:1px solid #d0d0d0;'>what are you doing here?<a href='shoutbox.php' style='color:#555;text-decoration:none;'>click to go back</a></div>");
}
?>
<head>
<script src="scripts/jquery.min.js"></script>
<script type='text/javascript'>
var me="<?php echo $_REQUEST['me'];?>";
var you="<?php echo $_REQUEST['you'];?>";
var id;
var source=new EventSource("stream.php?me="+me+"&you="+you);
source.onmessage=function(event)
{
	var msg=$.parseJSON(event.data);
	if(msg.message!='error')
	{	if(msg.id!=id)
		{
		id=msg.id;
		$("#wall").append("<b>"+you+"</b>: "+msg.message+"<br/>");
		}
	}		

};

$(window).unload(function()
{
	$.ajax({
		url:'clear.php',
		type:'POST',
		data:{'me':me,'you':you}
	});
});

$(document).ready(function()
{
	$('#input').keyup(function(event)
	{
		if(event.keyCode==13)
		{
			$('#button').click();
		}
	});
	
	$('#button').click(function()
	{
	var message=$('#input').val();
	$('#wall').append("<b>"+me+"</b>: "+message+"<br/>");	
	$('#input').val(' ');	
		$.ajax({
			url:'store.php',
			data:{'type':'put','me':me,'you':you,'message':message},
			type:'POST',
			success:function()
			{
			}
		});
	});
});
</script>
</head>
<body>
<input type='text' style='float:left;width:300px;height:42px;border:1px solid #d0d0d0;color:#666;'placeholder='write something' id='input'/><span style='float:left;width:100px;padding:10px;background-color:#f1f1f1;text-align:center;color:#555;border:1px solid #d0d0d0;' id='button' >submit</span>
<?php 
if(isset($_COOKIE['me']))
{
	echo "<a href='unset.php?me=".$_COOKIE['me']."' style='float:right;padding:10px;text-align:center;color:#555;font-size:20px;'>logout</a>"; 	
}
?>
<div id='wall' style='float:left;clear:both;width:100%;padding:10px;height:auto;min-height:200px;background-color:#f7f7f7;border:1px solid #f1f1f1;'>
</div>
</body>
</html>
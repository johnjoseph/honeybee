<?php
session_start();
$mine=(isset($_COOKIE['me']))?$_COOKIE['me']:"";
?>
<html>
<head>
<script src='scripts/jquery.min.js'></script>
<script type='text/javascript'>
var me="<?php echo $mine; ?>";
$(document).ready(function()
{
	if(me)
	{
		$('#input').remove();
		$('#query').html('hi '+me+',You can now chat with users online');
		getonline(me);
	}

	function getonline(me)
	{
		var src=new EventSource("strmonline.php?mine="+me);
		src.onmessage=function(event)
		{
			$('#online').html(event.data);
		};
	}

	$('#input').keyup(function(event)
	{
		if(event.keyCode==13)
		{
			var name=$('#input').val();
			$('#button').click();
			$.ajax({
				url:'check.php',
				type:'POST',
				dataType:'json',
				data:{'name':name},
				success:function(response)
				{
					if(response['status']=='success')
						{
						$.ajax({
								url:'set.php',
								type:'POST',
								data:{'me':name},
								success:function()
								{
									$('#input').remove();
									$('#query').html('hi '+name+',You can now chat with users online');
									$('#enter').append("<a href='unset.php?me="+name+"' style='float:right;padding:30px;text-align:center;color:#555;font-size:20px;'>logout</a>");
									getonline(name);									
								}
							});
						}
					else
						$('#query').html('Name already taken, please enter another one');
				}
			});
		}
	});
	
});
</script>
</head>
<body>
<div id='enter' style='width:100%;float:left;height:auto;background-color:#f7f7f7;border:1px solid #d0d0d0;'>
<span id='query' style='float:left;padding:30px;text-align:center;color:#555;font-size:20px;'>Please enter your name</span>
<input type='input' style='float:left;width:300px;height:42px;border:1px solid #d0d0d0;color:#555;margin:20px;' id='input'>
<?php 
if(isset($_COOKIE['me']))
{
	echo "<a href='unset.php?me=".$_COOKIE['me']."' style='float:right;padding:30px;text-align:center;color:#555;font-size:20px;'>logout</a>"; 	
}
?>

</div>
<div id='online' style='clear:left;float:left;width:100%;min-height:300px;'>
<?php 
if(!isset($_COOKIE['me']))
{
echo "<span style='text-align:center;width:98%;padding:10px;color:#555;font-size:16px;float:left;clear:float;margin-top:2px;background-color:#f7f7f7;border:1px solid #d0d0d0;'>Enter your name to see people online!</span>"; 
}
?>
</div>
</body>
</html>
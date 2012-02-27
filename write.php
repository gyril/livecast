<?php
	$room = isset($_GET['room']) ? $_GET['room'] : false;
	if(!$room) {
		header("Location: http://6ou.fr/balloop/room.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Livecast</title>
		<script type="text/javascript">
			var room = "<?php echo $room; ?>";
			function send() {
				var msg = document.getElementById("msg");
				
				xhr = new XMLHttpRequest();
				xhr.open("POST","./log.php",true);
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xhr.send("msg="+msg.value.replace(/\n\r?/g, '<br>')+"&room="+room);
				xhr.onreadystatechange=function() {
					if(xhr.readyState==4 && xhr.status==200) {
						msg.value = "";
					}
				}
			}
		</script>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-29238968-1']);
		  _gaq.push(['_setDomainName', '6ou.fr']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>

	</head>
	
	<body style="width: 600px;margin: 0 auto; background: url('../bgg.png');">
		<p style="color: white;font-family: Arial;font-weight: 100;">Votre message</p>
		<form onsubmit="send(); return false">
			<textarea style="width: 100%; height: 8em" id="msg" name="msg"></textarea>
			<input type="submit" value="Envoyer" style="float: right;background: white;border: 1px solid black;width: 100px;height: 30px;margin: 5px;color: #000000;font-size: 1em;">
		</form>
	</body>
</html>
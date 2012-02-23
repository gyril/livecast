<?php
	$room = isset($_GET['room']) ? $_GET['room'] : false;
	if(!$room) {
		header("Location: http://6ou.fr/balloop/room.php");
		die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Balloop</title>
		<script type="text/javascript">
			var room = "<?php echo $room; ?>";
			function send() {
				var msg = document.getElementById("msg");
				
				xhr = new XMLHttpRequest();
				xhr.open("POST","./log.php",true);
				xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xhr.send("msg="+msg.value+"&room="+room);
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
	
	<body>
		<?php
			echo "<p>Vous écrivez pour la salle : " . $room . ".</p>";
		?>
		<br>
		<p>Votre message : </p>
		<input type="text" id="msg" name="msg" /><br>
		<input type="button" value="Envoyer" onclick="send()" />
	</body>
</html>
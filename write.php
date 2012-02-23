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
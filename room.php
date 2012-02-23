<?php
	function createRoom() { 
	    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
	    srand((double)microtime()*1000000); 
	    $i = 0; 
	    $pass = '' ; 
	
	    while ($i <= 7) { 
	        $num = rand() % 33; 
	        $tmp = substr($chars, $num, 1); 
	        $pass = $pass . $tmp; 
	        $i++; 
	    } 
	
	    return $pass; 
	}
	
	$room = createRoom();
	
	$logfile = "./logs/" . $room . ".txt";
	$fh = fopen($logfile, 'w') or die("can't open file");
	$stringData = "Bienvenue\n\n";
	fwrite($fh, $stringData);
	fclose($fh);
	
	$url = "http://6ou.fr/balloop/write.php?room=" . $room;
	$err = "H";
	
	require_once('qrgen/qrcode.class.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<title>Balloop</title>
		<script type="text/javascript">
			var room = "<?php echo $room; ?>";
			var lastud = 1;
			
			function poll() {
				xhr = new XMLHttpRequest();
				xhr.open("GET","./queue.php?room="+room+"&lastud="+lastud,true);
				xhr.send();
				xhr.onreadystatechange=function() {
					if(xhr.readyState==4 && xhr.status==200) {
						if(xhr.responseText) {
							var reply = JSON.parse(xhr.responseText);
							document.getElementById("logs").innerHTML = reply.logs;
							lastud = reply.lastud;
						}
						poll();
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
			//$qrcode = new QRcode(utf8_encode($url), $err);
			//$qrcode->displayHTML();
		?>
		<img src="./qrgen/image.php?msg=<?php echo urlencode($url); ?>&amp;err=<?php echo urlencode($err); ?>" alt="generation qr-code" style="border: solid 1px black;"><br>
		<div id="logs"></div>
		<script type="text/javascript">
			poll();
		</script>
	</body>
</html>
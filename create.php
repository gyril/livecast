<?php

	$room = isset($_GET['room']) ? $_GET['room'] : false;
	$msg = isset($_GET['msg']) ? $_GET['msg'] : false;
	
	if(!$room || !$msg) {
		die(0);
	}
	
	$logfile = "./logs/" . $room . ".txt";
	$fh = fopen($logfile, 'w') or die("can't open file");
	$stringData = $msg . "\n\n";
	fwrite($fh, $stringData);
	fclose($fh);
?>
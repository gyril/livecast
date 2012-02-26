<?php

	$room = isset($_GET['room']) ? $_GET['room'] : false;
	$msg = isset($_GET['msg']) ? $_GET['msg'] : false;
	$time = time();
	
	if(!$room || !$msg) {
		die("-1");
	}
	
	$entry = '{"time":"' . $time . '","msg":"' . $msg . '"}';
	$logfile = "./logs/" . $room . ".txt";
	$fh = fopen($logfile, 'w') or die("can't open file");
	fwrite($fh, $entry);
	fclose($fh);
?>
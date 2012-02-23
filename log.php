<?php
	$msg = isset($_POST['msg']) ? $_POST['msg'] : false;
	$room = isset($_POST['room']) ? $_POST['room'] : false;

	if(!$msg) {
		die("-1");
	} else {
		$logfile = "./logs/" . $room . ".txt";
		$fh = fopen($logfile, 'a');
		fwrite($fh, $msg."\n");
		fclose($fh);
		echo("200");
	}
?>
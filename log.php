<?php
	$msg = isset($_POST['msg']) ? $_POST['msg'] : false;
	$room = isset($_POST['room']) ? $_POST['room'] : false;
	$time = time();

	if(!$msg) {
		die("-1");
	} else {
		$entry = ',{"time":' . $time . ',"msg":"' . $msg . '"}';
		$logfile = "./logs/" . $room . ".txt";
		$fh = fopen($logfile, 'a');
		fwrite($fh, $entry);
		fclose($fh);
		echo("200");
	}
?>
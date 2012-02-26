<?php
	$start = time();
	
	set_time_limit(0);
	ob_implicit_flush(true);

	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 01 Jul 1999 00:00:00 GMT');


	$room = isset($_GET['room']) ? $_GET['room'] : false;
	$last_update = isset($_GET['lastud']) ? $_GET['lastud'] : false;
	
	$time = time();
	while((time() - $time) < 30) {
		if(!$room || !$last_update) {
			die("-1");
		} else {
			clearstatcache();
			$last_modif = filemtime("./logs/".$room.".txt");
			if($last_update != $last_modif) {
				$logs = file_get_contents("./logs/".$room.".txt");
				$reply = array('lastud' => $last_modif, 'logs' => array(json_decode(stripslashes($logs))));
				print json_encode($reply);
				ob_flush();
				flush();
				die();
			}
		}
		
		usleep(100000);
	}
?>
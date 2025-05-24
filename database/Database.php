<?php
	// $server = 'sql113.infinityfree.com';
	// $dbuser = 'if0_35595554';
	// $dbpass = 'ldxSvnjpbw';
	// $db = 'if0_35595554_db_fes';

	$server = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$db = 'db_fes';
	
	$mysqli = new mysqli($server, $dbuser, $dbpass, $db);
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
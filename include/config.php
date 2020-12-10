<?php

	define('WOOLF_DB_SERVER', "127.0.0.1");
	define('WOOLF_DB_USER', "xb921315_dbmanager");
	define('WOOLF_DB_PASSWORD', "Civetta54!");
	define('WOOLF_DB_NAME', "xb921315_ItalianWoolf");

	define('WOOLF_PATH', dirname(dirname(__FILE__)));
	define('WOOLF_URL', 'http://italianwoolf.reading.ac.uk/staging');

	define('DEBUG','false');

	mysql_query("SET NAMES 'utf8'");
	echo "Initial character set is: " . $mysqli -> character_set_name();

	// Change character set to utf8
	$mysqli -> set_charset("utf8");

	echo "Current character set is: " . $mysqli -> character_set_name();

	require_once '../vendor/autoload.php';

?>
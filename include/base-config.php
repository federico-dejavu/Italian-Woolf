<?php

	define('WOOLF_DB_SERVER', "127.0.0.1");
	define('WOOLF_DB_USER', "xb921315_dbmanager");
	define('WOOLF_DB_PASSWORD', "Civetta54!");
	define('WOOLF_DB_NAME', "xb921315_ItalianWoolf");

	define('SITE_TITLE', "Virginia Woolf in Italy");

	define('WOOLF_PATH', dirname(dirname(__FILE__)));
	define('WOOLF_URL', 'https://italianwoolf.reading.ac.uk/stage/');
	
	define('DEBUG',FALSE);

    require_once WOOLF_PATH.'/vendor/autoload.php';
    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'cache' => WOOLF_PATH.'/cache',
    ]);
?>
<?php

	define('WOOLF_DB_SERVER', "127.0.0.1");
	define('WOOLF_DB_USER', "");
	define('WOOLF_DB_PASSWORD', "");
	define('WOOLF_DB_NAME', "");

	define('SITE_TITLE', "");

	define('WOOLF_PATH', dirname(dirname(__FILE__)));
	define('WOOLF_URL', '');
	
	define('DEBUG',FALSE);

    require_once WOOLF_PATH.'/vendor/autoload.php';
    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'cache' => WOOLF_PATH.'/cache',
    ]);
?>
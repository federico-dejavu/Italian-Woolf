<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
	
	include_once('include/head.php');
	include_once('include/header.php');
	include_once('include/publishers.php');

	$publishers_obj = new publishers();
	$publishers = $publishers_obj->getAllPublishers();

    echo $twig->render('advancedSearch.html', [
        'publishers' => $publishers,
	]);


?>
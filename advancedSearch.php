<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
	
	include_once('include/head.php');
	include_once('include/header.php');
	include_once('include/publishers.php');

	$publishers_obj = new publishers();
	$publishersList = $publishers_obj->getAllPublishers();
	foreach($publishersList as $publisherID){
		var_dump($publisherID);
		$publisherSingle = $publishers_obj->getPublisherById($publisherID[0]);
		$publishers[$publisherID] = $publisherSingle[0]['publisher'];
	}

	var_dump($publishers);

    echo $twig->render('advancedSearch.html', [
        'publishers' => $publishers,
	]);


?>
<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
	
	include_once('include/head.php');
	include_once('include/header.php');
	include_once('include/publishers.php');

	$publishers_obj = new publishers();
	$publishersList = $publishers_obj->getAllPublishers();
	$contatore = 0;
	foreach($publishersList as $publisherID){
		var_dump($publisherID);
		$idPublisher = $publisherID[$contatore];
		$publisherSingle = $publishers_obj->getPublisherById($idPublisher);
		$publishers[$idPublisher] = $publisherSingle[0]['publisher'];
		$contatore++;
	}

	var_dump($publishers);

    echo $twig->render('advancedSearch.html', [
        'publishers' => $publishers,
	]);


?>
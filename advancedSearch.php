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
		$publisherSingle = $publishers_obj->getPublisherById($publisherID);
		$publishers[$publisherID] = $publisherSingle;
	}


    echo $twig->render('advancedSearch.html', [
        'publishers' => $publishers,
	]);


	include_once('include/footer.php'); 
	
?>
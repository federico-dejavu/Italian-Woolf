<?php

	require_once '../config.php';
    require_once '../cleaner.php';
	
	include_once('../publishers.php');
	include_once('../languages.php');
	include_once('../typologies.php');

	$publishers_obj = new publishers();
	$publishersList = $publishers_obj->getAllPublishers();
	foreach($publishersList as $publisherID){
		$publisherSingle = $publishers_obj->getPublisherById($publisherID);
		$publishers[$publisherID] = $publisherSingle;
	}

	$languages_obj = new languages();
	$languagesList = $languages_obj->getAllLanguages();
	foreach($languagesList as $languageID){
		$languageSingle = $languages_obj->getLanguageById($languageID);
		$languages[$languageID] = $languageSingle;
	}

	$typologies_obj = new typologies();
	$typologiesList = $typologies_obj->getAllTypologies();
	foreach($typologiesList as $typologyID){
		$typologySingle = $typologies_obj->getTypologyById($typologyID);
		$typologies[$typologyID] = $typologySingle;
	}


	echo $twig->render('advancedSearch.html', [
        'publishers'	=> $publishers,
		'languages'		=> $languages,
		'typologies'	=> $typologies,
	]);

?>
<?php

	require_once 'include/config.php';
	require_once 'include/cleaner.php';

	include_once('include/publishers.php');
	include_once('include/languages.php');
	include_once('include/typologies.php');

	var_dump[$_POST];

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

	$phpPage['publishers'] = $publishers;
	$phpPage['languages'] = $languages;
	$phpPage['typologies'] = $typologies;

?>
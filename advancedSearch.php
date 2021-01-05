<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
	
	include_once('include/head.php');
	include_once('include/header.php');
	include_once('include/publishers.php');
	include_once('include/languages.php');

	$publishers_obj = new publishers();
	$publishersList = $publishers_obj->getAllPublishers();

	$languages_obj = new languages();
	$languagesList = $languages_obj->getAllLanguages();

    echo $twig->render('advancedSearch.html', [
        'publishers'	=> $publishersList,
        'languages'		=> $languagesList,
	]);


	include_once('include/footer.php'); 
	
?>
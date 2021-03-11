<?php

	require_once '../config.php';
    require_once '../cleaner.php';
    require_once '../works.php';
    require_once '../publishers.php';
    require_once '../authors.php';
    require_once '../secondary_authors.php';   
    require_once '../editors.php';
    require_once '../languages.php'; 
    require_once '../series.php';     
    require_once '../illustrators.php';
    require_once '../editions.php';
    
    $actionParam	= (isset($_REQUEST['action'])	? $_REQUEST['action']	: '');
    $subject		= (isset($_REQUEST['subject'])	? $_REQUEST['subject']	: '');
    $id				= (isset($_REQUEST['id'])		? $_REQUEST['id']		: '');

/**  
    $edition[]
   id, 
   title, 
   works_id, 
   original, 
   year, 
   publisher_id, 
   city, 
   serie_id, 
   pages, 
   price, 
   description, 
   isbn, 
   libraries, 
   image 

    publisher_id
    publisher_name
    publisher_link
    publisher
        id, 
        publisher, 
        description, 
        link
    serie
        id, 
        publisher_id, 
        serie

**/

    $editionsObject = new editions();
    $edition = $editionsObject->getEditionById($id);

    // Reperisco work collegato per back
    $workObject = new works();
    $work = $workObject->getWorksByWork_id($edition['works_id']);
    $edition['work_title'] = $work['title'];
            
    /* Reperisco dati publisher */
    $publisherObject = new publishers();
    $publisher = $publisherObject->getPublisherById($edition['publisher_id']);
    $edition['publisher_id']=$edition['publisher_id'];
    $edition['publisher_name']=$edition['publisher'];
    $edition['publisher_link']=$edition['link'];

    /* Reperisco della serie */
    $seriesObject = new series();
    $serie = $seriesObject->getSerierById($edition['serie_id']);
    $edition['serie']=$serie['serie'];        

    /* Reperisco lingua */
    $languages = new languages();
    $language = $languages->getLanguageById($edition['original']);
    $edition['language']=$language['language'];


    echo $twig->render('edition.html', [
        'edition'	=> $edition,
    ]);

?>
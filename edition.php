<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
    require_once 'include/works.php';
    require_once 'include/publishers.php';
    require_once 'include/authors.php';
    require_once 'include/secondary_authors.php';   
    require_once 'include/editors.php';
    require_once 'include/languages.php'; 
    require_once 'include/series.php';     
    require_once 'include/illustrators.php';
    require_once 'include/editions.php';


    ini_set('display_errors',1); # uncomment if you need debugging
    include_once('include/head.php');
    echo "<body>";
    include_once('include/header.php');
    
    $actionParam	= (isset($_REQUEST['action'])	? $_REQUEST['action']	: '');
    $subject	= (isset($_REQUEST['subject'])	? $_REQUEST['subject']	: '');
    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

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
    
    var_dump($edition);

    echo $twig->render('result/edition.html', [
        'edition'	=> $edition,
    ]);

?>
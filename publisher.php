<?php
	require_once 'include/config.php';
    require_once 'include/publishers.php';

    ini_set('display_errors',1); # uncomment if you need debugging
    include_once('include/head.php');
    echo "<body>";
    include_once('include/header.php');

    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    if($id > 0){
        /* Reperisco dati publisher */
        $publisherObject = new publishers();
        $publisher = $publisherObject->getPublisherById($work['publisher_id']);


/**

    publisher
        id, 
        publisher, 
        description, 
        link
   
**/
var_dump($publisher);
        echo $twig->render('result/publisher.html', [
            'publisher'		=> $publisher,    
        ]);
    }
?>
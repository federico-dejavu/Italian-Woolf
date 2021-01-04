<?php
	require_once 'include/config.php';
    require_once 'include/publishers.php';

    ini_set('display_errors',1); # uncomment if you need debugging
    include_once('include/head.php');
    include_once('include/header.php');

    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    if($id > 0){
        /* Reperisco dati publisher */
        $publisherObject = new publishers();
        $publisher = $publisherObject->getPublisherById($id);


/**

    publisher
        id, 
        publisher, 
        description, 
        link
   
**/
        echo $twig->render('result/publisher.html', [
            'publisher'		=> $publisher,    
        ]);
    }

	include_once('include/footer.php'); 
	
?>
<?php
	require_once 'include/config.php';
    require_once 'include/publishers.php';


    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

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

    $phpPage['publisher'] = $publisher;
	
?>
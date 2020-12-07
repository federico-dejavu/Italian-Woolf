<?php

	require_once 'include/config.php';
    require_once 'include/people.php';

    ini_set('display_errors',1); # uncomment if you need debugging
    include_once('include/head.php');
    include_once('include/header.php');
    
    $actionParam	= (isset($_REQUEST['action'])	? $_REQUEST['action']	: '');
    $subject	= (isset($_REQUEST['subject'])	? $_REQUEST['subject']	: '');
    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

/**  
   $people[]
        id
        other_name
        fullname
        birth_date
        death_date
        authority_record
        image


**/

    $peopleObject = new peoples();
    $people = $peopleObject->getEditionById($id);

    echo $twig->render('result/people.html', [
        'people'	=> $people,
    ]);

?>
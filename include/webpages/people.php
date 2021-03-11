<?php

	require_once 'include/config.php';
    require_once 'include/peoples.php';

    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    /* Reperisco dati publisher */
    $peopleObject = new people();
    $people = $peopleObject->getPeopleById($id);


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

    $phpPage['people'] = $people;
	
?>
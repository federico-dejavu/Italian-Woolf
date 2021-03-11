<?php

	require_once 'include/config.php';
    require_once 'include/peoples.php';
    require_once 'include/authors.php';

    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    /* Reperisco dati publisher */
    $peopleObject = new peoples();
    $people = $peopleObject->getPeopleById($id);

    /* Reperisco dati works come author */
    $authorObject = new $authors();
    $worksByAuthorId = $authorObject->getWorksByAuthorId($id);
    
    var_dump($worksByAuthorId);
    


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
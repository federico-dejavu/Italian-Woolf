<?php

	require_once 'include/config.php';
    require_once 'include/peoples.php';
    require_once 'include/authors.php';
    require_once 'include/works.php';

    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    /* Reperisco dati publisher */
    $peopleObject = new peoples();
    $people = $peopleObject->getPeopleById($id);

    /* Reperisco dati works come author */
    $authorObject = new authors();
    $worksByAuthorId = $authorObject->getWorksByAuthorId($id);
    $authorWorksObject = new works();
    $authorWorksAll = array();
    foreach ($worksByAuthorId as $authorWork_id ) {

        $authorWorks = $authorWorksObject->getWorksByWork_id($authorWork_id);

        $authorWorksAll[] = $authorWorks;        
    }

    var_dump($authorWorksAll);
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
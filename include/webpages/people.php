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

/**  
   $people[]
        id
        other_name
        fullname
        birth_date
        death_date
        authority_record
        image

    $authorWorksAll[]
        id
        title
        original
        year
        publisher_id
        city
        serie_id
        pages
        description
        isbn
        libraries
        image

**/

    $phpPage['people'] = $people;
    $phpPage['author'] = $authorWorksAll;
	
?>
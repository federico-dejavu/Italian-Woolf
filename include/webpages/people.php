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
    /* Reperisco dati works come second_author */
    $second_authorObject = new authors();
    $worksBySecond_authorId = $second_authorObject->getWorksBySecond_authorId($id);
    $second_authorWorksObject = new works();
    $second_authorWorksAll = array();
    foreach ($worksBySecond_authorId as $second_authorWork_id ) {

        $second_authorWorks = $second_authorWorksObject->getWorksByWork_id($second_authorWork_id);

        $second_authorWorksAll[] = $second_authorWorks;        
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

    $authorWorksAll[], $second_authorWorksAll[]
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

    $phpPage['people']          = $people;
    $phpPage['author']          = $authorWorksAll;
    $phpPage['second_author']   = $second_authorWorksAll;
	
?>
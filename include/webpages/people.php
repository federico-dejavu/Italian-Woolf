<?php

	require_once 'include/config.php';
    require_once 'include/peoples.php';
    require_once 'include/authors.php';
    require_once 'include/secondary_authors.php';
    require_once 'include/editors.php';
    require_once 'include/translators.php';
    require_once 'include/illutrators.php';
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
    $second_authorObject = new secondary_authors();
    $worksBySecond_authorId = $second_authorObject->getWorksBySecondary_authorsId($id);
    $second_authorWorksObject = new works();
    $second_authorWorksAll = array();
    foreach ($worksBySecond_authorId as $second_authorWork_id ) {

        $second_authorWorks = $second_authorWorksObject->getWorksByWork_id($second_authorWork_id);

        $second_authorWorksAll[] = $second_authorWorks;        
    }

    /* Reperisco dati works come editor */
    $editorObject = new editors();
    $worksByEditorId = $editorObject->getWorksByEditorId($id);
    $editorWorksObject = new works();
    $editorWorksAll = array();
    foreach ($worksByEditorId as $editorWork_id ) {

        $editorWorks = $editorWorksObject->getWorksByWork_id($editorWork_id);

        $editorWorksAll[] = $editorWorks;        
    }

    /* Reperisco dati works come translator */
    $translatorObject = new translators();
    $worksByTranslatorId = $translatorObject->getWorksByTranslatorId($id);
    $translatorWorksObject = new works();
    $translatorWorksAll = array();
    foreach ($worksByTranslatorId as $translatorWork_id ) {

        $translatorWorks = $translatorWorksObject->getWorksByWork_id($translatorWork_id);

        $translatorWorksAll[] = $translatorWorks;        
    }

    /* Reperisco dati works come illutrator */
    $illutratorObject = new illutrators();
    $worksByIllutratorId = $illutratorObject->getWorksByIllutratorId($id);
    $illutratorWorksObject = new works();
    $illutratorWorksAll = array();
    foreach ($worksByIllutratorId as $illutratorWork_id ) {

        $illutratorWorks = $illutratorWorksObject->getWorksByWork_id($illutratorWork_id);

        $illutratorWorksAll[] = $illutratorWorks;        
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

    $authorWorksAll[], $second_authorWorksAll[], $editorWorksAll[], $translatorWorksAll[], $illutratorWorksAll[]
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
    $phpPage['editor']          = $editorWorksAll;
    $phpPage['translator']      = $translatorWorksAll;
    $phpPage['illutrator']      = illutratorWorksAll;
	
?>
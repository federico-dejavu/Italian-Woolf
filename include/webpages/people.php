<?php

	require_once 'include/config.php';
    require_once 'include/peoples.php';
    require_once 'include/authors.php';
    require_once 'include/secondary_authors.php';
    require_once 'include/editors.php';
    require_once 'include/editions.php';
    require_once 'include/translators.php';
    require_once 'include/illustrators.php';
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

        $authorsAll[] = $authorWorks;
    }

    /* Reperisco dati works come second_author */
    $second_authorObject = new secondary_authors();
    $worksBySecond_authorId = $second_authorObject->getWorksBySecondary_authorsId($id);
    $second_authorWorksObject = new works();
    $second_authorWorksAll = array();
    foreach ($worksBySecond_authorId as $second_authorWork_id ) {

        $second_authorWorks = $second_authorWorksObject->getWorksByWork_id($second_authorWork_id);

        $second_authorsAll[] = $second_authorWorks;        
    }

    /* Reperisco dati works come editor */
    $editorObject = new editors();
    $worksByEditorId = $editorObject->getWorksByEditorId($id);
    $editorWorksObject = new works();
    $editorWorksAll = array();
    foreach ($worksByEditorId as $editorWork_id ) {

        $editorWorks = $editorWorksObject->getWorksByWork_id($editorWork_id);

        $editorsAll[] = $editorWorks;        
    }

    /* Reperisco dati works come translator */
    $translatorObject = new translators();
    $worksByTranslatorId = $translatorObject->getWorksByTranslatorId($id);
    $translatorWorksObject = new works();
    $translatorWorksAll = array();
    foreach ($worksByTranslatorId as $translatorWork_id ) {

        $translatorWorks = $translatorWorksObject->getWorksByWork_id($translatorWork_id);

        $translatorsAll[] = $translatorWorks;        
    }

    /* Reperisco dati works come illustrator */
    $illustratorObject = new illustrators();
    $worksByIllustratorId = $illustratorObject->getWorksByIllutratorsId($id);
    $illustratorWorksObject = new works();
    $illustratorWorksAll = array();
    foreach ($worksByIllustratorId as $illustratorWork_id ) {

        $illustratorWorks = $illustratorWorksObject->getWorksByWork_id($illustratorWork_id);

        $illustratorsAll[] = $illustratorWorks;        
    }


    /* Reperisco dati editions come second_author */
    $second_authorObject = new secondary_authors();
    $editionsBySecond_authorId = $second_authorObject->getEditionsBySecondary_authorsId($id);
    $second_authorEditionsObject = new editions();
    $second_authorEditionsAll = array();
    foreach ($editionsBySecond_authorId as $second_authorEdition_id ) {

        $second_authorEditions = $second_authorEditionsObject->getEditionById($second_authorEdition_id);

        $second_authorsAll[] = $second_authorEditions;        
    }

    /* Reperisco dati editions come editor */
    $editorObject = new editors();
    $editionsByEditorId = $editorObject->getEditionsByEditorId($id);
    $editorEditionsObject = new editions();
    $editorEditionsAll = array();
    foreach ($editionsByEditorId as $editorEdition_id ) {

        $editorEditions = $editorEditionsObject->getEditionById($editorEdition_id);

        $editorsAll[] = $editorEditions;        
    }

    /* Reperisco dati editions come translator */
    $translatorObject = new translators();
    $editionsByTranslatorId = $translatorObject->getEditionsByTranslatorId($id);
    $translatorEditionsObject = new editions();
    $translatorEditionsAll = array();
    foreach ($editionsByTranslatorId as $translatorEdition_id ) {

        $translatorEditions = $translatorEditionsObject->getEditionById($translatorEdition_id);

        $translatorsAll[] = $translatorEditions;        
        var_dump($translatorEditions);
    }

    /* Reperisco dati editions come illustrator */
    $illustratorObject = new illustrators();
    $editionsByIllustratorId = $illustratorObject->getEditionsByIllutratorsId($id);
    $illustratorEditionsObject = new editions();
    $illustratorEditionsAll = array();
    foreach ($editionsByIllustratorId as $illustratorEdition_id ) {

        $illustratorEditions = $illustratorEditionsObject->getEditionById($illustratorEdition_id);

        $illustratorsAll[] = $illustratorEditions;        
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

    $authorWorksAll[], $second_authorWorksAll[], $editorWorksAll[], $translatorWorksAll[], $illustratorWorksAll[]
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

    $phpPage['people']                  = $people;
    $phpPage['author']                  = $authorsAll;
    $phpPage['second_author']           = $second_authorsAll;
    $phpPage['editor']                  = $editorsAll;
    $phpPage['translator']              = $translatorsAll;
    $phpPage['illustrator']             = $illustratorsAll;
?>
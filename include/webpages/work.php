<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
    require_once 'include/works.php';
    require_once 'include/publishers.php';
    require_once 'include/authors.php';
    require_once 'include/secondary_authors.php';   
    require_once 'include/editors.php';
    require_once 'include/languages.php'; 
    require_once 'include/series.php';     
    require_once 'include/illustrators.php';
    require_once 'include/editions.php';
    require_once 'include/paratexts.php';

    $arrWorks = '';

    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    $workObject = new works();
    $work = $workObject->getWorksByWork_id($id);

    /* Reperisco dati publisher */
    $publisherObject = new publishers();
    $publisher = $publisherObject->getPublisherById($work['publisher_id']);
    $work['publisher_id']=$work['publisher_id'];
    $work['publisher_name']=$publisher['publisher'];
    $work['publisher_link']=$publisher['link'];

    /* Reperisco della serie */
    $seriesObject = new series();
    $serie = $seriesObject->getSerierById($work['serie_id']);
    $work['serie']=$serie['serie'];        

    /* Reperisco lingua */
    $languages = new languages();
    $language = $languages->getLanguageById($work['original']);
    $work['language']=$language['language'];

    /* Reperisco paratexts */
    $paratexts = new paratexts();
    $paratexts_id = $paratexts->getParatextsByWorkId($id);
    $arrParatexts = array();
    foreach($paratexts_id as $paratext_id){
        $paratext = $paratexts->getParatextById($paratext_id);
        $arrParatexts[] = $paratext;
    }   
    $work['paratexts']=$arrParatexts;

    /* Reperisco dati Author */
    $authors = new authors();
    $arrAuthors = $authors->getAuthorsByWorkId($id);
    $people = new peoples();
    $arrElements = array();
    foreach($arrAuthors as $peoples_id){
        $author = $people->getPeopleById($peoples_id);
        $arrElements[] = $author;
    }
    $work['authors']=$arrElements;

    /* Reperisco dati Secondary Author */
    $secondary_authors = new secondary_authors();
    $arrSecondaryAuthors = $secondary_authors->getSecondaryAuthorsByWorkId($id);
    $arrElements = array();
    foreach($arrSecondaryAuthors as $peoples_id){
        $secondary_author = $people->getPeopleById($peoples_id);
        $arrElements[] = $secondary_author;
    }
    $work['secondary_authors']=$arrElements;


    /* Reperisco dati Editor */
    $editors = new editors();
    $arrEditors = $editors->getEditorsByWorkId($id);
    $arrElements = array();
    foreach($arrEditors as $peoples_id){
        $editor = $people->getPeopleById($peoples_id);
        $arrElements[] = $editor;     
    }
    $work['editors']=$arrElements; 

    /* Reperisco dati Illustrator */
    $illustrators = new illustrators();
    $arrIllustrators = $illustrators->getIllustratorsByWorkId($id);
    $arrElements = array();
    foreach($arrIllustrators as $peoples_id){
        $illustrator = $people->getPeopleById($peoples_id);
        $arrElements[] = $illustrator;     
    }
    $work['illustrators']=$arrElements; 


    /* Reperisco le edizioni */
    $editions = new editions();
    $editionsList = $editions->getEditionsByWork_id($id);
    $arrEditions = array();
    foreach($editionsList as $edition_id){
        $arrEditions[] = $editions->getEditionById($edition_id);
    }

    $work['editions'] = $arrEditions;
/**
    
    $work[]

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
    language
    libraries
    image
    publisher_id
    publisher_name
    publisher_link
    publisher
        id, 
        publisher, 
        description, 
        link
    serie
        id, 
        publisher_id, 
        serie
    authors
        id
        other_name
        fullname
        birth_date
        death_date
        authority_record
        image
    secondary_authors
        id
        other_name
        fullname
        birth_date
        death_date
        authority_record
        image        
    editors
        id
        other_name
        fullname
        birth_date
        death_date
        authority_record
        image
    illustrators
        id
        other_name
        fullname
        birth_date
        death_date
        authority_record
        image
    editions
        []
**/
 
    $phpPage['work'] = $work;
?>
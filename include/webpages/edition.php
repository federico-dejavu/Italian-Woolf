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


/**  


**/

    $id = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');

    $editionsObject = new editions();
    $edition = $editionsObject->getEditionById($id);

    // Reperisco work collegato per back
    $workObject = new works();
    $work = $workObject->getWorksByWork_id($edition['works_id']);
    $edition['work_title'] = $work['title'];

    /* Reperisco dati publisher */
    $publisherObject = new publishers();
    $publisher = $publisherObject->getPublisherById($edition['publisher_id']);
    $edition['publisher_id']=$edition['publisher_id'];
    $edition['publisher_name']=$edition['publisher'];
    $edition['publisher_link']=$edition['link'];

    /* Reperisco della serie */
    $seriesObject = new series();
    $serie = $seriesObject->getSerierById($edition['serie_id']);
    $edition['serie']=$serie['serie'];        

    /* Reperisco lingua */
    $languages = new languages();
    $language = $languages->getLanguageById($edition['original']);
    $edition['language']=$language['language'];

    /* Reperisco paratexts */
    $paratexts = new paratexts();
    $paratexts_id = $paratexts->getParatextsByEditionId($id);
    $arrParatexts = array();
    foreach($paratexts_id as $paratext_id){
        $paratext = $paratexts->getParatextById($paratext_id);
        $arrParatexts[] = $paratext;
    }   
    $edition['paratexts']=$arrParatexts;

    /* Reperisco dati Author */
    $authors = new authors();
    $arrAuthors = $authors->getAuthorsByWorkId($edition['works_id']);
    $people = new peoples();
    $arrElements = array();
    foreach($arrAuthors as $peoples_id){
        $author = $people->getPeopleById($peoples_id);
        $arrElements[] = $author;
    }
    $edition['authors']=$arrElements;
    
    /* Reperisco dati Secondary Author */
    $secondary_authors = new secondary_authors();
    $arrSecondaryAuthors = $secondary_authors->getSecondaryAuthorsByEditionId($id);
    $arrElements = array();
    foreach($arrSecondaryAuthors as $peoples_id){
        $secondary_author = $people->getPeopleById($peoples_id);
        $arrElements[] = $secondary_author;
    }
    $edition['secondary_authors']=$arrElements;

    /* Reperisco dati Editor */
    $editors = new editors();
    $arrEditors = $editors->getEditorsByEditionId($id);
    $arrElements = array();
    foreach($arrEditors as $peoples_id){
        $editor = $people->getPeopleById($peoples_id);
        $arrElements[] = $editor;     
    }
    $edition['editors']=$arrElements; 

    /* Reperisco dati Illustrator */
    $illustrators = new illustrators();
    $arrIllustrators = $illustrators->getIllustratorsByWorkId($id);
    $arrElements = array();
    foreach($arrIllustrators as $peoples_id){
        $illustrator = $people->getPeopleById($peoples_id);
        $arrElements[] = $illustrator;     
    }
    $edition['illustrators']=$arrElements; 

    var_dump($edition);

    $phpPage['edition'] = $edition;

?>
<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';

    require_once 'include/publishers.php';
    require_once 'include/authors.php';
    require_once 'include/secondary_authors.php';   
    require_once 'include/editors.php';
    require_once 'include/languages.php'; 
    require_once 'include/series.php';     
    require_once 'include/illustrators.php';
    require_once 'include/editions.php';
    require_once 'include/articles.php';

    ini_set('display_errors',1); # uncomment if you need debugging
    include_once('include/head.php');
    echo "<body>";
    include_once('include/header.php');
    
    $actionParam	= (isset($_REQUEST['action'])	? $_REQUEST['action']	: '');
    $subject	= (isset($_REQUEST['subject'])	? $_REQUEST['subject']	: '');
    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    if($actionParam == "work"){
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
    
    $article[]

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

**/



    }
         


    $articlesObject = new articles();
    $article = $articlesObject->getArticlesByArticles_id($id);

    /* Reperisco dati Author */
    $authors = new authors();
    $arrAuthors = $authors->getAuthorsByWorkId($id);        
    $people = new peoples();
    $arrElements = array();
    foreach($arrAuthors as $peoples_id){      
        $author = $people->getPeopleById($peoples_id);
        $arrElements[] = $author;
    }
    $article['authors']=$arrElements;

    /* Reperisco dati Editor */
    $editors = new editors();
    $arrEditors = $editors->getEditorsByWorkId($id);
    $arrElements = array();
    foreach($arrEditors as $peoples_id){
        $editor = $people->getPeopleById($peoples_id);         
        $arrElements[] = $editor;     
    }
    $article['editors']=$arrElements; 
            
    /* Reperisco dati publisher */
    $publisherObject = new publishers();
    $publisher = $publisherObject->getPublisherById($article['publisher_id']);
    $article['publisher_id']=$article['publisher_id'];
    $article['publisher_name']=$article['publisher'];
    $article['publisher_link']=$article['link'];

    /* Reperisco della serie */
    $seriesObject = new series();
    $serie = $seriesObject->getSerierById($article['serie_id']);
    $article['serie']=$serie['serie'];        

    /* Reperisco lingua */
    $languages = new languages();
    $language = $languages->getLanguageById($article['language']);
    $article['language']=$language['language']; 
var_dump($article);
    echo $twig->render('searchResults.tpl', [
        'articles'	=> $article,
    ]);

?>
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
    include_once('include/header.php');
    
    $actionParam	= (isset($_REQUEST['action'])	? $_REQUEST['action']	: '');
    $subject	= (isset($_REQUEST['subject'])	? $_REQUEST['subject']	: '');
    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

/**
    
    $article[]
    id
    title
    volume_title
    journal_title
    journal_issue
    pubblication_date
    year
    publisher_id
    city
    serie_id
    pages
    price
    typology_id
    language
    open_access
    abstract
    description
    isbn
    issn
    libraries
    image
    doi
    authos[]
    editors[]
    authority_record
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

**/
         
    $articlesObject = new articles();
    $article = $articlesObject->getArticlesByArticles_id($id);

    /* Reperisco dati Author */
    $authors = new authors();
    $arrAuthors = $authors->getAuthorsByArticleId($id);        
    $people = new peoples();
    $arrElements = array();
    foreach($arrAuthors as $peoples_id){      
        $author = $people->getPeopleById($peoples_id);
        $arrElements[] = $author;
    }
    $article['authors']=$arrElements;

    /* Reperisco dati Editor */
    $editors = new editors();
    $arrEditors = $editors->getEditorsByArticleId($id);
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

    echo $twig->render('result/article.html', [
        'article'	=> $article,
    ]);

?>
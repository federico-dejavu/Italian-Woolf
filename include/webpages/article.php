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
    authors[]
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
    typology
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
    $article['typology']=$article['typology'];     
    $phpPage['article'] = $article;
    //var_dump($phpPage);
?>
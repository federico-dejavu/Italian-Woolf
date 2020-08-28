<?php

	require_once 'include/config.php';
    require_once 'include/cleaner.php';
    require_once 'include/works.php';
    require_once 'include/publishers.php';
    require_once 'include/authors.php';
    require_once 'include/editors.php';
    require_once 'include/illustrators.php';
    require_once 'include/editions.php';
    require_once 'include/articles.php';

    $arrWorks = '';


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
        $work['publisher']=$publisher[0]['publisher'];

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
        $arrSecondaryAuthors = $secondary_authors->getAuthorsByWorkId($id);
                
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
    libraries
        []
    image
    publisher
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
        echo $twig->render('result/work.html', [
            'work'		=> $work,    
        ]);
    }
         


       /* Estraggo articles */
       if($actionParam == "article"){ 

        $articles = new articles();

            $singleArticles = $articles->getArticlesByArticles_id($id);
            /* Reperisco dati publisher */
            $publisherObject = new publishers();
            $publisher = $publisherObject->getPublisherById($singleArticles['publisher_id']);
            $singleArticle['publisher']=$publisher[0]['publisher'];

            /* Reperisco dati Author */
            $authors = new authors();
            $arrAuthors = $authors->getAuthorsByArticleId($id);
            
            $people = new peoples();
            $arrElements = array();
            foreach($arrAuthors as $peoples_id){
            
                $author = $people->getPeopleById($peoples_id);
                
                $arrElements[] = $author;     
            }
            $singleArticles['author']=$arrElements;
        
            $arrayArticles[]=$singleArticles;
            echo $twig->render('result/article.tpl', [
                'works'		=> $arrayArticles,    
            ]);

     
    }

        /*
        echo "<pre> Works</br>";
        var_dump($arrayArticles);
        echo "</pre>";
       
        echo $twig->render('searchResults.tpl', [
		
            'works'		=> $arrayWorks,
            'articles'	=> $arrayArticles,
    
        ]);
        */


?>
<?php

	require_once 'include/config.php';

    $arrWorks = '';


    header('Content-type: text/plain; charset=utf-8');
    ini_set('display_errors',1); # uncomment if you need debugging
    include_once('include/head.php');
    echo "<body>";
    include_once('include/header.php');
    
    $actionParam	= (isset($_REQUEST['action'])	? $_REQUEST['action']	: '');
    $subject	= (isset($_REQUEST['subject'])	? $_REQUEST['subject']	: '');
    $id	= (isset($_REQUEST['id'])	? $_REQUEST['id']	: '');

    if($actionParam == "work"){
        $works = new works();
        $singleWork = $works->getWorksByWork_id($id);
        /* Reperisco dati publisher */
        $publisherObject = new publishers();
        $publisher = $publisherObject->getPublisherById($singleWork['publisher_id']);
        $singleWork['publisher']=$publisher[0]['publisher'];

        /* Reperisco dati Author */
        $authors = new authors();
        $arrAuthors = $authors->getAuthorsByWorkId($id);
                
        $people = new peoples();
        $arrElements = array();
        foreach($arrAuthors as $peoples_id){
                
            $author = $people->getPeopleById($peoples_id);
                    
            $arrElements[] = $author;     
        }
        $singleWork['author']=$arrElements;

        /* Reperisco dati Editor */
        $editors = new editors();
        $arrEditors = $editors->getAuthorsByWorkId($id);
        $arrElements = array();
        foreach($arrEditors as $peoples_id){
                
            $editor = $people->getPeopleById($peoples_id);
                    
            $arrElements[] = $editor;     
        }
        $singleWork['editors']=$arrElements; 
        
        /* Reperisco dati Illustrator */
        $illustrators = new illustrators();
        $arrIllustrators = $illustrators->getIllustratorsByWorkId($id);
        $arrElements = array();
        foreach($arrIllustrators as $peoples_id){
                
            $illustrator = $people->getPeopleById($peoples_id);
                    
            $arrElements[] = $illustrator;     
        }
        $singleWork['illustrators']=$arrElements; 


        /* Reperisco le edizioni */
        $editions = new editions();
        $editionsList = $editions->getEditionsByWork_id($id);
        $arrEditions = array();
        foreach($editionsList as $edition_id){
            $arrEditions[] = $editions->getEditionById($edition_id);
        }

        $singleWork['editions'] = $arrEditions;

        $arrayWorks[]=$singleWork;

        
        echo $twig->render('result/work.tpl', [
            'works'		=> $arrayWorks,    
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
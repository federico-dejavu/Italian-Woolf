<?php

	require_once '../include/config.php';
    require_once '../include/cleaner.php';
    require_once '../include/works.php';
    require_once '../include/publishers.php';
    require_once '../include/authors.php';
    require_once '../include/editions.php';
    require_once '../include/articles.php';
	require_once '../include/twig.php';

    $arrWorks = '';


    header('Content-type: text/plain; charset=utf-8');
    ini_set('display_errors',1); # uncomment if you need debugging

    $articlesParam	= (isset($_POST['articles'])	? $_POST['articles']	: '');
    $worksParam		= (isset($_POST['works'])		? $_POST['works']		: '');
    $postKeywords	= (isset($_POST['keywords'])	? $_POST['keywords']	: '');

    if($postKeywords){
        // Razionalizzo le keywords
        $cleaner = new cleaner();
        $keyOptimized = $cleaner->clearKeywords($postKeywords);


        /* Estraggo works ed editions */
        if($worksParam){ 
 
            $works = new works();
            $allWorksID = $works->getWorkIdByKeywords($keyOptimized);
                    
            $arrayWorks=array();
            foreach($allWorksID as $work_id){
                $singleWork = $works->getWorksByWork_id($work_id);
                /* Reperisco dati publisher */
                $publisherObject = new publishers();
                $publisher = $publisherObject->getPublisherById($singleWork['publisher_id']);
                $singleWork['publisher']=$publisher[0]['publisher'];

                /* Reperisco dati Author */
                $authors = new authors();
                $arrAuthors = $authors->getAuthorsByWorkId($work_id);
                
                $people = new peoples();
                $arrElements = array();
                foreach($arrAuthors as $peoples_id){
                
                    $author = $people->getPeopleById($peoples_id);
                    
                    $arrElements[] = $author;     
                }
                $singleWork['author']=$arrElements;

                /* Reperisco le edizioni */
                $editions = new editions();
                $editionsList = $editions->getEditionsByWork_id($work_id);
                $arrEditions = array();
                foreach($editionsList as $edition_id){
                    $arrEditions[] = $editions->getEditionById($edition_id);
                }
                if (DEBUG==true) {
                    echo "<pre> Works</br>";
                    var_dump($arrEditions);
                    echo "</pre>";  
                }
                $singleWork['editions'] = $arrEditions;

                $arrayWorks[]=$singleWork;
            }
         
        }

       /* Estraggo articles */
       if($articlesParam){ 

        $articles = new articles();
        $allArticlesID = $articles->getArticlesIdByKeywords($keyOptimized);
                
        $arrayArticles=array();
        foreach($allArticlesID as $articles_id){
            $singleArticles = $articles->getArticlesByArticles_id($articles_id);
            /* Reperisco dati publisher */
            $publisherObject = new publishers();
            $publisher = $publisherObject->getPublisherById($singleArticles['publisher_id']);
            $singleArticle['publisher']=$publisher[0]['publisher'];

            /* Reperisco dati Author */
            $authors = new authors();
            $arrAuthors = $authors->getAuthorsByArticleId($articles_id);
            
            $people = new peoples();
            $arrElements = array();
            foreach($arrAuthors as $peoples_id){
            
                $author = $people->getPeopleById($peoples_id);
                
                $arrElements[] = $author;     
            }
            $singleArticles['author']=$arrElements;

            $arrayArticles[]=$singleArticles;
        }

       
     
    }

    if (DEBUG==true) {
            echo "<pre> Works</br>";
            var_dump($arrayArticles);
            echo "</pre>";
        }
        
        echo $twig->render('searchResults.tpl', [
		
            'works'		=> $arrayWorks,
            'articles'	=> $arrayArticles,
    
        ]);
    }

?>
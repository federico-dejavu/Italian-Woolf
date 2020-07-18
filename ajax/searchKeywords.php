<?php

	require_once '../include/config.php';
    //require_once '../include/search.php';
    require_once '../include/cleaner.php';
    require_once '../include/works.php';
    require_once '../include/publishers.php';
    require_once '../include/authors.php';
	require_once '../include/twig.php';

    $arrWorks = '';


    header('Content-type: text/plain; charset=utf-8');
    
ini_set('display_errors',1); # uncomment if you need debugging

    $articles	= (isset($_POST['articles'])	? $_POST['articles']	: '');
    $works		= (isset($_POST['works'])		? $_POST['works']		: '');
    $postKeywords	= (isset($_POST['keywords'])	? $_POST['keywords']	: '');

    if($postKeywords){
        $cleaner = new cleaner();
        $keyOptimized = $cleaner->clearKeywords($postKeywords);
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
            
            echo "<pre> Author</br>";
            var_dump($arrAuthors);
            echo "</pre>";
            
            $people = new peoples();
            $arrElements = array();
            foreach($arrAuthors as $peoples_id){
               
                $author = $people->getPeopleById($peoples_id);
                
                $arrElements[] = $author;     
            }
            $singleWork['author']=$arrElements;
            $arrayWorks[]=$singleWork;
         
        }
        /*
        echo "<pre> Works</br>";
        var_dump($arrayWorks);
        echo "</pre>";
        */
        echo $twig->render('works.tpl', [
		
            'works'		=> $arrayWorks,
    
        ]);
    }
/*
    $instance = new search();
    $keywordsList = $instance->getAllKeywords();
   
    if($keywords != ""){
        
        $keyOptimized = $instance->clearKeywords($keywords);
               
        if($works == 'on'){
            $arrWorks = $instance->simpleSearchWorks($works,$articles, $keyOptimized);
            
        }
        
    }
	
	echo $twig->render('searchKeywords.tpl', [
		
		'works'		=> $arrWorks,

	]);
*/	
/*
	echo '<code style="white-space: pre-wrap;">';
	var_dump($arrWorks);
	echo '</code>';
*/

?>

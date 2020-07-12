<?php

	require_once '../include/config.php';
    //require_once '../include/search.php';
    require_once '../include/cleaner.php';
    require_once '../include/works.php';
    require_once '../include/publishers.php';
	require_once '../include/twig.php';

    $arrWorks = '';



ini_set('display_errors',1); # uncomment if you need debugging

    $articles	= (isset($_POST['articles'])	? $_POST['articles']	: '');
    $works		= (isset($_POST['works'])		? $_POST['works']		: '');
    $postKeywords	= (isset($_POST['keywords'])	? $_POST['keywords']	: '');

    if($postKeywords){
        $cleaner = new cleaner();
        $keyOptimized = $cleaner->clearKeywords($postKeywords);
        $works = new works();
        $allWorksID = $works->getWorkIdByKeywords($keyOptimized);
        //var_dump($allWorksID);
        $arrayWorks=array();
        foreach($allWorksID as $work_id){
            $singleWork = $works->getWorksByWork_id($work_id);
            $publisherObject = new publisher();
            $publisher = $publisherObject->getPublisherById($singleWork['publisher_id']);
            $singleWork['publisher']=$publisher['publisher'];
            $arrayWorks[]=$singleWork;
        }

        //$arrayWorks = $works->getWorksByListOfWork_id($allWorksID);

        
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

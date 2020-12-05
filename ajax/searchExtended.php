<?php

	require_once '../include/config.php';
    require_once '../include/cleaner.php';
    require_once '../include/works.php';
    require_once '../include/publishers.php';
    require_once '../include/peoples.php';
    require_once '../include/authors.php';
    require_once '../include/translators.php';
    require_once '../include/editions.php';
    require_once '../include/articles.php';
    require_once '../include/languages.php';   

    $arrWorks = '';
    $keyOptimized="";
    $typologyOptimized="";

    header('Content-type: text/plain; charset=utf-8');
    ini_set('display_errors',1); # uncomment if you need debugging


    $articlesParam	    = (isset($_POST['articles'])	? $_POST['articles']	    : '');
    $worksParam		    = (isset($_POST['works'])		? $_POST['works']		    : '');
    $postKeywords	    = (isset($_POST['keywords'])	? $_POST['keywords']	    : '');
    $postNome	        = (isset($_POST['nome'])	    ? $_POST['nome']	        : '');
    $postAuthors        = (isset($_POST['authors'])	    ? $_POST['authors']	        : '');
    $postTranslators    = (isset($_POST['translators']) ? $_POST['translators']	    : '');
    $postEditors        = (isset($_POST['editors'])	    ? $_POST['editors']	        : '');   
    $postTitle          = (isset($_POST['title'])	    ? $_POST['title']	        : '');
    $postPublisher      = (isset($_POST['publisher'])	? $_POST['publisher']	    : '');          
    $postJournal        = (isset($_POST['journal'])	    ? $_POST['journal']	        : '');
    $fromYear           = (isset($_POST['fromYear'])	? $_POST['fromYear']	    : '');
    $toYear             = (isset($_POST['toYear'])	    ? $_POST['toYear']	        : '');   
    $postLanguage       = (isset($_POST['language'])    ? $_POST['language']	    : '');
    $postTypology       = (isset($_POST['typology'])    ? $_POST['typology']	    : '');    
    $postopenAccess     = (isset($_POST['openAccess'])  ? $_POST['openAccess']	    : '');
    
    $cleaner = new cleaner();



    if($postKeywords){
        // Razionalizzo le keywords
        $keyOptimized = $cleaner->clearKeywords($postKeywords);
    }

    if($worksParam){
        $works = new works();
        $arrayWorks=array();
        $arrayWorksIntersec = array();
        $allWorksID = $works->getWorksByParam($keyOptimized,$postNome,$postAuthors,$postTranslators,$postEditors,$postTitle,$postPublisher,$postJournal,$fromYear,$toYear,$postLanguage,$postTypology,$postopenAccess);

        if($postNome){
            $people = new peoples();
            $peoplesList = $people->getPeopleListIdByFullName($postNome);
            echo "<pre>People</br>";
            var_dump($peoplesList);
            echo "</pre>"; 

            foreach($allWorksID as $work_id){
                $trovato = 0;
                if($postAuthors){
                    $authors = new authors();
                    $authorList = $authors->getAuthorsByWorkId($work_id);

                    $intersec = array_intersect($peoplesList,$authorList);

                    if(!empty($intersec)){
                        $trovato = 1;
                    }
                }

                if($postTranslators){
                    $translators = new translator();
                    $translatorsList = $translators->getAuthorsByWorkId($work_id);
                    $intersec = array_intersect($peoplesList,$translatorsList);
                    if(!empty($intersec)){
                        $trovato = 1;
                    }
                }

                if($postEditors){
                    $editors = new editors();
                    $editorsList = $editors->getAuthorsByWorkId($work_id);
                    $intersec = array_intersect($peoplesList,$editorsList);
                    if(!empty($intersec)){
                        $trovato = 1;
                    }
                }
                if($trovato == 1){
                    $arrayWorks['id'] = $work_id;
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

                    $singleWork['editions'] = $arrEditions;

                    $arrayWorks[]=$singleWork;
                }
                
            }
        }


        echo "<pre>Filtered Works</br>";
        var_dump($arrayWorks);
        echo "</pre>"; 
            
    }




  /*

    

    // Estraggo articles 
    if($articlesParam){ 
        $articles = new articles();
        $allArticlesID = $articles->getArticlesByParam($keyOptimized,$postNome,$postAuthors,$postTranslators,$postEditors,$postTitle,$postPublisher,$postJournal,$fromYear,$toYear,$postLanguage,$postTypology,$postopenAccess);
   
        $arrayArticles=array();
        foreach($allArticlesID as $articles_id){
            $singleArticles = $articles->getArticlesByArticles_id($articles_id);
            // Reperisco dati publisher 
            $publisherObject = new publishers();
            $publisher = $publisherObject->getPublisherById($singleArticles['publisher_id']);
            $singleArticle['publisher']=$publisher[0]['publisher'];

            // Reperisco dati Author 
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
    */
    if (DEBUG===true) {
        echo "<pre> Works</br>";
        var_dump($arrayArticles);
        echo "</pre>";
    }
    echo $twig->render('searchResults.tpl', [
		
        'works'		=> $arrayWorks,
        'articles'	=> $arrayArticles,
    
    ]);
?>

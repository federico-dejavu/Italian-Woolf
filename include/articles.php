<?php
require_once('DBManager.php');

class articles{
    
    public function getAllArticles() {
        $arrArticlesID = array();
       
        /* Estraggo i works_id con queste KW */

        $db = new DBManager();
        $queryK = "SELECT id,title FROM articles order by title asc";
        $arrArticlesID = $db->queryList($queryK);
        return $arrArticlesID;
    }


    // Commento di prova 
    /* Dato un elenco di Keyword restituisce un array di articles_id */
    public function getArticlesIdByKeywords($keywords = "") {
        $arrArticlesID = array();
       
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $db = new DBManager();
            $queryK = "SELECT distinct(AK.articles_id),title FROM articles_keywords as AK, keywords as K, articles as W  where K.id = AK.keywords_id and K.keyword REGEXP '$keywords' and W.id = AK.articles_id order by W.title asc";
            $arrArticlesID = $db->queryList($queryK);
        }
        
        return $arrArticlesID;
    }
    
    /* Dato un word_id restite un array di articles */
    public function getArticlesByArticles_id($id = "") {
        $arrArticles = array();
       
        if($id){
            $db = new DBManager();
            $queryW = "SELECT id, title, volume_title, journal_title, journal_issue, pubblication_date, year, publisher_id, city, serie_id, pages, price, typology_id, language, open_access, abstract, description, isbn, issn, libraries, image, doi, typology FROM articles, typologies WHERE articles.id = $id and typologies.id=articles.typology_id order by title asc";

            $arrArticles = $db->query($queryW);
        }
        
        return $arrArticles;
    } 
    
    
    /* Dato tutti i parametri del form di ricerca avanzata recupera i articles_id che soddisfano la ricerca */
    public function getArticlesByParam($keyOptimized = "",$postNome = "",$postAuthors = "",$postTranslators = "",$postEditors = "",$postTitle = "",$postPublisher = "",$postJournal = "",$fromYear="",$toYear="",$postLanguage = "",$postTypology = "",$postopenAccess = "") {
        $arrWorksID = array();
        $db = new DBManager();
        $query = "SELECT distinct(articles.id),title,year";
        $from =" FROM articles";
        $where =" articles.id != '' ";
        $passo = 0;

        /* Compongo la query in relazione ai parametri */
        if($keyOptimized){ 
            $from = $from.", articles_keywords as AK, keywords as K ";
            $where = $where."AND K.id = AK.keywords_id and K.keyword REGEXP '$keyOptimized' and articles.id = AK.articles_id ";
            $passo = 1;
        }

        if($postTitle){
            $where = $where." and title like'%".$postTitle."%' ";
        }

        if($fromYear){
            $where = $where." and year >= $fromYear ";
        }        

        if($toYear){
            $where = $where." and year <= $toYear ";
        } 
 

        if($postLanguage){
            $where = $where." AND language = $postLanguage ";            
        }
        /* lo tengo nel caso in cui elisa decida di passare a N:N 
        if($postTypology){
            $from = $from.", works_typologies AS WTP, typologies as T";
            if($passo == 1){
                $where = $where." AND WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = W.id ";
            } else {
                $where = $where." WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = W.id ";
            }
        }  
        */
        if($postTypology){
            $where = $where." AND articles.typology_id = $postTypology ";
        }  

        if($postPublisher){
            $where = $where." AND articles.publisher_id = $postPublisher ";
        }
        
        if($postJournal){
            $where = $where." and articles.journal_title like'%".$postJournal."%' ";
        } 
        
        if($postopenAccess){
            $where = $where." and articles.open_access =  $postopenAccess";
        }         

        $query = $query.$from." WHERE ".$where." order by articles.year asc";

        if (DEBUG) {
            echo "<pre>getArticlesByParam Query</br>";
            var_dump($query);
            echo "</pre>";
        } 
        $arrWorksID = $db->queryList($query);
        return $arrWorksID;
    } 









}
?>
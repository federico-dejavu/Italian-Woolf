<?php
require_once('DBManager.php');

class articles{
    
    // Commento di prova 
    /* Dato un elenco di Keyword restituisce un array di articles_id */
    public function getArticlesIdByKeywords($keywords = "") {
        $arrArticlesID = array();
       
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $db = new DBManager();
            $queryK = "SELECT distinct(AK.articles_id),title FROM articles_keywords as AK, keywords as K, articles as W  where K.id = AK.keywords_id and K.keyword REGEXP '$keywords' and A.id = AK.articles_id order by A.title asc";
            $arrArticlesID = $db->queryList($queryK);
        }
        
        return $arrArticlesID;
    }
    
    /* Dato un word_id restite un array di articles */
    public function getArticlesByArticles_id($id = "") {
        $arrArticles = array();
       
        if($id){
            $db = new DBManager();
            $queryW = "SELECT id, title, volume_title, journal_title, journal_issue, pubblication_date, year, publisher_id, city, serie_id, pages, price, typology_id, language, open_access, abstract, description, isbn, issn, libraries, image, doi FROM articles WHERE id = $id order by title asc";

            $arrArticles = $db->query($queryW);
        }
        
        return $arrArticles;
    } 
    
    
    /* Dato tutti i parametri del form di ricerca avanzata recupera i articles_id che soddisfano la ricerca */

    public function getArticlesByParam($keyOptimized = "",$postNome = "",$postAuthors = "",$postTranslators = "",$postEditors = "",$postTitle = "",$postPublisher = "",$postJournal = "",$fromYear="",$toYear="",$postLanguage = "",$postTypology = "",$postopenAccess = "") {
        $arrWorksID = array();
        $db = new DBManager();
        $query = "SELECT distinct(A.id),title";
        $from =" FROM articles as A";
        $where ="";
    

        /* Compongo la query in relazione ai parametri */
        if($keyOptimized){ 
            $from = $from.", articles_keywords as AK, keywords as K ";
            $where = $where." K.id = AK.keywords_id and K.keyword REGEXP '$keyOptimized' and A.id = AK.articles_id ";
            
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
        /* solo se nome è valorizzato ha senso che cerco in authors, translators ed editors*/
        if($postNome){
            $from = $from.", peoples as P ";
            $where = $where." AND P.fullname LIKE '%".$postNome."%' AND ("; 
            $passo = 0;
            if($postAuthors){
                $from = $from.", articles_authors AS AA"; 
                $where = $where." AA.peoples_id=P.id ";
                $passo = 1;
            }

            if($postTranslators){
                $from = $from.", articles_translators AS AT"; 
                if($passo == 0){
                    $where = $where." AT.peoples_id=P.id ";
                } else {
                    $where = $where." OR AT.peoples_id=P.id ";
                    $passo = 1;
                }
            }
            if($postEditors){
                $from = $from.", articles_editors AS AE";
                if($passo == 0){
                    $where = $where." AE.peoples_id=P.id ";
                } else {
                    $where = $where." OR AE.peoples_id=P.id ";
                    $passo = 1;
                }
            }           
            $where = $where.") ";
        }
        
        if($postLanguage){
            $where = $where." AND original = $postLanguage ";
        }

        /* Tengo qs codice perché penso che Elisa potrebbe chiederci di far diventare qs campo un multi - multi 
        if($postTypology){
            $from = $from.", works_typologies AS WTP, typologies as T";
            $where = $where." AND WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = A.id ";
        }  
        */

        if($postTypology){
            $where = $where." AND A.typology_id = $postTypology ";
        }          
        
        if($postPublisher){
            $where = $where." AND A.publishers_id = $postPublishers ";
        }     
        
        if($postJournal){
            $where = $where." and journal_title like'%".$postJournal."%' ";
        } 
        
        if($postopenAccess){
            $where = $where." and A.open_access =  $postopenAccess";
        }        
    
        $query = $query.$from." WHERE ".$where." order by A.title asc";

        echo "<pre> QUERY Articles</br>";
        var_dump($query);
        echo "</pre>";

        $arrWorksID = $db->queryList($query);
        return $arrWorksID;
    } 









}
?>
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
        $passo = 0;

        /* Compongo la query in relazione ai parametri */
        if($keyOptimized){ 
            $from = $from.", articles_keywords as AK, keywords as K ";
            $where = $where." K.id = AK.keywords_id and K.keyword REGEXP '$keyOptimized' and A.id = AK.articles_id ";
            $passo = 1;
        }

        if($postTitle){
            if($passo ==1){  
                $where = $where." and title like'%".$postTitle."%' ";
            } else {
                $where = $where." title like'%".$postTitle."%' ";
                $passo = 1;
            }
            
        }

        if($fromYear){
            if($passo ==1){ 
                $where = $where." and year >= $fromYear ";
            } else {
                $where = $where." year >= $fromYear ";
                $passo = 1;
            }
        }        

        if($toYear){
            if($passo ==1){ 
                $where = $where." and year <= $toYear ";
            } else {
                $where = $where." year <= $toYear "; 
                $passo = 1;
            }    
        } 
        /* solo se nome è valorizzato ha senso che cerco in authors, translators ed editors*/
        /*
        if($postNome){
            $from = $from.", peoples as P ";
            $concat = 0;
            if($postAuthors){
                
                $from = $from.", articles_authors AS AA "; 
                if($concat == 0 & $passo == 0){
                    $where = $where." (P.id = AA.peoples_id and A.id = AA.articles_id) ";
                } else {
                    $where = $where." OR (P.id = AA.peoples_id and A.id = AA.articles_id) ";
                    $passo =1;
                } 
                $concat = 1;               
            } 

            
            if($postTranslators){   
                $from = $from.", articles_translators AS AT ";
                if($concat == 0 & $passo == 0){
                    $where = $where." (P.id = AT.peoples_id and A.id = AT.articles_id) ";
                } else {
                    $where = $where." OR (P.id = AT.peoples_id and A.id = AT.articles_id) ";
                    $passo =1;
                }  
                $concat = 1;                
            }

            if($postEditors){
                $from = $from.", articles_editors AS AE ";
                if($concat == 0 & $passo == 0){
                    $where = $where." (P.id = AE.peoples_id and A.id = AE.articles_id) ";
                } else {
                    $where = $where." OR (P.id = AE.peoples_id and A.id = AE.articles_id) ";
                    $passo =1;
                }   
                $concat = 1;              
            } 

            $where = $where." AND P.fullname LIKE '%".$postNome."%' ";
            */

            if($postNome){
                $from = $from.", peoples as P ";
    
                if($postAuthors){
                    $from = $from." LEFT JOIN articles_authors  ON P.id = articles_authors.peoples_id "; 
                } 
    
                
                if($postTranslators){
                    $from = $from." LEFT JOIN articles_translators ON P.id = articles_translators.peoples_id "; 
                }
    
                if($postEditors){
                    $from = $from." LEFT JOIN articles_editors  ON P.id=articles_editors.peoples_id ";
                }             
    
                if($passo == 1){
                    $where = $where." AND P.fullname LIKE '%".$postNome."%' "; 
                } else {
                    $where = $where." P.fullname LIKE '%".$postNome."%' ";  
                    $passo = 1; 
                }   
            }
 


        if($postLanguage){
            if($passo == 1){
                $where = $where." AND original = $postLanguage ";
            } else {
                $where = $where." original = $postLanguage ";
            }
            
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
            if($passo == 1){
                $where = $where." AND A.typology_id = $postTypology ";
            } else {
                $where = $where." A.typology_id = $postTypology ";
                $passo = 1;
            }
        }  

        if($postPublisher){
            if($passo == 1){
                $where = $where." AND A.publisher_id = $postPublisher ";
            } else   {
                $where = $where." A.publisher_id = $postPublisher ";
                $passo = 1;
            }
        }
        
        if($postJournal){
            if($passo == 1){
                $where = $where." and A.journal_title like'%".$postJournal."%' ";
            } else {
                $where = $where." A.journal_title like'%".$postJournal."%' ";
                $passo = 1;
            }
        } 
        
        if($postopenAccess){
            if($passo == 1){
                $where = $where." and A.open_access =  $postopenAccess";
            } else {
                $where = $where." A.open_access =  $postopenAccess";
                $passo = 1;
            }
        }         

        $query = $query.$from." WHERE ".$where." order by A.title asc";

        echo "<pre> QUERY Works</br>";
        var_dump($query);
        echo "</pre>";
         
        $arrWorksID = $db->queryList($query);
        return $arrWorksID;
    } 









}
?>
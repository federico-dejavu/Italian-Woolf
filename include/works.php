<?php
require_once('DBManager.php');

class works{
    
    // Commento di prova 
    /* Dato un elenco di Keyword restituisce un array di work_id */
    public function getWorkIdByKeywords($keywords = "") {
        $arrWorksID = array();
       
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $db = new DBManager();
            $queryK = "SELECT distinct(WK.works_id),title FROM works_keywords as WK, keywords as K, works as W  where K.id = WK.keywords_id and K.keyword REGEXP '$keywords' and W.id = WK.works_id order by W.title asc";
            $arrWorksID = $db->queryList($queryK);
        }
        
        return $arrWorksID;
    }

    /* Dato tutti i parametri del form di ricerca avanzata recupera i work_id che soddisfano la ricerca */

    public function getWorksByParam($keyOptimized = "",$postNome = "",$postAuthors = "",$postTranslators = "",$postEditors = "",$postTitle = "",$postPublisher = "",$postJournal = "",$fromYear="",$toYear="",$postLanguage = "",$postTypology = "",$postopenAccess = "") {
        $arrWorksID = array();
        $db = new DBManager();
        $query = "SELECT distinct(W.id),title";
        $from =" FROM works as W";
        $where ="";
        $passo = 0;

        /* Compongo la query in relazione ai parametri */
        if($keyOptimized){ 
            $from = $from.", works_keywords as WK, keywords as K ";
            $where = $where." K.id = WK.keywords_id and K.keyword REGEXP '$keyOptimized' and W.id = WK.works_id ";
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
        if($postNome){
            $from = $from.", peoples as P ";

            if($postAuthors){
                $from = $from." LEFT JOIN works_authors AS WA ON P.id = WA.peoples_id "; 
            } 

            
            if($postTranslators){
                $from = $from." LEFT JOIN works_translators AS WT ON P.id = WT.peoples_id "; 
            }

            if($postEditors){
                $from = $from." LEFT JOIN works_editors AS WE ON P.id=WE.peoples_id ";
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

        if($postTypology){
            $from = $from.", works_typologies AS WTP, typologies as T";
            if($passo == 1){
                $where = $where." AND WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = W.id ";
            } else {
                $where = $where." WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = W.id ";
            }
        }  
        
        if($postPublisher){
            if($passo == 1){
                $where = $where." AND W.publisher_id = $postPublisher ";
            } else   {
                $where = $where." W.publisher_id = $postPublisher ";
                $passo = 1;
            }
        }   

        $query = $query.$from." WHERE ".$where." order by W.title asc";

        echo "<pre> QUERY Works</br>";
        var_dump($query);
        echo "</pre>";
         
        $arrWorksID = $db->queryList($query);
        return $arrWorksID;
    }  
    
    /* Dato un word_id restituisce un work */
    public function getWorksByWork_id($work_id = "") {
        $arrWorks = array();
       
        if($work_id){
            $db = new DBManager();
            $queryW = "SELECT id, title, original, year, publisher_id, city, serie_id, pages, description, isbn, libraries, image FROM works WHERE id = $work_id order by title asc";
            $arrWorks = $db->query($queryW);
        }
        
        return $arrWorks;
    }   
    
    /* Dato un array di works_id restituisce un array di works */
    public function getWorksByListOfWork_id($arrWorksID = "") {
        $arrWorks = array();
        $arrTotal = array();
       
        if($arrWorksID){
            $db = new DBManager();
            foreach ($arrWorksID as $work_id){
                
                $queryW = "SELECT id, title, original, year, publisher_id, city, serie_id, pages, description, isbn, libraries, image FROM works WHERE id = $work_id";
                $arrWorks = $db->query($queryW);

                $arrTotal[] = $arrWorks;
            }
        }

        return $arrTotal;
    }      
    

}
?>
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

    public function getWorkByParam($keyOptimized = "",$postNome = "",$postAuthors = "",$postTranslators = "",$postEditors = "",$postTitle = "",$postPublisher = "",$postJournal = "",$fromYear="",$toYear="",$postLanguage = "",$postTypology = "",$postopenAccess = "") {
        $arrWorksID = array();
        $db = new DBManager();
        $query = "SELECT distinct(WK.works_id),title";
        $from =" FROM works as W";
        $where ="";

        /* Compongo la query in relazione ai parametri */
        if($keyOptimized){
            
            $from = $from.", works_keywords as WK, keywords as K ";
            $where = $where." K.id = WK.keywords_id and K.keyword REGEXP '$keyOptimized' and W.id = WK.works_id ";
            
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
                $from = $from.", works_authors AS WA"; 
                $where = $where." WA.peoples_id=P.id ";
                $passo = 1;
            }

            if($postTranslators){
                $from = $from.", works_translators AS WT"; 
                if($passo == 0){
                    $where = $where." WT.peoples_id=P.id ";
                } else {
                    $where = $where." OR WT.peoples_id=P.id ";
                    $passo = 1;
                }
            }
            if($postEditors){
                $from = $from.", works_editors AS WE";
                if($passo == 0){
                    $where = $where." WE.peoples_id=P.id ";
                } else {
                    $where = $where." OR WE.peoples_id=P.id ";
                    $passo = 1;
                }
            }           
            $where = $where.") ";
        }
        
        if($postLanguage){
            $where = $where." AND original = $postLanguage ";
        }

        if($postTypology){
            $from = $from.", works_typologies AS WTP, typologies as T";
            $where = $where." AND WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = W.id ";
        }  
        
        if($postPublisher){
            $where = $where." AND W.publishers_id = $postPublishers ";
        }           
        $query = $query.$from." WHERE ".$where." order by W.title asc";
        $arrWorksID = $db->queryList($query);
        return $arrWorksID;
    }  
    
    /* Dato un word_id restituisce un array di works */
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
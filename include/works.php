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

    public function getWorkByParam($keyOptimized = "",$postNome = "",$postAuthors = "",$postTranslators = "",$postEditors = "",$postTitle = "",$postPublisher = "",$postJournal = "",$postLanguage = "",$postTypology = "",$postopenAccess = "") {
        $arrWorksID = array();
       
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $db = new DBManager();
            $queryK = "SELECT distinct(WK.works_id),title FROM works_keywords as WK, keywords as K, works as W  where K.id = WK.keywords_id and K.keyword REGEXP '$keywords' and W.id = WK.works_id order by W.title asc";
            $arrWorksID = $db->queryList($queryK);
        }
        
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
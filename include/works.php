
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
            $queryK = "SELECT WK.works_id FROM works_keywords as WK, keywords as K  where K.id = WK.keywords_id and K.keyword REGEXP '$keywords' ";
            $arrWorksID = $db->queryList($queryK);
        }
        
        return $arrWorksID;
    }
    
    /* Dato un word_id restituisce un array di works */
    public function getWorksByWork_id($work_id = "") {
        $arrWorks = array();
       
        if($work_id){
            $db = new DBManager();
            $queryW = "SELECT id, title, original, year, publisher_id, city, serie_id, pages, description, isbn, libraries, image FROM works WHERE id = $work_id";
            $arrWorks = $db->queryList($queryW);
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
                $arrWorks = $db->queryList($queryW);
                $arrTotal[$work_id] = $arrWorks;
            }
        }
        
        return $arrTotal;
    }      
    

}
?>

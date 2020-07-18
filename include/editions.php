<?php
require_once('DBManager.php');

class editions{
    
    /* Dato un word_id restituisce un array di editions */
    public function getEditionsByWork_id($work_id = "") {
        $arrElements = array();
       
        if($work_id){
            $db = new DBManager();
            $query = "SELECT id FROM editions WHERE works_id = $work_id";
            $arrElements = $db->queryList($query);
        }
        
        return $arrElements;
    }
    
     /* Dato un array di works_id restituisce un array di works */
     public function getEditionById($id = "") {
        $arrElements = array();
       
        if($id){
            $db = new DBManager();
            $queryW = "SELECT id, title, works_id, original, year, publisher_id, city, serie_id, pages, price, description, isbn, libraries, image FROM editions WHERE id = $id";
            $arrElements = $db->queryList($queryW);
        }
        return $arrElements;
    }    
    
    /* Dato un array di works_id restituisce un array di works */
    public function getEditionsByListOfEdition_id($arrEditionsID = "") {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            foreach ($arrEditionsID as $editions_id){
                $queryW = "SELECT id, title, works_id, original, year, publisher_id, city, serie_id, pages, price, description, isbn, libraries, image FROM editions WHERE id = $editions_id";
                $arrElements = $db->queryList($queryW);
                $arrTotal[$editions_id] = $arrElements;
            }
        }
        
        return $arrTotal;
    }      
    

}
?>
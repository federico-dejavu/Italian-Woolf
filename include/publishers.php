
<?php
require_once('DBManager.php');

class publishers{
    
    /* Dato un publishers_id restituisce un array di publisher */
    public function getPublisherById($publishers_id = "") {
        $arrElements = array();
       
        if($publishers_id){
            $db = new DBManager();
            $conn = $db->DBConnaction();
            $query = "SELECT id, publisher, description, link FROM publishers WHERE id = $publishers_id";
            $arrElements = $conn->queryList($query);
        }
        
        return $arrElements;
    }   
    
    /* Dato un array di works_id restituisce un array di publisher */
    public function getAllPublishers() {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            $conn = $db->DBConnaction();
            $queryW = "SELECT id, publisher, description, link FROM publishers";
            $arrElements = $conn->queryList($queryW);
            $arrTotal[] = $arrElements;
        }
        
        return $arrTotal;
    }      
    

}
?>
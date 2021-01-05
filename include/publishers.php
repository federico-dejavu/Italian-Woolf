<?php
require_once('DBManager.php');

class publishers{
    
    /* Restituisce un array di tutti i publisher */
    public function getAllPublishers() {
        $arrElements = array();
        
        $db = new DBManager();
        $query = "SELECT id, publisher, description, link FROM publishers order by publisher";
        $arrElements = $db->queryList($query);
        
        return $arrElements;
    }      

    /* Dato un publishers_id restituisce un array di publisher */
    public function getPublisherById($publishers_id = "") {
        if($publishers_id){
            $db = new DBManager();
            $query = "SELECT id, publisher, description, link FROM publishers WHERE id = $publishers_id";

            $arrElements = $db->query($query);
        }
        return $arrElements;
    }   
}
?>
<?php
require_once('DBManager.php');

class publishers{
    
    /* Dato un publishers_id restituisce un array di publisher */
    public function getPublisherById($publishers_id = "") {
        if($publishers_id){
            $db = new DBManager();
            $query = "SELECT id, publisher, description, link FROM publishers WHERE id = $publishers_id";

            $arrElements = $db->query($query);
        }
        return $arrElements;
    }   
    
    /* Dato un array di works_id restituisce un array di publisher */
    public function getAllPublishers() {
        $arrElements = array();
        $arrTotal = array();
       
        $db = new DBManager();
        $queryW = "SELECT id, publisher, description, link FROM publishers";
        $arrElements = $db->query($queryW);
        $arrTotal[] = $arrElements;

            
        return $arrTotal;
    }      
}
?>
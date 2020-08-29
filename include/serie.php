<?php
require_once('DBManager.php');

class series{
    
    /* Dato un id restituisce una serie */
    public function getPublisherById($serie_id = "") {
        $arrElements = array();
       
        if($serie_id){
            $db = new DBManager();
            $query = "SELECT id, publisher_id, serie FROM series WHERE id = $serie_id";

            $arrElements[] = $db->query($query);
        }
        
        return $arrElements;
    }   
    
    /* Dato un id serie restituisce un array di series */
    public function getAllPublishers() {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            $queryW = "SELECT id, publisher_id, serie FROM series";
            $arrElements = $db->queryList($queryW);
            $arrTotal[] = $arrElements;
        }
        
        return $arrTotal;
    }      
}
?>
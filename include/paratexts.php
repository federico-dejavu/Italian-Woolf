<?php
require_once('DBManager.php');

class paratexts{
    
    /* Dato un id restituisce una paratexts */
    public function getParatextById($paratexts_id = "") {      
        if($paratexts_id){
            $db = new DBManager();
            $query = "SELECT id, paratext FROM paratexts WHERE id = $paratexts_id";
            $paratext = $db->query($query);
        }
        return $paratext[0];
    }   

    /* Dato un work restituisce un paratext */
    public function getParatextByWorkId($work_id = "") {
        if($work_id){
            $db = new DBManager();
            $query = "SELECT paratexts_id FROM works_paratexts WHERE works_id = $work_id";
            $paratext_id = $db->queryList($query);
        }
        return $paratext_id[0];
    }    
    
    /* Dato restituisce un array di tutti i  paratexts */
    public function getAllParatexts() {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            $queryW = "SELECT id, paratexts FROM paratexts";
            $arrElements = $db->queryList($queryW);
            $arrTotal[] = $arrElements;
        }
        
        return $arrTotal;
    }      
}
?>
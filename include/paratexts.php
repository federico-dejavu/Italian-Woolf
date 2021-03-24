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
        return $paratext;
    }   

    /* Dato un work restituisce un paratext */
    public function getParatextsByWorkId($work_id = "") {
        if($work_id){
            $db = new DBManager();
            $query = "SELECT paratexts_id FROM works_paratexts WHERE works_id = $work_id";
            $paratexts_id = $db->queryList($query);
        }
        return $paratexts_id;
    }    
    
    /* Dato una edition restituisce un paratext */
    public function getParatextsByEditionId($edition_id = "") {
        if($edition_id){
            $db = new DBManager();
            $query = "SELECT paratexts_id FROM editions_paratexts WHERE editions_id = $edition_id";
            $paratexts_id = $db->queryList($query);
        }
        return $paratexts_id;
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
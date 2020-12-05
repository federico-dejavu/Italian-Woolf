<?php
require_once('DBManager.php');

class peoples{
    
    /* Dato un id restituisce un array di people */
    public function getPeopleById($id = "") {
        $arrElements = array();
       
        if($id){
            $db = new DBManager();
            $query = "SELECT id, other_name, fullname, birth_date, death_date, authority_record, image FROM peoples WHERE id = $id order by fullname desc";

            $arrElements = $db->query($query);
        }
        
        return $arrElements;
    }   

    public function getPeopleByFullName($fullname = "") {
        $arrElements = array();
       
        if($fullname){
            $db = new DBManager();
            $query = "SELECT id, other_name, fullname, birth_date, death_date, authority_record, image FROM peoples WHERE fullname like (%".$fullname."%) order by fullname desc";
            var_dump($query);
            $arrElements = $db->query($query);
        }
        
        return $arrElements;
    }   
    
   
    public function getAllPeopless() {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            $queryW = "SELECT id, other_name, fullname, birth_date, death_date, authority_record, image FROM peoples";
            $arrElements = $db->query($queryW);
            $arrTotal[] = $arrElements;
        }
        
        return $arrTotal;
    }      

}
?>
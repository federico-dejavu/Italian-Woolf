<?php
require_once('DBManager.php');
require_once('peoples.php');

class authors{
    
    /* Dato un work restituisce un array di  
    public function getAuthoByWorkId($id = "") {
        $arrElements = array();
        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM works_authors WHERE works_id = $id";
            $arrPeoples[] = $db->query($query);
            $people = new peoples();
            foreach($arrPeoples as $key=>$value){
                
                $authors = $people->getPeopleById($value['people_id']);


                $arrElements[] = $authors;
                
            }
        }
        return $arrElements;
    }  
    */
    
    
      /* Dato un work restituisce un array di author */
      public function getAuthorsByWorkId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM works_authors WHERE works_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }    
    
    /* Dato un array di works_id restituisce un array di publisher */
    public function getAllPublishers() {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            $queryW = "SELECT id, publisher, description, link FROM publishers";
            $arrElements = $db->queryList($queryW);
            $arrTotal[] = $arrElements;
        }
        
        return $arrTotal;
    }      
    

}
?>
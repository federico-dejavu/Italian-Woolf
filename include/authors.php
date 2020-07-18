<?php
require_once('DBManager.php');
require_once('peoples.php');

class authors{
    
    /* Dato un work restituisce un array di publisher */
    public function getAuthoByWorkId($id = "") {
        $arrElements = array();
        $arrPeoples = array();
       
        if($id){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM works_authors WHERE works_id = $id";
            $arrPeoples[] = $db->query($query);

            var_dump($arrPeoples);

            $people = new peolples();
            foreach($arrPeoples as $key,$value){
                $author = $people->getPeopleById($value['id']);
                $arrElements[] = $author;
            }
        }

        var_dump($arrElements);

        return $arrElements;
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
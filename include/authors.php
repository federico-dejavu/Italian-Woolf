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
            echo ("<pre>Peoples</br>");
            var_dump($arrPeoples);
            echo ("</pre>");
            $people = new peolples();
            foreach($arrPeoples as $key,$value){
                $author = $people->getPeopleById($value['id']);
                $arrElements[] = $author;
            }
        }
        echo ("<pre>Authr</br>");
        var_dump($arrElements);
        echo ("</pre>");
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
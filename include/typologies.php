<?php
require_once('DBManager.php');

class typologies{
 
    /* Restituisce un array di tutti i language */
    public function getAllTypologies() {
        $arrElements = array();

        $db = new DBManager();
        $query = "SELECT id, typology FROM typologies order by typology";
        $arrElements = $db->queryList($query);
        return $arrElements;
    }
 
    /* Dato un languages_id restituisce un array di language */
    public function getTypologyById($typology_id = "") {
        if($typology_id){
            $db = new DBManager();
            $query = "SELECT id, typology FROM typologies where id = $typology_id";
            $arrElements = $db->query($query);
        }
        return $arrElements;
    }
}
?>
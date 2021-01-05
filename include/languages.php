<?php
require_once('DBManager.php');

class languages{
 
    /* Restituisce un array di tutti i language */
    public function getAllLanguages() {
        $arrElements = array();

        $db = new DBManager();
        $query = "SELECT id, language, code FROM languages order by language";
        $arrElements = $db->queryList($query);
        return $arrElements;
    }
 
    /* Dato un languages_id restituisce un array di language */
    public function getLanguageById($languages_id="") {
        if($publishers_id){
            $db = new DBManager();
            $query = "SELECT id, language, code FROM languages where id = $languages_id";
         
            $arrElements = $db->query($query);
        }
        return $arrElements;
    }
}
?>
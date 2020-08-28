<?php
require_once('DBManager.php');

class languages{
 
    public function getAllLanguages() {
        $arrElements = array();

        $db = new DBManager();
        $queryW = "SELECT id, language, code FROM languages";
        $arrElements = $db->query($queryW);
        return $arrElements;
    }

    public function getLanguageById($id="") {
        $db = new DBManager();
        $queryW = "SELECT id, language, code FROM languages where id = $id";
        $arrElements = $db->queryList($queryW);
        return $arrElements;
    }
}
?>
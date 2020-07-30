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
}
?>
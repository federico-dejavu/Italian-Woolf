<?php
require_once('DBManager.php');
require_once('peoples.php');

class secondary_authors{
    
      /* Dato un work restituisce un array di secondary_author */
      public function getSecondaryAuthorsByWorkId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM works_secondary_authors WHERE works_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }         
}
?>
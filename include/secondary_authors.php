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
        var_dump($arrPeoples);
        return $arrPeoples;
    }         
  
      /* Dato una edition restituisce un array di secondary_author */
      public function getSecondaryAuthorsByEditionId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM editions_secondary_authors WHERE editions_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }         

    /* Dato un second_author restituisce un array di works */
    public function getWorksBySecondary_authorsId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT distinct(works_id) FROM works_secondary_authors WHERE peoples_id = $id";
            $arrWorks = $db->queryList($query);
        }
        return $arrWorks;
    }    
}
?>
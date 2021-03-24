<?php
require_once('DBManager.php');
require_once('peoples.php');

class authors{
    
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

    /* Dato un work restituisce un array di author */
    public function getAuthorsByEditionId($id = "") {

    $arrPeoples = array();

    if($id>0){
        $db = new DBManager();
        $query = "SELECT peoples_id FROM works_authors WHERE works_id = $id";
        $arrPeoples = $db->queryList($query);
    }
    return $arrPeoples;
    }    

    /* Dato un author restituisce un array di works */
      public function getWorksByAuthorId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT distinct(works_id) FROM works_authors WHERE peoples_id = $id";
            $arrWorks = $db->queryList($query);
        }
        return $arrWorks;
    }    

    

    public function getAuthorsByArticleId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM articles_authors WHERE articles_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }       
    
}
?>
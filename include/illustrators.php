<?php
require_once('DBManager.php');
require_once('peoples.php');

class illustrators{

      /* Dato un work restituisce un array di illustrators */
      public function getIllustratorsByWorkId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM works_illustrators WHERE works_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }    
  
    /* Dato un illustrators restituisce un array di works */
    public function getWorksByIllutratorsId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT distinct(works_id) FROM works_illustrators WHERE peoples_id = $id";
            $arrWorks = $db->queryList($query);
        }
        return $arrWorks;
    }    

    public function getIllustratorsByArticleId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM articles_illustrators WHERE articles_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }       

}
?>
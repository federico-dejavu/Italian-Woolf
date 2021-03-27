<?php
require_once('DBManager.php');
require_once('peoples.php');

class translators{
    
    /* Dato un work restituisce un array di translators */
    public function getTranslatorsByWorkId($id = "") {

    $arrPeoples = array();

        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM works_translators WHERE works_id = $id";
            $arrPeoples = $db->queryList($query);
        }
    return $arrPeoples;
    }         

    /* Dato un work restituisce un array di translators */
    public function getTranslatorsByEditionId($id = "") {

        $arrPeoples = array();
    
            if($id>0){
                $db = new DBManager();
                $query = "SELECT peoples_id FROM editions_translators WHERE works_id = $id";
                $arrPeoples = $db->queryList($query);
            }
        return $arrPeoples;
        }         
      
    /* Dato un translator restituisce un array di works */
     public function getWorksByTranslatorId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT distinct(works_id) FROM works_translators WHERE peoples_id = $id";
            $arrWorks = $db->queryList($query);
        }
        return $arrWorks;
    }    
 
    public function getTranslatorsByArticleId($id = "") {

        $arrPeoples = array();
       
        if($id>0){
            $db = new DBManager();
            $query = "SELECT peoples_id FROM articles_translators WHERE articles_id = $id";
            $arrPeoples = $db->queryList($query);
        }
        return $arrPeoples;
    }       
    
}
?>
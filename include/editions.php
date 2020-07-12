
<?php
require_once('DBManager.php');

class editions{
    
    /* Dato un word_id restituisce un array di editions */
    public function getEditionsByWork_id($work_id = "") {
        $arrElements = array();
       
        if($work_id){
            $db = new DBManager();
            $conn = $db->DBConnaction();
            $query = "SELECT id FROM editions WHERE work_id = $work_id";
            $arrElements = $conn->queryList($query);
        }
        
        return $arrElements;
    }   
    
    /* Dato un array di works_id restituisce un array di works */
    public function getEditionsByListOfEdition_id($arrEditionsID = "") {
        $arrElements = array();
        $arrTotal = array();
       
        if($arrEditionsID){
            $db = new DBManager();
            $conn = $db->DBConnaction();
            foreach ($arrEditionsID as $editions_id){
                $queryW = "SELECT id, title, works_id, original, year, publisher_id, city, serie_id, pages, price, description, isbn, libraries, image FROM works WHERE id = $editions_id";
                $arrElements = $conn->queryList($queryW);
                $arrTotal[$editions_id] = $arrElements;
            }
        }
        
        return $arrTotal;
    }      
    

}
?>

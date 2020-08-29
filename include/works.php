<?php
require_once('DBManager.php');

class works{
    
    // Commento di prova 
    /* Dato un elenco di Keyword restituisce un array di work_id */
    public function getWorkIdByKeywords($keywords = "") {
        $arrWorksID = array();
       
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $db = new DBManager();
            $queryK = "SELECT distinct(WK.works_id),title FROM works_keywords as WK, keywords as K, works as W  where K.id = WK.keywords_id and K.keyword REGEXP '$keywords' and W.id = WK.works_id order by W.title asc";
            $arrWorksID = $db->queryList($queryK);
        }
        
        return $arrWorksID;
    }

    /* Dato tutti i parametri del form di ricerca avanzata recupera i work_id che soddisfano la ricerca */

    public function getWorksByParam($keyOptimized = "",$postNome = "",$postAuthors = "",$postTranslators = "",$postEditors = "",$postTitle = "",$postPublisher = "",$postJournal = "",$fromYear="",$toYear="",$postLanguage = "",$postTypology = "",$postopenAccess = "") {
        $arrWorksID = array();
        $db = new DBManager();
        $query = "SELECT distinct(works.id),title";
        $from =" FROM (works,peoples) ";
        $where ="";
        $passo = 0;

        /* Compongo la query in relazione ai parametri */
        if($keyOptimized){ 
            $from = $from.", works_keywords as WK, keywords as K ";
            $where = $where." K.id = WK.keywords_id and K.keyword REGEXP '$keyOptimized' and works.id = WK.works_id ";
            $passo = 1;
        }

        if($postTitle){
            if($passo ==1){  
                $where = $where." and title like'%".$postTitle."%' ";
            } else {
                $where = $where." title like'%".$postTitle."%' ";
                $passo = 1;
            }
            
        }

        if($fromYear){
            if($passo ==1){ 
                $where = $where." and year >= $fromYear ";
            } else {
                $where = $where." year >= $fromYear ";
                $passo = 1;
            }
        }        

        if($toYear){
            if($passo ==1){ 
                $where = $where." and year <= $toYear ";
            } else {
                $where = $where." year <= $toYear "; 
                $passo = 1;
            }    
        } 
        /* solo se nome è valorizzato ha senso che cerco in authors, translators ed editors*/
        if($postNome){

            /* Con qs query invece concateno in OR e prendo tutti i works che hanno XXX o come autore, o come traduttore o come editore

SELECT distinct(works.id),title FROM (works,peoples) 
LEFT JOIN (works_authors,works_translators,works_editors) ON 
((works_authors.peoples_id = peoples.id AND works.id = works_authors.works_id) 
 OR (works_editors.peoples_id = peoples.id AND works.id = works_editors.works_id) 
 OR (works_translators.peoples_id = peoples.id AND works.id = works_translators.works_id ))
WHERE  peoples.fullname LIKE '%fusini%'  order by works.title asc

            */
            // Con qs query invece concateno in AND quindi prendo tutti i works che hanno XXX o come autore,  traduttore e editore
            if($postAuthors){
                $from = $from." RIGHT JOIN works_authors ON (works_authors.peoples_id = peoples.id AND works.id = works_authors.works_id) "; 
            } 

            
            if($postTranslators){
                $from = $from." LEFT JOIN works_translators ON works_translators.peoples_id = peoples.id AND works.id = works_translators.works_id "; 
            }

            if($postEditors){
                $from = $from." LEFT JOIN works_editors ON works_editors.peoples_id = peoples.id AND works.id = works_editors.works_id ";
            }             

            if($passo == 1){
                $where = $where." AND peoples.fullname LIKE '%".$postNome."%' "; 
            } else {
                $where = $where." peoples.fullname LIKE '%".$postNome."%' ";  
                $passo = 1; 
            }   
        }

        if($postLanguage){
            if($passo == 1){
                $where = $where." AND original = $postLanguage ";
            } else {
                $where = $where." original = $postLanguage ";
            }
            
        }

        if($postTypology){
            $from = $from.", works_typologies AS WTP, typologies as T";
            if($passo == 1){
                $where = $where." AND WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = works.id ";
            } else {
                $where = $where." WTP.typologies_id=T.id AND T.id = $postTypology AND WTP.works_id = works.id ";
            }
        }  
        
        if($postPublisher){
            if($passo == 1){
                $where = $where." AND works.publisher_id = $postPublisher ";
            } else   {
                $where = $where." works.publisher_id = $postPublisher ";
                $passo = 1;
            }
        }   

        $query = $query.$from." WHERE ".$where." order by works.title asc";
         
        $arrWorksID = $db->queryList($query);
        return $arrWorksID;
    }  
    
    /* Dato un word_id restituisce un work */
    public function getWorksByWork_id($work_id = "") {
        $arrWorks = array();
       
        if($work_id){
            $db = new DBManager();
            $queryW = "SELECT id, title, original, year, publisher_id, city, serie_id, pages, description, isbn, libraries, image FROM works WHERE id = $work_id order by title asc";
            $arrWorks = $db->query($queryW);
        }
        
        return $arrWorks;
    }   
    
    /* Dato un array di works_id restituisce un array di works */
    public function getWorksByListOfWork_id($arrWorksID = "") {
        $arrWorks = array();
        $arrTotal = array();
       
        if($arrWorksID){
            $db = new DBManager();
            foreach ($arrWorksID as $work_id){
                
                $queryW = "SELECT id, title, original, year, publisher_id, city, serie_id, pages, description, isbn, libraries, image FROM works WHERE id = $work_id";
                $arrWorks = $db->query($queryW);

                $arrTotal[] = $arrWorks;
            }
        }

        return $arrTotal;
    }      
}
?>
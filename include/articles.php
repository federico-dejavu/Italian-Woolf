<?php
require_once('DBManager.php');

class articles{
    
    // Commento di prova 
    /* Dato un elenco di Keyword restituisce un array di articles_id */
    public function getArticlesIdByKeywords($keywords = "") {
        $arrArticlesID = array();
       
        /* Estraggo i works_id con queste KW */
        if($keywords){
            $db = new DBManager();
            $queryK = "SELECT distinct(WK.articles_id),title FROM articles_keywords as WK, keywords as K, articles as W  where K.id = WK.keywords_id and K.keyword REGEXP '$keywords' and W.id = WK.articles_id order by W.title asc";
            $arrArticlesID = $db->queryList($queryK);
        }
        
        return $arrArticlesID;
    }
    
    /* Dato un word_id restite un array di articles */
    public function getArticlesByArticles_id($id = "") {
        $arrArticles = array();
       
        if($id){
            $db = new DBManager();
            $queryW = "SELECT id, title, volume_title, journal_title, journal_issue, pubblication_date, year, publisher_id, city, serie_id, pages, price, typology_id, language, open_access, abstract, description, isbn, issn, libraries, image, doi FROM articles WHERE id = $id order by title asc";
            $arrArticles = $db->query($queryW);
        }
        
        return $arrArticles;
    }   

}
?>
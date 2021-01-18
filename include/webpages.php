<?php
require_once('DBManager.php');

class webpages{
    
      /* Dato un id restituisce un array di del contenuto della pagina */
      public function getWebpageById($id = "") {
 
        if($id=>0){
            $db = new DBManager();
            $query = "SELECT `id`, `title`, `menu_title`, `content`, `content_key`, `parent_id`, `languages_id` FROM `pages` WHERE id = $id";
            $Webpage = $db->queryList($query);
        }
        return $Webpage;
    }    
	
	/* Dato un content_key e un language_id restituisce un array di del contenuto della pagina */
	public function getWebpageByContentKeyId($content_key = "", $languages_id = "1") {
 
        if($content_key!=""){
            $db = new DBManager();
            $query = "SELECT `id`, `title`, `menu_title`, `content`, `content_key`, `parent_id`, `languages_id` FROM `pages` WHERE id = $content_key AND languages_id = $languages_id";
            $Webpage = $db->queryList($query);
        }
        return $Webpage;
    }    

}
?>
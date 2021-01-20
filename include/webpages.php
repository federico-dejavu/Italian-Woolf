<?php

require_once('include/config.php');
require_once('DBManager.php');

class webpages{
    
    /* Dato un id restituisce un array di del contenuto della pagina */
    public function getWebpageById($id = "") {
 
        if ($id) {
            $db = new DBManager();
            $query = "SELECT `id`, `title`, `menu_title`, `content`, `content_key`, `parent_id`, `languages_id` FROM `pages` WHERE id = $id";
            $Webpage = $db->query($query);
		}

        return $Webpage;

	}    
	
	/* Dato un content_key e un language_id restituisce un array di del contenuto della pagina */
	public function getWebpageByContentKeyId($content_key = "", $languages_id = "1") {
 
        if($content_key!=""){
            $db = new DBManager();
			$query = "SELECT `id`, `title`, `menu_title`, `content`, `content_key`, `parent_id`, `languages_id` FROM `pages` WHERE content_key = '$content_key' AND languages_id = $languages_id";
            $Webpage = $db->query($query);
        }

		return $Webpage;

    }    


    public function renderPage($content_key = "HOME", $languages_id = "1") {

        $page_name = strtolower($content_key);
        $filename = WOOLF_PATH.'/css/'.$page_name.'.less';
        if (!file_exists($filename)) {
            $page_name = NULL;
        }
        
        
        
        // Reperisco i contenuti ella webpage
        $pageObject = new webpages();
        $page = $pageObject->getWebpageByContentKeyId($content_key,$languages_id);
        
        echo $twig->render('webpages.html', [
            'SITE_TITLE'	=> SITE_TITLE,
            'WOOLF_URL'	    => WOOLF_URL,
            'page'			=> $page,
            'page_name' 	=> $page_name,
        ]);
    
    }
}
?>
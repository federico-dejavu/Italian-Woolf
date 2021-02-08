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

    /* Cerca i content_key per creare un menù */
    public function getMenuByParentid($parent_id = "0", $languages_id = "1") {

        $db = new DBManager();
        $query = "SELECT `id`, `title`, `menu_title`, `content`, `content_key`, `parent_id`, `languages_id` FROM `pages` WHERE `parent_id` = '$parent_id' AND `languages_id` = '$languages_id'";
        $Menu = $db->query($query);
        return $Menu;

    }

}

function renderMenu($parent_id = "0", $languages_id = "1") {

    $menuObject = new webpages();
    $menu = $menuObject->getMenuByParentid($parent_id,$languages_id);

    var_dump($menu);

}

function renderPage($content_key = "HOME", $languages_id = "1") {

    $page_name = strtolower($content_key);
    $filename = WOOLF_PATH.'/css/'.$page_name.'.less';
    if (!file_exists($filename)) {
        $page_name = NULL;
    }

    // Reperisco i contenuti ella webpage
    $pageObject = new webpages();
    $page = $pageObject->getWebpageByContentKeyId($content_key,$languages_id);
        
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
    ]);
    
    echo $twig->render('webpages.html', [
        'SITE_TITLE'	=> SITE_TITLE,
        'WOOLF_URL'	    => WOOLF_URL,
        'page'			=> $page,
        'page_name' 	=> $page_name,
    ]);

}


?>
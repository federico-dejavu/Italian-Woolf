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
			$query = "SELECT * FROM `pages` WHERE content_key = '$content_key' AND languages_id = $languages_id";
            $Webpage = $db->query($query);
        }

		return $Webpage;

    }    

    /* Cerca i content_key per creare un menù */
    public function getMenuByParentid($parent_id = "1", $languages_id = "1") {

        $menuArray = array();
        $menuTotal = array();

        $db = new DBManager();
        $queryList = "SELECT `id` FROM `pages` WHERE `parent_id` = '$parent_id' AND `languages_id` = '$languages_id'";
        $menuList = $db->queryList($queryList);
        foreach ($menuList as $menu_id){
            $query = "SELECT `id`, `menu_title`,`file_name`, `hidden`,  `content_key`, `parent_id`, `languages_id` FROM `pages` WHERE `id` = '$menu_id'";
            $menuArray = $db->query($query);
            $menuTotal[$menu_id] = $menuArray;
        }
        
        return $menuTotal;

    }

}

function checkLanguage() {

    if ((!$_COOKIE["lang"])&&($_COOKIE["lang"]=="")) {

        setcookie('lang',1,time() + (86400 * 7));
        $languages_id = 1;
    } else {
        $languages_id = $_COOKIE["lang"];
    }

    if (($_GET["lang"])&&($_GET["lang"]!="")) {
        
        setcookie('lang',$_GET['lang'],time() + (86400 * 7));
        $languages_id = $_GET["lang"];
        
    }
     include_once('templates/lang/lang'.$languages_id.'.php');
    return $languages_id;

}

function renderMenu($parent_id = "1", $languages_id = "1") {

    $menuObject = new webpages();
    $menu = $menuObject->getMenuByParentid($parent_id,$languages_id);

}

function renderPage($content_key = "HOME") {
   
    $languages_id = checkLanguage();
    $renderTarget = 'webpages.html';
    $phpPage = array();

    // Reperisco i contenuti ella webpage
    $pageObject = new webpages();
    $page = $pageObject->getWebpageByContentKeyId($content_key,$languages_id);

    if ($page["type"] == "php") {

        $renderTarget = $page['file_name'].'.html';
        include_once('webpages/'.$page['file_name'].'.php');

    }

/*
    ["id"]
    ["title"]
    ["menu_title"]
    ["file_name"]
    ["hidden"]
    ["type"]
    ["content"]
    ["content_key"]
    ["parent_id"]
    ["languages_id"]
*/

    $file_name = WOOLF_PATH.'/css/'.$page['file_name'].'.less';
    if (!file_exists($filename)) {
        $file_name = NULL;
    }

    $menuObject = new webpages();
    $menu = $menuObject->getMenuByParentid($page["parent_id"],$languages_id);
 
    

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
        'cache' => false,
    ]);
    var_dump($language);  
    echo $twig->render($renderTarget, [
        'SITE_TITLE'	=> SITE_TITLE,
        'WOOLF_URL'	    => WOOLF_URL,
        'menus'         => $menu,
        'page'			=> $page,
        'page_name' 	=> $page_name,
        'file_name'     => $file_name,
        'phpPage'       => $phpPage,
        'LANG'          => $language,
    ]);

}


?>
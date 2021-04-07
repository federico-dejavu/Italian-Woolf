<?php

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
    return $languages_id;

}

function renderMenu($parent_id = "1", $languages_id = "1") {

    $menuObject = new webpages();
    $menu = $menuObject->getMenuByParentid($parent_id,$languages_id);

}

/* Rende gli args della pagina attuale */
function renderPageArgs() {

	$args = '';

	foreach ($_REQUEST as $key => $value) {

		$args .= ($key != 'lang') ? $key.'='.$value.'&' : '';

	}

	return $args;

}

function renderPage($content_key = "HOME") {
   
    $languages_id = checkLanguage();
    $renderTarget = 'webpages.html';
    $phpPage = array();

    // Reperisco i contenuti ella webpage
    $pageObject = new webpages();
    $page = $pageObject->getWebpageByContentKeyId($content_key,$languages_id);
    $args = $pageObject->renderPageArgs();

    if ($page["type"] == "php") {

        $renderTarget = $page['file_name'].'.html';
        include_once('webpages/'.$page['file_name'].'.php');
        switch($page['file_name']) {
            case 'work';
                $page['title'] = $phpPage['work']['title'];
                break;
            case 'edition';
                $page['title'] = $phpPage['edition']['title'];
                break;
            case 'article';
                $page['title'] = $phpPage['article']['title'];
                break;
            case 'people';
                $page['title'] = $phpPage['people']['fullname'];
                break;
            case 'publisher';
                $page['title'] = $phpPage['publisher']['publisher'];
                break;
        }

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
 
    include_once('templates/lang/lang'.$languages_id.'.php');

    echo $twig->render($renderTarget, [
        'SITE_TITLE'	=> SITE_TITLE,
        'WOOLF_URL'	    => WOOLF_URL,
        'menus'         => $menu,
        'page'			=> $page,
        'args'          => $args,
        'page_name' 	=> $page_name,
        'file_name'     => $file_name,
        'phpPage'       => $phpPage,
        'LANG'          => $language,
    ]);

}


?>
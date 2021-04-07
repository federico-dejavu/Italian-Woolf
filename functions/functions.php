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

}

/* Rende gli args della pagina attuale */
function renderPageArgs() {

	$args = '';

	foreach ($_REQUEST as $key => $value) {

		$args .= ($key != 'lang') ? $key.'='.$value.'&' : '';

	}

	return $args;

}




?>
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




?>
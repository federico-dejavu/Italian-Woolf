<?php 
	require_once 'include/config.php';
	include_once('include/webpages.php'); 
	$page_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',basename($_SERVER['PHP_SELF']));
	include_once('include/head.php'); 	
	include_once('include/header.php'); 

    // Reperisco i contenuti ella webpage
    $pageObject = new webpages();
    $page = $pageObject->getWebpageByContentKeyId("HOME");
    var_dump($page);



	echo $twig->render('home.html');

	include_once('include/footer.php'); 

?>
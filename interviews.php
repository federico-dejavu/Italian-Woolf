<?php 
	require_once 'include/config.php';
	include_once('include/webpages.php'); 
	
	$page_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',basename($_SERVER['PHP_SELF']));
	$filename = WOOLF_PATH.'/css/'.$page_name.'.less';
	if (!file_exists($filename)) {
		$page_name = NULL;
	}
	
	
	
    // Reperisco i contenuti ella webpage
    $pageObject = new webpages();
    $page = $pageObject->getWebpageByContentKeyId('INTERVIEWS','1');
	
	echo $twig->render('head.html', [
		'SITE_TITLE'	=> SITE_TITLE,
		'page'			=> $page,
		'page_name' 	=> $page_name,
	]);

	echo $twig->render('header.html', [
		'WOOLF_URL'	=> WOOLF_URL,
	]);

	echo $twig->render('interviews.html', [
		'page'		=> $page,
    ]);

	include_once('include/footer.php'); 

?>
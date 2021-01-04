<?php 
	require_once 'include/config.php';
	$page_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',basename($_SERVER['PHP_SELF']));
	include_once('include/head.php'); 	
	include_once('include/header.php'); 

	echo $twig->render('result/search.html');

	include_once('include/footer.php'); 
	
?>
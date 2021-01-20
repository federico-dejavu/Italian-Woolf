<?php 
	include_once('include/webpages.php'); 
		
	$pageObject = new webpages();
	$pageRendered = $pageObject->renderPage('HOME','2');

?>
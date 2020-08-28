<?php 
	$page_name = basename($_SERVER['PHP_SELF']);
	include_once('include/head.php'); 	
?>
<body>
<?php include_once('include/header.php'); ?>
     <div id="research">
	    <div class="container">
			<div class="row">
				<div class="col">
					<h2>Research</h2>
				</div>
			</div>
			<form id="search">
				<div class="row align-items-center">
					<div class="col">
						<input type="text" 		name="keywords" id="keywords" />
						<input id="works"  		name="works"  	type="checkbox" checked/><label for="works">Works</label>
						<input id="articles" 	name="articles"	type="checkbox" checked/><label for="articles">Articles</label>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col">
						<input type="button" value="Search" id="submit" onClick="ajaxSearch('searchKeywords');" /> or <a href="advancedSearch.html" >Advanced search</a>
					</div>
				</div>
			</form>
		</div>
    </div>
    <div id="result">
    </div>
</body>
</html>
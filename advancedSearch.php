<?php include_once('include/head.php'); ?>
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
						<input type="text" 	placeholder="Keywords" 	name="keywords" id="keywords" />
						<input id="works"  		name="works"  	type="checkbox" checked/><label for="works">Works</label>
						<input id="articles" 	name="articles"	type="checkbox" checked/><label for="articles">Articles</label>
					</div>
				</div>
				<div class="row align-items-center">
				
					<div class="col">
						<input type="text" 	placeholder="nome" 	name="nome" id="nome" />
						<input id="authors"   name="authors"   type="checkbox" value="1" checked/><label for="authors">Autori</label>
						<input id="translators" name="translators" type="checkbox" value="1" checked/><label for="translators">Traduttori</label>
						<input id="editors"   name="editors" type="checkbox" value="1" checked/><label for="editors">Editors</label>
					</div>
				</div>
				<div class="row align-items-center">

					<div class="col">
						<input type="text" placeholder="Title"		name="title" id="title" />
					</div>
				</div>	

				<div class="row align-items-center">
				
					<div class="col">
						<input type="text" placeholder="Publisher" name="publisher" id="publisher"/>
					</div>

					<div class="col">
						<input type="text" placeholder="Journal"	name="journal" id="journal" />
					</div>
				</div>		
				
				<div class="row align-items-center">
				
					<div class="col">
						<input type="text" placeholder="1901" name="fromYear" id="fromYear"/>
					</div>

					<div class="col">
						<input type="text" placeholder="1956"	name="toYear" id="toYear" />
					</div>
				</div>					

				<div class="row align-items-center">

					<div class="col">
						<input type="text" placeholder="EN"	name="language" id="language" />
					</div>

					
					<div class="col">
						<input type="text" placeholder="Novel"	name="typology" id="typology" />
					</div>					
				</div>	
				
				
				<div class="row align-items-center">
					<div class="col">
						<input type="text" placeholder="openAccess"	name="openAccess" id="openAccess" />
					</div>					
				</div>					

				<div class="row align-items-center">
					<div class="col">
						<input type="button" value="Search" onClick="ajaxSearch('searchExtended');" id="submit" /> 
					</div>
				</div>
			</form>
		</div>
    </div>
    <div id="result">
    </div>
</body>
</html>
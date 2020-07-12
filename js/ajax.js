$(document).ready(function(){
		
	var baseUrl = 'https://italianwoolf.reading.ac.uk/stage/';

	$('#submit').click(function() {

		$.ajax({
			type: "POST",
			url: baseUrl + 'ajax/searchKeywords.php',
			async: false,
			data: $("#search").serialize(),
			success: function(html) {
				$('#result').html(html);;
			}

		})		

	});

});
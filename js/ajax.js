$(document).ready(function(){
		
	var baseUrl = 'https://italianwoolf.reading.ac.uk/stage/';

	function search(action) {

		$.ajax({
			type: "POST",
			url: baseUrl + 'ajax/' + action + '.php',
			async: false,
			data: $("#search").serialize(),
			success: function(html) {
				$('#result').html(html);;
			}

		})		

	}

});
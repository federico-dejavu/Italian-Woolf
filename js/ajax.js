$(document).ready(function(){
		

});


function ajaxSearch(action) {

	var baseUrl = 'https://italianwoolf.reading.ac.uk/stage/';

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

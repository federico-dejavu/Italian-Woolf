$(document).ready(function(){

	$("#menu-icon").on("click", function() {
		$(this).toggleClass("change");
		$("#mobile").toggleClass("open");
		return false;
	});
	
 
	$('a[href^="#"]').on('click', function (e) {
		e.preventDefault();
		$(document).off("scroll");

		$("#menu-icon").each(function () {
			$("#menu-icon").removeClass("change");
			$("#mobile").removeClass("open");
		})
	});
});


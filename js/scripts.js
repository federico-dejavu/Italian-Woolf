$(document).ready(function(){

	$("#menu-icon").on("click", function() {
		$(this).toggleClass("change");
		$("#main-nav").toggleClass("open");
		return false;
	});
	
 
	$('a[href^="#"]').on('click', function (e) {
		e.preventDefault();
		$(document).off("scroll");

		$('a').each(function () {
			$(this).removeClass('active');
			$("#menu-icon").removeClass("change");
			$("#main-nav").removeClass("open");
		})
		$(this).addClass('active');
	});
});


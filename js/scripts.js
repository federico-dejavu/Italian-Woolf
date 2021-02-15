$(document).ready(function(){

	$("#menu-icon").on("click", function() {
		$(this).toggleClass("change");
		$("#mobile").toggleClass("open");
		return false;
	});
	
 
	$('a[href^="#"]').on('click', function (e) {
		e.preventDefault();
		$(document).off("scroll");

		$('a').each(function () {
			$(this).removeClass('active');
			$("#menu-icon").removeClass("change");
			$("#mobile").removeClass("open");
		})
		$(this).addClass('active');
	});
});


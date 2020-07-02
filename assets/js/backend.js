(function($){
	$(document).ready(function() {
		$(".field-media-input").removeAttr("readonly");
	});
	$(document).on("subform-row-add", function(event, row){
		$(".field-media-input").removeAttr("readonly");
	});
})(jQuery);
jQuery(document).ready(function($) {
	
	$( 'tr' ).click(function() {
		var row=$(this).data('row');
		$( ".details.vr51-lpd-" + row ).toggleClass('show');
		$( ".details.vr51-lpd-" + row ).draggable({stack: ".details"});
		$( ".details.vr51-lpd-" + row ).css({"top":"", "left":""});
	});
	
	$( 'tr' ).hover(function() {
		var row=$(this).data('row');
		$( ".details.vr51-lpd-" + row ).toggleClass('highlight');
	});
	
	$( function() {
		var row=$(this).data('row');
		$( ".details.vr51-lpd-" + row ).resizable();
	} );
	
});
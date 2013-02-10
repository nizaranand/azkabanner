jQuery(document).ready(function($){
	$(".eject").click(function(){
		var damned = $(this).attr('id');
		jQuery.post(			
			MyAjax.ajaxurl,
			{				
				action : 'dementor',
				postID : damned
			},
			function( response ) {
				console.log( response );
			}
		);
	});
	$('#sims').accordion( { heightStyle: "content" });
});
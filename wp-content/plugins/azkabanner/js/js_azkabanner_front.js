jQuery(document).ready(function($){
	$(".eject").click(function(){
		var damned = $(this).attr('id');
		var uuid = $(this).parents('div').attr('name');
		var action = $(this).attr('class');
		
		jQuery.post(			
			MyAjax.ajaxurl,
			{				
				action : 'dementor',
				postID : action+":"+damned+":"+uuid
			},
			function( response ) {
				//console.log( response );//debugging purposes only
			}
		);
	});
	$('#sims').accordion( { heightStyle: "content" });
});
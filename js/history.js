$(document).ready(function() {
    
	var userId = 0;	
	if($("li#user-id").length > 0){
		var userId = $("li#user-id").attr('data-user-id');
	}
	
	

		var request = $.ajax({
			url: "historyDb.php",
			type: "POST",
			data: {userId : userId},
			dataType: "html"
		});

		request.done(function(msg) {
			$('#historyTab').html(msg);
		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	
});

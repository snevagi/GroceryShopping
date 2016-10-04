/* Update cart */
$(document).ready(function() {
    $(document).on("click",".cart", function(e) {
	e.preventDefault();
	
	var userId = 0;	
	if($("li#user-id").length > 0){
		var userId = $("li#user-id").attr('data-user-id');
	}
	else{
		alert("Please Sign In.");
		exit();
	}
	
	var itemId = $(this).attr('id');

		var request = $.ajax({
			url: "cartDb.php",
			type: "POST",
			data: {itemId : itemId, userId : userId},
			dataType: "html"
		});

		request.done(function(msg) {
			if(!msg.localeCompare("error")){
				alert("Sorry! we are out of stock of this Item");
				exit();
			}
			$('#updateCart').html(msg);
		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	
    });
});

/* Load cart on refresh */
$( window ).load(function() {
	var userId = 0;
	if($("li#user-id").length > 0){
		 userId = $("li#user-id").attr('data-user-id');
	}
		
	var request = $.ajax({
			url: "displayCart.php",
			type: "POST",
			data: {userId : userId},
			dataType: "html"
		});

		request.done(function(msg) {
			$('#updateCart').html(msg);
		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	
});

/* Checkout items */
$(document).ready(function() {
    $(document).on("click",".checkout", function(e) {
	e.preventDefault();
	var userId = 0;
	if($("li#user-id").length > 0){
		var userId = $("li#user-id").attr('data-user-id');
	}
	else{
		alert("Please Sign In.");
		exit();
	}
	

		var request = $.ajax({
			url: "checkout.php",
			type: "POST",
			data: {userId : userId},
			dataType: "html"
		});

		request.done(function(msg) {
			alert(msg);	
			window.location.href = "order-history.php";

		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	
    });
});

/* Plus items */
$(document).ready(function() {
    $(document).on("click",".glyphicon-plus-sign", function(e) {
	e.preventDefault();
	var arr = [];
	var i = 0;
	var currentTD = $(this).parents('tr').find('td');
	
			  $.each(currentTD, function () {
                  arr[i] = $(this).text().trim();
				  i = i +1;
              });
		
	var itemName = arr[0];
	var qty = parseInt(arr[1]);
	var price = parseFloat(arr[2]);
	var pricePerItem = price / qty;
	var ops ="plus";
		
	var qty = qty + 1;	
	var price = pricePerItem * qty ; 
	
	var userId = 0;
	if($("li#user-id").length > 0){
		var userId = $("li#user-id").attr('data-user-id');
	}
	else{
		alert("Please sign in ....");
		exit();
	}
	

		var request = $.ajax({
			url: "updateCart.php",
			type: "POST",
			data: {userId : userId, itemName : itemName,qty : qty,price : price,ops:ops},
			dataType: "html"
		});

		request.done(function(msg) {
			if(!msg.localeCompare("error")){
				alert("Sorry! we are out of stock of this Item");
				exit();
			}
			$('#updateCart').html(msg);

		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	
    });
});

/* Minus items */
$(document).ready(function() {
    $(document).on("click",".glyphicon-minus-sign", function(e) {
	e.preventDefault();
	var arr = [];
	var i = 0;
	var currentTD = $(this).parents('tr').find('td');
	
			  $.each(currentTD, function () {
                  arr[i] = $(this).text().trim();
				  i = i +1;
              });
		
	var itemName = arr[0];
	var qty = parseInt(arr[1]);
	var price = parseFloat(arr[2]);
	var pricePerItem = price / qty;
	
	var qty = qty - 1;	
	var price = pricePerItem * qty ; 
	var ops ="minus";
	
	var userId = 0;
	
	if($("li#user-id").length > 0){
		var userId = $("li#user-id").attr('data-user-id');
	}
	else{
		alert("Please sign In");
		exit();
	}
	

		var request = $.ajax({
			url: "updateCart.php",
			type: "POST",
			data: {userId : userId, itemName : itemName,qty : qty,price : price,ops:ops},
			dataType: "html"
		});

		request.done(function(msg) {
			$('#updateCart').html(msg);

		});

		request.fail(function(jqXHR, textStatus) {
			alert( "Request failed: " + textStatus );
		});
	
    });
});

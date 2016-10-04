$(function(){
    "use strict";
    $(document).on('click','a.edit',function(e){
	e.preventDefault();
	var prodBox = $(this).closest('div.prod_box');
	var itemName = $(prodBox).find('div.product_title');
	var price = $(prodBox).find('span.price');
	var category = $(prodBox).find('span.category');
	var itemQty = $(prodBox).find('span.itemQty');
	itemName.attr('contenteditable',true);
	price.attr('contenteditable',true);
	category.attr('contenteditable',true);
	itemQty.attr('contenteditable',true);
	$(this).addClass('hidden');
	prodBox.find('a.save').removeClass('hidden');
    });
    $(document).on('click','a.save',function(e){
	e.preventDefault();
	var prodBox = $(this).closest('div.prod_box');
	var itemName = $(prodBox).find('div.product_title');
	var price = $(prodBox).find('span.price');
	var category = $(prodBox).find('span.category');
	var itemQty = $(prodBox).find('span.itemQty');
	itemName.attr('contenteditable',false);
	price.attr('contenteditable',false);
	category.attr('contenteditable',false);
	itemQty.attr('contenteditable',false);
	var itemId = prodBox.attr('data-item-id');
	var itemNameTxt = itemName.text().trim();
	var priceTxt = price.text().trim();
	var categoryTxt = category.text().trim();
	var itemQtyTxt = itemQty.text().trim();
	$(this).addClass('hidden');
	var xhr = $.post('updateItems.php',
			 {
			     ops: 'save',
			     itemId: itemId,
			     itemName: itemNameTxt,
			     price: priceTxt,
			     category: categoryTxt,
			     itemQty: itemQtyTxt
			 }
	);
	xhr.fail(function(){
	    location.reload();
	});
	
	prodBox.find('a.edit').removeClass('hidden');
    });
    $(document).on('click','a.delete',function(e){
	e.preventDefault();
	
	var result = confirm("Are you sure, you want to delete this item?");
	if (!result) {
		exit();
	}
	
	var prodBox = $(this).closest('div.prod_box');
	var itemId = prodBox.attr('data-item-id');
	var xhr = $.post('updateItems.php',
			 {
			     ops: 'delete',
			     itemId: itemId
			 });
	xhr.done(function(){
	    prodBox.closest('div.item').hide();
	});
	xhr.fail(function(){
	    location.reload();
	});
    });    
});

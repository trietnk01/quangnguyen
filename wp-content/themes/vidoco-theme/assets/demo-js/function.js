function contactNow(ctrl) {
	var frm=jQuery(ctrl).closest('form');
	var fullname=jQuery(frm).find('input[name="fullname"]').val();
	var phone=jQuery(frm).find('input[name="phone"]').val();
	var email=jQuery(frm).find('input[name="email"]').val();	
	var title=jQuery(frm).find('input[name="title"]').val();
	var message=jQuery(frm).find('textarea[name="message"]').val();		
	var data_item={
		"action"    : "insert_contact",
		"fullname"     : fullname,                    
		"phone"     : phone,                    
		"email"     : email,                    
		"title"     : title,                    
		"message"     : message		
	}	
	jQuery.ajax({
		url         : ajaxurl,
		type        : "POST",
		data 		: data_item,
		dataType 	: "json", 		
		success     : function(data, status, jsXHR){				
			jQuery('.note').empty();
			jQuery('.note').removeClass('note-success');
			jQuery('.note').removeClass('note-danger');
			if(parseInt(data.checked)  == 1){
				jQuery(frm).find('input').val('');
				jQuery(frm).find('textarea').val('');
				jQuery('.note').addClass('note-success');				
			}else{
				jQuery('.note').addClass('note-danger');
			}	
			var data_msg=data.msg;			
			jQuery.each(data_msg,function(index,val){
				jQuery('.note').append('<div>'+val+'</div>');				
			});			
			setTimeout(function(){ jQuery('.note').fadeOut(); }, 60000);			
			jQuery('.note').fadeIn();			
			jQuery('.ajax_loader_2').hide();
		},
		beforeSend  : function(jqXHR,setting){
			jQuery('.ajax_loader_2').show();
		},
	});
}
function registerSubcriber(ctrl) {	
	var frm=jQuery(ctrl).closest('form');
	var email=jQuery(frm).find('input[name="email"]').val();		
	var data_item={
		"action"    : "insert_subcriber",		
		"email"     : email,                    		
	}	
	jQuery.ajax({
		url         : ajaxurl,
		type        : "POST",
		data 		: data_item,
		dataType 	: "json", 		
		success     : function(data, status, jsXHR){				
			jQuery('.note').empty();
			jQuery('.note').removeClass('note-success');
			jQuery('.note').removeClass('note-danger');
			if(parseInt(data.checked)  == 1){
				jQuery(frm).find('input').val('');				
				jQuery('.note').addClass('note-success');				
			}else{
				jQuery('.note').addClass('note-danger');
			}	
			var data_msg=data.msg;			
			jQuery.each(data_msg,function(index,val){
				jQuery('.note').append('<div>'+val+'</div>');				
			});			
			setTimeout(function(){ jQuery('.note').fadeOut(); }, 60000);			
			jQuery('.note').fadeIn();			
			jQuery('.ajax_loader_1').hide();
		},
		beforeSend  : function(jqXHR,setting){
			jQuery('.ajax_loader_1').show();
		},
	});
}

$(function(){
	$('#frmCreateAccount').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var $remarks = $('#frmCreateAccount #remarks'); 
        var $close = $('#btnClose');
        
        UserAccount.createAccount(data).done(function(result){
            if(!result.status){
            	$remarks.html(result.message.errorMsg());	

            }else{
            	$remarks.html(result.message.successMsg());		
            }
            
     		setTimeout(function(){$close.click();$remarks.html('');$('#frmCreateAccount').clearInput();},2000);	
        });
 	});
});
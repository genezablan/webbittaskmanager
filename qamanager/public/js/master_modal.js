
$(function(){
    $(".js-example-basic-multiple").select2();
 
	$('#frmCreateTeam').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var $remarks = $('#frmCreateTeam #remarks'); 
        var $close = $('#btnClose');
        
        Team.createTeam(data).done(function(result){
            if(!result.status){
            	$remarks.html(result.message.errorMsg());	
            }else{
            	$remarks.html(result.message.successMsg());		
            }
        
     		setTimeout(function(){
                $close.click();$remarks.html('');
                $('#frmCreateTeam').clearInput();
                //window.location.replace(URL + 'team/view/'+result.data.name+'/'+result.data.id);
            },1000);	
        });
 	});

    $('#frmCreateProject').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var $remarks = $('#frmCreateProject #remarks'); 
        var $close = $('#btnCloseCreateProject');
        
        Projects.createProject(data).done(function(result){
            if(!result.status){
                $remarks.html(result.message.errorMsg());   
            }else{
                $remarks.html(result.message.successMsg());     
            }
        
            setTimeout(function(){
                $close.click();
                $remarks.html('');
                $('#frmCreateProject').clearInput();
                //window.location.replace(URL + 'team/view/'+result.data.name+'/'+result.data.id);
            },2000);    
        });
    });

 

});
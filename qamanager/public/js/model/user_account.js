
var UserAccount = {
		createAccount : function(serialized_data){
			return $.ajax({
				url: URL + 'ajax/createAccount',
				type: 'post',
				dataType: 'json',
				data: serialized_data
			});
		}
};
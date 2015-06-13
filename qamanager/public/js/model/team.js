
var Team = {
		createTeam : function(serialized_data){
			return $.ajax({
				url: URL + 'ajax/createTeam',
				type: 'post',
				dataType: 'json',
				data: serialized_data
			});
		}
};
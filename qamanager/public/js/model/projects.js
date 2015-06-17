
var Projects = {
		createProject : function(serialized_data){
			return $.ajax({
				url: URL + 'ajax/createProject',
				type: 'post',
				dataType: 'json',
				data: serialized_data
			});
		}
};
String.prototype.errorMsg = function() {
	return '<div class="alert alert-danger">'+ this +'</div>';
};
String.prototype.successMsg = function() {
	return '<div class="alert alert-success">'+ this +'</div>';
};


$.fn.extend({
	clearInput: function(){
		$(this).find("input[type=text], textarea").val("");
	}
})
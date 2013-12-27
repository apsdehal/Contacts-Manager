App.Models.Contact = Backbone.Model.extend({
	validate: function(attrs){
		if(!attrs.first_name || !attrs.last_name){
				return 'First Name and Last Name are required';
		}

		if(!attrs.email_address){
			return 'Email address is neccessary';
		}
	}
})
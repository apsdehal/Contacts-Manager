/*=======================================
=            Global App View            =
=======================================*/

App.Views.App = Backbone.View.extend({
	initialize: function(){
		vent.on('contact:edit',this.editContact, this);
		var addContactView = new App.Views.AddContact( {collection: App.contacts});
		var allContactsView = new App.Views.Contacts( {collection: App.contacts} ).render();
		$("#allContacts").append(allContactsView.el);
	},

	editContact: function( contact ){

		var editContactView = new App.Views.editContactView({ model: contact});

		$('#editContactDiv').html(editContactView.el);
	}

});

/*-----  End of Global App View  ------*/

/*========================================
=            Add Contact View            =
========================================*/

App.Views.AddContact = Backbone.View.extend({
	el:'#addContact',

	initialize: function(){
		this.first_name = $("#first_name");
		this.last_name = $("#last_name");
		this.email_address = $("#email_address");
		this.description = $("#description");
	},

	events: {
		'submit':'addContact'
	},

	addContact: function(e){
		e.preventDefault();

		this.collection.create({
			first_name: this.first_name.val(),
			last_name: this.last_name.val(),
			email_address: this.email_address.val(),
			description: this.description.val()
		}, {wait:true});

		this.clearForm();
	},

	clearForm: function(){
		this.first_name.val('');
		this.last_name.val('');
		this.email_address.val('');
		this.description.val('');
	}
});


/*-----  End of Add Contact View  ------*/

/*=========================================
=            All Contacts View            =
=========================================*/
App.Views.Contacts = Backbone.View.extend({
	tagName: 'tbody',

	initialize: function () {
		this.collection.on('add', this.addOne, this);
	},

	render: function(){
		this.collection.each(this.addOne, this);
		return this;
	},

	addOne: function(contact){
		var contactView = new App.Views.Contact({ model:contact });
		this.$el.append(contactView.render().el);
	}
});


/*-----  End of All Contacts View  ------*/

/*===========================================
=            Single Contact View            =
===========================================*/
App.Views.Contact = Backbone.View.extend({
	tagName: 'tr',

	initialize: function () {
		this.model.on('destroy', this.unrender, this);
		this.model.on('change', this.render, this);
	},

	unrender: function  () {

		this.remove(); //Shortcut for this.$el.remove()

	},

	template: template('allContactsTemplate'),

	events: {
		'click a.delete': 'deleteContact',
		'click a.edit': 'editContact'
	},

	editContact: function(){
		vent.trigger('contact:edit', this.model);

	},

	deleteContact: function(){
		this.model.destroy();
	},
	render: function(){
		this.$el.html(this.template(this.model.toJSON()));
		return this;
	}
})



/*-----  End of Single Contact View  ------*/
/*=========================================
=            Edit Contact View            =
=========================================*/

App.Views.editContactView = Backbone.View.extend({
	template: template('editContactTemplate'),

	events:{
		'submit form': 'submit',
		'click button.cancel': 'cancel'
	},

	cancel: function(){
		this.remove();
	},

	submit: function(e){

		e.preventDefault();

		this.model.save({
			'first_name': this.first_name.val(),
			'last_name': this.last_name.val(),
			'email_address': this.email_address.val(),
			'description': this.description.val(),
		});

		this.remove();

	},
	initialize: function(){
		this.render();

		this.form = this.$('form');
		this.first_name = this.form.find('#edit_first_name');
		this.last_name = this.form.find('#edit_last_name');
		this.email_address = this.form.find('#edit_email_address');
		this.description = this.form.find('#edit_description');
	},

	render:function(){

		var html = this.template(this.model.toJSON());

		this.$el.html(html);
	}
})


/*-----  End of Edit Contact View  ------*/





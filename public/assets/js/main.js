(function () {


window.App = {
	Models: {},
	Collections: {},
	Views: {},
	Router: {}
};

window.vent = _.extend({}, Backbone.Events);

window.template = function(id){
	return _.template( $('#'+id).html() );
};

App.Models.Task = Backbone.Model.extend({
	defaults:{
		title:'',
		completed: 0,
		id: ''
	},
	urlRoot: 'index.php/tasks'
});
})();
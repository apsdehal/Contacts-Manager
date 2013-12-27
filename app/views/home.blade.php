<!DOCTYPE html>
<html>
<head>
	<title>Contact Manager</title>
	<style type="text/css">
	table thead td {
		font-weight: bold;
		}
	#addContact{
		margin-bottom: 2em;
	}
	</style>
</head>
<body>

<h1>Contacts</h1>

{{ Form::open(array('id'=>'addContact')) }}

{{ Form::label('first_name', 'First Name:')}}
{{ Form::text('first_name') }}

{{ Form::label('last_name', 'Last Name:')}}
{{ Form::text('last_name') }}

{{ Form::label('email_address', 'Email Address:')}}
{{ Form::text('email_address') }}

{{ '<br/>' }}

{{ Form::label('description','Description') }}
{{ Form::textarea('description',null,array('rows'=>3,'cols'=>25)) }}

{{ Form::submit('Add New')}}

{{ Form::close() }}

<table id="allContacts">
	<thead>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Email Address</td>
			<td>Description</td>
		</tr>
	</thead>

</table>
<script id="allContactsTemplate" type="text/template">
	<td><%= first_name %></td>
	<td><%= last_name %></td>
	<td><%= email_address %></td>
	<td><%= description %></td>
</script>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/underscore.js"></script>
<script src="assets/js/backbone.js"></script>

<script src="assets/js/main.js"></script>
<script src="assets/js/models.js"></script>
<script src="assets/js/collections.js"></script>
<script src="assets/js/views.js"></script>
<script src="assets/js/router.js"></script>

<script>
	new App.Router;
	Backbone.history.start();

	App.contacts = new App.Collections.Contacts;

	App.contacts.fetch().then( function(){
		new App.Views.App({ collection: App.contacts });
	})
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Contact Manager</title>
	<style type="text/css">
	table thead td {
		font-weight: bold;
		}
	.module{
		margin-bottom: 2em;
	}
	</style>
</head>
<body>

<h1>Contacts</h1>

{{ Form::open(array('id'=>'addContact', 'class'=>'module')) }}

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
			<td>Config</td>
		</tr>
	</thead>

</table>

<div id="editContactDiv">

</div>
<script id="allContactsTemplate" type="text/template">
	<td><%= first_name %></td>
	<td><%= last_name %></td>
	<td><%= email_address %></td>
	<td><%= description %></td>
	<td><a href="#contacts/edit" class="edit">Edit</a></td>
	<td><a href="#contacts" class="delete">Delete</a></td>
</script>
<script id="editContactTemplate" type="text/template">
<h2>Edit Contact: <%= first_name %> <%= last_name %> </h2>
	<form id="editContact" class="module">
		<div>
			<label for="edit_first_name">First Name: </label>
			<input type="text" id="edit_first_name" name="edit_first_name" value="<%= first_name %>">
		</div>

		<div>
			<label for="edit_last_name">Last Name: </label>
			<input type="text" id="edit_last_name" name="edit_last_name" value="<%= last_name %>">
		</div>

		<div>
			<label for="edit_email_address">Email Address:</label>
			<input type="text" id="edit_email_address" name="edit_email_address" value="<%= email_address %>">
		</div>
		<div>
			<label for="edit_description">Description:</label>
			<textarea id="edit_description" name="edit_description"><%= description %></textarea>
		</div>
		<div>
			<input type="submit" value="Save">
			<button type="button" class="cancel">Cancel</button>
		</div>
	</form>
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
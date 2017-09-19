<div class="panel-body">
	<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th></th>
		</tr>
		<tr ng-repeat="user in $root.usersacc">
			<td ng-bind="user.name"></td>
			<td ng-bind="user.email"></td>
			<td><a ng-click="inside.remove(user)"><span class="glyphicon glyphicon-remove"></span></a>
				<a ng-click="inside.edit(user)"><span class="glyphicon glyphicon-edit"></span></a>	
			</td>
		</tr>
	</table>
</div>
<!-- Admin Home Page -->
@extends('layouts.app')
@section('right_drop_menu')
<a href="/">Home</a>
@endsection

@section('burger_menu')
<div id="sidebar" ng-controller="Left_Admin_Menu_Controller as inside">
	<div class="toggle-btn" ng-click="$parent.toggleSideBar()">
		<span></span>
		<span></span>
		<span></span>
	</div>
	<ul id="subMenu">
		<li><span class="glyphicon glyphicon-home"></span>	  <a href="/">Home</a></li>
		<li ng-click="inside.ctrMenu('user_account')"><span class="glyphicon glyphicon-user"></span>    Users</li>
		<li ng-click="inside.ctrMenu('tasks')"><span class="glyphicon glyphicon-tasks"></span>    Task</li>
	</ul>
</div>
@endsection

@section('content')
<div class="container" ng-controller="AdminController">
    <div class="row">
    	<div ng-if="$root.menu == 'user_account'" ng-include="'../views/admin/userAccount.html'" ></div>
    	<div ng-if="$root.menu == 'tasks'" ng-include="'../views/admin/tasks2.html'" ></div>
    </div>
</div>
@endsection
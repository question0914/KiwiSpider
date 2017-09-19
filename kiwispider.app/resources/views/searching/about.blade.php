@extends('layouts.app')
@section('burger_menu')
    <div id="sidebar" ng-controller="Left_User_Menu_Controller as inside">
        <div class="toggle-btn" ng-click="$parent.toggleSideBar()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul id="subMenu">
            <li><span class="glyphicon glyphicon-home"></span>    <a href="/">Home</a></li>
            <li ng-click="inside.ctrMenu('your_account')"><span class="glyphicon glyphicon-user"></span>    Your Account</li>
            <li ng-click="inside.ctrMenu('your_tasks')"><span class="glyphicon glyphicon-tasks"></span> Your Task</li>
            <li ng-click="inside.ctrMenu('create_tasks')"><span class="glyphicon glyphicon-tasks"></span> Create Task</li>
        </ul>
    </div>

@endsection
@section('content')
    <div ng-show="$root.crawler_home" class="content">
    <pre>
    The default account :
    -----------------------------------------
    username | password | internal company
    -----------------------------------------
    ryan     | 123      | beverly hills chairs
    ------------------------------------------
    caitlin  | 123      | custom tobacco
    ------------------------------------------
    </pre>
    </div>
    <div class="container" ng-controller="UserController">
        <div class="row">
            <div ng-if="$root.menu2 == 'your_account'" ng-include="'../views/user/your_account.html'" ></div>
            <div ng-if="$root.menu2 == 'your_tasks'" ng-include="'../views/user/your_tasks2.html'" ></div>
            <div ng-if="$root.menu2 == 'create_tasks'" ng-include="'../views/user/create_tasks2.html'" ></div>
        </div>
    </div>
@endsection
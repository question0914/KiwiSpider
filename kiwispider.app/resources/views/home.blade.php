<!-- User Home Page -->
@extends('layouts.app')
@section('right_drop_menu')
<a href="/">Home</a>
@endsection

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
        <div class="title m-b-md" style="margin-top: 100px; font-weight: 100; color:green">
            <div class="logo"></div>
            Find <img style="margin-top: -60px" src="http://kiwispider.com/logo.png" alt="logo" height="100px"/>Email
        </div>
        <div class="links">
            <a href="/about">About</a>
        </div><br><br><br>
        <div>
            <form action="/beginSearch" method="get">
                <div id="mainselection">
                    <select name="internalCompany" class="wrapper-dropdown-3" required>
                        <option value="">---Select Internal Company---</option>
                        <option value="0">Custom Tobacco</option>
                        <option value="1">Beverly Hills Chairs</option>
                    </select><br><br><br>
                </div>

                <button type="submit" class="btn btn-success">Begin Search</button>

            </form>
        </div>
    </div>

<div class="container" ng-controller="UserController">
    <div class="row">
        <div ng-if="$root.menu2 == 'your_account'" ng-include="'../views/user/your_account.html'" ></div>
        <div ng-if="$root.menu2 == 'your_tasks'" ng-include="'../views/user/your_tasks2.html'" ></div>
        <div ng-if="$root.menu2 == 'create_tasks'" ng-include="'../views/user/create_tasks2.html'" ></div>
    </div>
</div>
@endsection
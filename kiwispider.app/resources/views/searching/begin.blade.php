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
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            min-height: 100vh;
            margin: 0;
        }
        th,td{
            text-align: center;
        }

        .full-height {
            min-height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }


        .content {
            text-align: center;
        }

        .result_content {
            text-align: center;
        }

        .title {
            font-size: 80px;
            margin-top: 0px
        }
        .logo{
            text-align: center;
            margin-top: -100px;
        }

        .links > a {
            color: green;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .rows{
            margin-left: -70px;
        }

        .m-b-md {
            margin-bottom: 0px;
        }


    </style>

    <div ng-show="$root.crawler_home" class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md" style="font-weight: 100; color:green">
                <div class="logo"></div>
                Begin <img style="margin-top: -60px" src="http://kiwispider.com/logo.png" alt="logo" height="100px"/> Search
            </div>

            <div class="links">
                <a href="/home">HomePage</a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Switch Account
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="page">
                <div class="container">
                    <div class="result_content">
                        <div class="container">
                            <div class="rows">
                                <div name="theSearch">
                                    <div style="height:10px;"></div>
                                    <div class="assessment-container container" style="margin-left: 315px;">
                                        <div class="col-md-6 form-box">
                                                <form role="form" class="registration-form" action="javascript:void(0);">
                                                    <fieldset>
                                                        <div class="form-top">
                                                            <div class="form-top-left">
                                                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Searching Conditions</h3>
                                                                <p>1. Keyword</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-bottom">
                                                            <div class="form-group">
                                                                Keyword (required):<br>
                                                                <input type='text' name='title' id ="title" required="required"><br><br>
                                                            </div>
                                                            <button type="button" class="btn btn-next">Next</button>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <div class="form-top">
                                                            <div class="form-top-left">
                                                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Searching Conditions</h3>
                                                                <p>2. City</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-bottom">
                                                            <div class="form-group">
                                                                City:<br>
                                                                <input type='text' name='city' id='city'><br><br>
                                                            </div>
                                                            <button type="button" class="btn btn-previous">Previous</button>
                                                            <button type="button" class="btn btn-next">Next</button>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <div class="form-top">
                                                            <div class="form-top-left">
                                                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Searching Conditions</h3>
                                                                <p>3. Count</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-bottom">
                                                            <div class="form-group">
                                                                Count:<br>
                                                                <input type='number' name='count' id ='count' required="required" ><br><br>
                                                            </div>
                                                            <button type="button" class="btn btn-previous">Previous</button>
                                                            <button type="button" class="btn btn-next">Next</button>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <div class="form-top">
                                                            <div class="form-top-left">
                                                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Searching Conditions</h3>
                                                                <p>Searching area</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-bottom">
                                                            <div class="form-group">
                                                                <select name="searchFrom" required="required" id="searchChoice">
                                                                    <option value="0">---Search From Linkedin---</option>
                                                                    <option value="1">---Search From Salesgenie---</option>
                                                                </select>
                                                            </div>
                                                            <button type="button" class="btn btn-previous">Previous</button>
                                                            <button id="sub" class = "btn btn-success">Add to search queue</button>                                                        </div>
                                                    </fieldset>
                                                </form>
                                            </div>
                                    </div>
                                    <br><br>
                                    <button id="switchLkedin" class = "btn btn-success" > Switch Linkedin Account (optional)</button>
                                    <p id="linkedin_switch" style="display:none"><br>
                                        Linkedin Email:<br>
                                        <input type='text' id='linkedin_email' ><br><br>
                                        Password:<br>
                                        <input type='password'  id ='linkedin_password' autocomplete="new-password">

                                    </p><br><br>
                                </div><br>
                                <button id="ref" class = "btn btn-success" >Refresh</button>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
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

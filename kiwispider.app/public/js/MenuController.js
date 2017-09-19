appA.controller('MenuController', function($scope, $rootScope, $http) {
    $rootScope.crawler_home = true;
	$scope.toggleSideBar = function()
	{
		document.getElementById("subMenu").classList.toggle('active');
        $rootScope.crawler_home = false;
	}


});


appA.controller('Left_Admin_Menu_Controller', function($scope , $rootScope , $http) {
	var vm  = this;
	$rootScope.usersacc = [];
	vm.loadUser = function()
	{	
		$http.get('/api/admin/get_user').then(
			function(response){
				$rootScope.usersacc = response.data;
			}, 
			function(response){
				alert('Error Request User Account');
			}
		);
	}

	vm.loadTask = function()
	{	
		$http.get('/api/admin/task/get_task').then(
			function(response){
				$rootScope.tasks = response.data;
			}, 
			function(response){
				alert('Error Request Tasks List');
			}
		);
	}


	vm.ctrMenu = function(page) 
	{
		switch(page) {
		    case 'user_account':
		    	$scope.toggleSideBar();
		        vm.loadUser();
		        break;
		    case 'tasks':
		    	$scope.toggleSideBar();
				vm.loadTask();

		        break;
		    default:
		    	$scope.toggleSideBar();
		        break;
		}
		
		$rootScope.menu = page;

	}

});
appA.controller('Left_User_Menu_Controller', function($scope , $rootScope , $http) {
	var vm  = this;
	$rootScope.your_acc = [];
	vm.load_your_acc = function()
	{	
		$http.get('/api/user/get_your_account').then(
			function(response){
				$rootScope.your_acc = response.data;
			}, 
			function(response){
				alert('Error Request Your Account');
			}
		);
	}

	vm.load_your_task = function()
	{	
		$http.get('/api/user/task/get_your_task').then(
			function(response){
				$rootScope.your_tasks = response.data;
			}, 
			function(response){
				alert('Error Request Tasks List');
			}
		);
	}

	vm.load_create_task = function()
	{
        $http.get('/api/user/task/get_create_task').then(
			function(response){
				$rootScope.create_tasks = response.data;
            },
			function(response){
				alert('Error Request Tasks List');
			}
		);
	}


	vm.ctrMenu = function(page) 
	{
		switch(page) {
		    case 'your_account':
		    	$scope.toggleSideBar();
		        vm.load_your_acc();
		        break;
		    case 'your_tasks':
		    	$scope.toggleSideBar();
				vm.load_your_task();
		        break;
		    case 'create_tasks':
		    	$scope.toggleSideBar();
				vm.load_create_task();
                break;
		    default:
		    	$scope.toggleSideBar();
		        break;
		}
		
		$rootScope.menu2 = page;


	}

});
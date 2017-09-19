appA.controller('AdminController', function($scope, $rootScope, $http, $window) {
	$scope.loadUser = function()
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

	$scope.loadMessage = function(task)
	{
		var dataObj = {
				task_id : 		task.id,
		};
		$http.post('/api/admin/msg/get_task_messages',dataObj).then(
	       	function(response){
	       		$rootScope.msg_content = '';
	       		$rootScope.task_msg = response.data;
	       	}, 
	       	function(response){
	        	alert('Error Admin Load Message');
	       	}
	    );
	}

	/* Get Current window size */
	$scope.width = $window.innerWidth;
	$scope.height = $window.innerHeight;
	angular.element($window).bind('resize', function () {
	    $scope.$apply(function () {
	        $scope.width = $window.innerWidth;
	        $scope.height = $window.innerHeight;
	    });
	});

	/* Formate Date */
	$scope.format = 'yyyy/MM/dd';
  	$scope.date = new Date('2017-07-29 02:13:31');

  	$scope.getD = function(sdate) {

  		return new Date(sdate);
  	}
});

appA.controller('InsideUserAccController', function($scope , $rootScope , $http, $uibModal) {
	var vm  = this;

	$scope.loadUser();
	vm.remove = function(userAcc)
	{
		$http.get('/api/admin/useracc/remove/'+userAcc.id).then(
	       function(response){
	         $rootScope.usersacc = response.data;
	       }, 
	       function(response){
	         alert('Error remove User Account');
	       }
	    );
	}

	vm.edit = function(userAcc)
	{
		
		alert('Edit ' + userAcc.id);
	
	}

	vm.addUserAccount = function() {
		var modalInstance = $uibModal.open({
		      ariaLabelledBy: 'modal-title',
		      ariaDescribedBy: 'modal-body',
		      templateUrl: '/views/admin/addAccountModal.html',
		      controller: 'UserModalInstanceCtrl',
		      controllerAs: 'vm'
		    });
	}
});

appA.controller('UserModalInstanceCtrl', function($uibModalInstance, $rootScope , $http) {
	var vm = this;
	vm.add = function () {
		var dataObj = {
				name : vm.name,
				email : vm.email
		};
		$http.post('/api/admin/useracc/add',dataObj).then(
	       function(response){
	         $rootScope.usersacc = response.data;
	       }, 
	       function(response){
	         alert('Error Add New User');
	       }
	    );			
		$uibModalInstance.close();
	};
	vm.cancel = function () {
		$uibModalInstance.dismiss();
	};

});

appA.controller('Inside_TaskController', function($scope , $rootScope , $http, $uibModal) {
	var vm  = this;

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

	vm.remove = function(task)
	{
		$http.get('/api/admin/task/remove/'+task.id).then(
	       function(response){
	         $rootScope.tasks = response.data;
	       }, 
	       function(response){
	         alert('Error remove Task');
	       }
	    );
	}

	/*  Edit Left Section of Task Info*/
	vm.disable_EditBtn = function() {
		vm.editStatus = false;
		vm.editDesStatus = false;
	}

	vm.editTask = function(task) {
		vm.editStatus = true;
		// if (typeof $rootScope.usersacc === 'undefined') {
			$scope.loadUser();
		// }
		vm.project_name = task.project_name;
		vm.priority 	= task.priority;
		vm.assigned_to  = task.assigned_to_id;
		vm.due_date = $scope.getD(task.due_date);
	}
	vm.confirm_editTask = function(task) {

		var dataObj = {
				task_id 		: task.id,
				task_name 		: vm.task_name,
				assigned_id 	: vm.assigned_to,
				project_name	: vm.project_name,
				due_date		: vm.due_date,
				priority		: vm.priority,
		};
		$http.post('/api/admin/task/edit',dataObj).then(
	       function(response){
	         $rootScope.tasks = response.data;
	       }, 
	       function(response){
	         alert('Error admin Edit Task');
	       }
	    );
	}
	/*  End Edit Left Section of Task Info*/

	/*  Edit Right Section of Task Description*/
	vm.editDesTask = function(task) {
		vm.editDesStatus = true;
		vm.description 	= task.description;
	}
	vm.confirm_editDesTask = function(task) {
		var dataObj = {
				task_id 		: task.id,
				description 	: vm.description
		};
		$http.post('/api/admin/task/edit',dataObj).then(
	       function(response){
	         $rootScope.tasks = response.data;
	       }, 
	       function(response){
	         alert('Error Edit Task Description');
	       }
	    );
	}
	/*  End Edit Right Section of Task Description*/

	/*  Send Message of current create tasks*/
	vm.sendMessage = function(task,e)
	{
		var dataObj = {
				content : 		$rootScope.msg_content,
				task_id : 		task.id,
				receiver_id: 	task.assigned_to_id, 
				task_type: 		task.creater_role 
		};
		$http.post('/api/admin/msg/send_message',dataObj).then(
	       	function(response){
	       		$rootScope.msg_content = '';
	       		$rootScope.task_msg = response.data;
	       	}, 
	       	function(response){
	        	alert('Error Admin Send Message');
	       	}
	    );
	}

	vm.addTask = function() {
		$scope.loadUser();
		var modalInstance = $uibModal.open({
		      ariaLabelledBy: 'modal-title',
		      ariaDescribedBy: 'modal-body',
		      templateUrl: '/views/task/addTaskModal.html',
		      controller: 'AdTaskModal_InstanceCtrl',
		      controllerAs: 'vm'
		    });
	}
});

appA.controller('AdTaskModal_InstanceCtrl', function($uibModalInstance, $rootScope , $http) {
	var vm = this;
	vm.add = function () {
		var dataObj = {
				task_name 		: vm.task_name,
				assigned_id 	: vm.assigned_to,
				project_name	: vm.project_name,
				due_date		: vm.due_date,
				priority		: vm.priority,
				description		: vm.description,
				progress 		: 0
		};
		$http.post('/api/admin/task/add',dataObj).then(
	       function(response){
	         $rootScope.tasks = response.data;
	       }, 
	       function(response){
	         alert('Error Add New Task');
	       }
	    );			
		$uibModalInstance.close();
	};
	vm.cancel = function () {
		$uibModalInstance.dismiss();
	};

});
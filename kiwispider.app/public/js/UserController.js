appA.controller('UserController', function($scope, $rootScope, $http, $window , uibDateParser) {
	$scope.loadUser = function()
	{	
		$http.get('/api/user/get_user').then(
			function(response){
				$rootScope.usersacc = response.data;
			}, 
			function(response){
				alert('Error Request User Account');
			}
		);
	}
	$scope.load_your_acc = function()
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

	$scope.loadMessage = function(task)
	{
		var dataObj = {
				task_id : 		task.id,
		};
		$http.post('/api/user/msg/get_task_messages',dataObj).then(
	       	function(response){
	       		$rootScope.msg_content = '';
	       		$rootScope.task_msg = response.data;
	       	}, 
	       	function(response){
	        	alert('Error Load Message');
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

appA.controller('Inside_YourAccount_Controller', function($scope , $rootScope , $http, $uibModal) {
	var vm  = this;

	$scope.load_your_acc();
	vm.editAccount = function()
	{	
		alert('Edit');
	}
});
/*  
 *   YOUR TASK Section 
 */
appA.controller('Inside_Your_TaskController', function($scope , $rootScope , $http, $uibModal) {
	var vm  = this;
	
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

	vm.remove = function(task)
	{
		$http.get('/api/user/task/your_remove/'+task.id).then(
	       function(response){
	         $rootScope.your_tasks = response.data;
	       }, 
	       function(response){
	         alert('Error remove Task');
	       }
	    );
	}

	vm.editProgress = function(task)
	{
		var dataObj = {
				task_id : task.id,
				progress_value : task.progress
		};
		$http.post('/api/user/task/your_progress_edit',dataObj).then(
	       function(response){
	         $rootScope.your_tasks = response.data;
	       }, 
	       function(response){
	         alert('Error Edit Task Progress');
	       }
	    );
	}
	vm.complete = function(task,e)
	{
		if (e) {
	         e.preventDefault();
	         e.stopPropagation();
	    }
		$http.get('/api/user/task/your_complete/'+task.id).then(
	       function(response){
	         $rootScope.your_tasks = response.data;
	       }, 
	       function(response){
	         alert('Error Complete Task');
	       }
	    );
	}

	vm.sendMessage = function(task,e)
	{
		var dataObj = {
				content : 		$rootScope.msg_content,
				task_id : 		task.id,
				receiver_id: 	task.creater_id, 
				task_type: 		task.creater_role 
		};
		$http.post('/api/user/msg/send_message',dataObj).then(
	       	function(response){
	       		$rootScope.msg_content = '';
	       		$rootScope.task_msg = response.data;
	       	}, 
	       	function(response){
	        	alert('Error Send Message');
	       	}
	    );
	}

	
});
/*  
 *   CREATE TASK Section 
 */
appA.controller('Inside_Create_TaskController', function($scope , $rootScope , $http, $uibModal) {
	var vm  = this;

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

	/*  Edit Left Section of Task Info*/
	vm.disable_EditBtn = function() {
		vm.editStatus = false;
		vm.editDesStatus = false;
	}

	vm.editTask = function(task) {
		vm.editStatus = true;
		if (typeof $rootScope.usersacc === 'undefined') {
			$scope.loadUser();
		}
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
		$http.post('/api/user/task/edit',dataObj).then(
	       function(response){
	         $rootScope.create_tasks = response.data;
	       }, 
	       function(response){
	         alert('Error Edit Task');
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
		$http.post('/api/user/task/edit',dataObj).then(
	       function(response){
	         $rootScope.create_tasks = response.data;
	       }, 
	       function(response){
	         alert('Error Edit Task Description');
	       }
	    );
	}
	/*  End Edit Right Section of Task Description*/

	vm.remove = function(task)
	{
		$http.get('/api/user/task/create_remove/'+task.id).then(
	       function(response){
	         $rootScope.create_tasks = response.data;
	       }, 
	       function(response){
	         alert('Error remove Task');
	       }
	    );
	}

	vm.sendMessage = function(task,e)
	{
		var dataObj = {
				content : 		$rootScope.msg_content,
				task_id : 		task.id,
				receiver_id: 	task.assigned_to_id, 
				task_type: 		task.creater_role 
		};
		//alert(JSON.stringify(dataObj));
		$http.post('/api/user/msg/send_message',dataObj).then(
	       	function(response){
	       		$rootScope.msg_content = '';
	       		$rootScope.task_msg = response.data;
	       		//alert(JSON.stringify(response.data));
	       	}, 
	       	function(response){
	        	alert('Error Send Message');
	       	}
	    );
	}

	vm.addTask = function() {
		if (typeof $rootScope.usersacc === 'undefined') {
			$scope.loadUser();
		}
		var modalInstance = $uibModal.open({
		      ariaLabelledBy: 'modal-title',
		      ariaDescribedBy: 'modal-body',
		      templateUrl: '/views/task/addTaskModal.html',
		      controller: 'TaskModal_InstanceCtrl',
		      controllerAs: 'vm'
		    });
	}
});

appA.controller('TaskModal_InstanceCtrl', function($uibModalInstance, $rootScope , $http) {
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
		$http.post('/api/user/task/add',dataObj).then(
	       function(response){
	         $rootScope.create_tasks = response.data;
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
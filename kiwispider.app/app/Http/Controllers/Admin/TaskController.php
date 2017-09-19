<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Task;
use DateTime;
use Auth;
use DB;
/*  Admin Task Controller */
class TaskController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
	}
    public function index()
    {
        return $this->retrieveTask();
    }

    private function retrieveTask() {
        $curr_ad_id = Auth::User()->id;
        $tasksCurrentAdmin = DB::table('tasks')->where([['tasks.creater_role','=','admin'],['tasks.creater_id','=',$curr_ad_id]])->join('users','tasks.assigned_to_id','=','users.id')->join('admins','tasks.creater_id','=','admins.id')->select('tasks.*','users.name as assignName','users.id as assignId', 'admins.name as creater_name')->get();
        $tasksAdmin = DB::table('tasks')->where([['tasks.creater_role','=','admin'],['tasks.creater_id','<>',$curr_ad_id]])->join('users','tasks.assigned_to_id','=','users.id')->join('admins','tasks.creater_id','=','admins.id')->select('tasks.*','users.name as assignName','users.id as assignId', 'admins.name as creater_name')->get();
        $tasksUser = DB::table('tasks')->where('tasks.creater_role','=','user')->join('users as u1','tasks.assigned_to_id','=','u1.id')->join('users as u2','u2.id','=','tasks.creater_id')->select('tasks.*','u1.name as assignName','u1.id as assignId','u2.name as creater_name')->get();

        return ['current_admin' => $tasksCurrentAdmin , 'other_admin' => $tasksAdmin , 'user' => $tasksUser];
    }

    public function destroy($id)
    {
    	$tasks = Task::find($id);
    	$tasks->delete();
        return $this->retrieveTask();
    }
    public function add(Request $request)
    {
        
        $task = new Task;
        $task->name             = $request['task_name'];
        $task->creater_id       = Auth::user()->id;
        $task->creater_role     = 'admin';
        $task->assigned_to_id   = $request['assigned_id'];
        $task->project_name     = $request['project_name'];
        $task->due_date         = new DateTime($request['due_date']); 
        $task->description      = $request['description'];
        $task->priority         = $request['priority'];
        $task->progress         = $request['progress'];
        $task->save();

        return $this->retrieveTask();
    }
    /*  
     *   Edit your create task :
     *   Post request url:  '/api/admin/task/edit'
     *   data = {
     *    task_id           : 'task id',
     *    task_name         : 'task name, 
     *    assigned_to_id    : 'assigned id',
     *    project_name      : 'project name', 
     *    due_date          : 'due date',
     *    description       : 'description',
     *    receiver_id       : 'receiver id', 
     *    priority          : 'priority', 
     *    progress          : 'progress' 
     *   }
     */
    public function edit(Request $request)
    {
        $task = Task::find($request['task_id']);
        $task->name             = (isset($request['task_name']))?       $request['task_name']       : $task->name;
        $task->assigned_to_id   = (isset($request['assigned_id']))?     $request['assigned_id']     : $task->assigned_to_id;
        $task->project_name     = (isset($request['project_name']))?    $request['project_name']    : $task->project_name;
        $task->due_date         = (isset($request['due_date']))?        new DateTime($request['due_date']) : $task->due_date;
        $task->description      = (isset($request['description']))?     $request['description']     : $task->description;
        $task->priority         = (isset($request['priority']))?        $request['priority']        : $task->priority;
        $task->progress         = (isset($request['progress']))?        $request['progress']        : $task->progress;
        $task->save();

        return $this->retrieveTask();
    }
}

<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Task;
use DateTime;
use Auth;
use DB;

/*
 *   User Task Controller
 */
class TaskController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

    /*  
     *   YOUR TASK Section 
     */
    
    public function get_your_task()
    {
        $userId = Auth::User()->id;
        $your_task = DB::table('tasks')->where('tasks.assigned_to_id','=',$userId)->join('users as u2','u2.id','=','tasks.creater_id')->select('tasks.*','u2.name as creater_name')->get();
        $your_task_admin = DB::table('tasks')->where('tasks.assigned_to_id','=',$userId)->join('admins as u2','u2.id','=','tasks.creater_id')->select('tasks.*','u2.name as creater_name')->get();
        return $your_task->merge($your_task_admin);
    }

    public function your_destroy($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
        return $this->get_your_task();
    }

    public function your_complete($id)
    {
        $tasks = Task::find($id);
        $tasks->progress = 100;
        $tasks->save();
        return $this->get_your_task();
    }

    public function your_progress_edit(Request $request)
    {
        $tasks = Task::find($request['task_id']);
        $tasks->progress = $request['progress_value'];
        $tasks->save();
        return $this->get_your_task();
    }

    /*  
     *   CREATE TASK Section 
     */
    public function get_create_task()
    {
        return $this->retrieveCreateTask();
    }

    private function retrieveCreateTask() {
        $userId = Auth::User()->id;
        $your_create_task = DB::table('tasks')->where('tasks.creater_id','=',$userId)->join('users as u1','tasks.assigned_to_id','=','u1.id')->select('tasks.*','u1.name as assignName')->get();

        return $your_create_task;
    }

    public function create_destroy($id)
    {
    	$tasks = Task::find($id);
    	$tasks->delete();
        return $this->retrieveCreateTask();
    }

    public function add(Request $request)
    {
        
        $task = new Task;
        $task->name = $request['task_name'];
        $task->creater_id = Auth::user()->id;
        $task->creater_role = 'user';
        $task->assigned_to_id = $request['assigned_id'];
        $task->project_name = $request['project_name'];
        $task->due_date = new DateTime($request['due_date']); 
        $task->description = $request['description'];
        $task->priority = $request['priority'];
        $task->progress = $request['progress'];
        $task->save();

        return $this->retrieveCreateTask();
    }

    /*  
     *   Edit your create task :
     *   Post request url:  '/api/user/task/edit'
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

        return $this->retrieveCreateTask();
    }
}

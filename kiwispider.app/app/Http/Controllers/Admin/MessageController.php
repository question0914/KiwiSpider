<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Message;
use DateTime;
use Auth;
use User;
use DB;

/*
 *   User Tasks Message Controller
 */
class MessageController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    /*  
     *   User Get All Task Message :
     *   Post request url:  '/api/admin/msg/get_task_messages'
     *   data = {
     *    task_id : 'task id'
     *   }
     */
    public function get_task_messages(Request $request)
    {
        return $this->retrieve_message($request['task_id']);
    }

    private function retrieve_message($taskId)
    {
        $task_message = DB::table('messages')->where('messages.task_id','=',$taskId)->get();
        return $task_message;
    }

    /*  
     *   User Delete Message :
     *   Post request url:  '/api/admin/msg/send_message'
     *   data = {
     *    task_id : 'task id'
     *   }
     */
    public function delete_message(Request $request)
    {
        $task_Id = $request['task_id'];
        $sender_Id = Auth::User()->id;

        $message = Message::find(); //not finish
        $message->delete();
        return $this->retrieve_message($task_Id);
    }

    /*  
     *   User Send Message :
     *   Post request url:  '/api/admin/msg/send_message'
     *   data = {
     *    content : 'message',
     *    task_id : 'task id',
     *    receiver_id: 'receiver id', 
     *    task_type: ' user | admin' 
     *   }
     */
    public function send_message(Request $request)
    {
        
        $message = new Message;
        $message->content = $request['content'];
        $message->task_id = $request['task_id'];
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request['receiver_id'];
        $message->task_type = $request['task_type'];
        $message->save();

        return $this->retrieve_message($request['task_id']);
    }
}

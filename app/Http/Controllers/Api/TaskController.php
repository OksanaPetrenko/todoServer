<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    public function getTask($id)
    {
        $task = Task::find($id);
        if($task){
            $return_data = [
                'status_code' => 200,
                'data' => $task,
            ];
        }else{
            $return_data = [
                'status_code' => 404,
                'data' => [],
            ];
        }
        return response()->json($return_data);
    }

    public function getTasksUser()
    {
    	$user = Auth::guard('api')->user();
        $tasks = Task::where('user_id', $user->id)->orderBy('priority', 'DESC')->get();
        $return_data = [
            'status_code' => 200,
            'data' => $tasks,
        ];
        return response()->json($return_data);
    }
    public function createTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'priority' => 'required|integer',
            'date'     => 'required|date',
        ])->validateWithBag('task');
        $user =  Auth::guard('api')->user();
        $task = new Task();
        $task->fill($request->all());
        $task->user_id = $user->id;
        $task->date = date('Y-m-d', strtotime($request->date));
        $task->save();
		$return_data = [
            'status_code' => 200,
            'data' => $task,
        ];
        return response()->json($return_data);
    }
    public function updateTask(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'string|max:255',
            'priority' => 'integer',
            'status'   => 'boolean',
            'date'     => 'date',
        ])->validateWithBag('task');
        $task = Task::find($id);
        $task->fill($request->all());
        if( $request->date){
            $task->date = date('Y-m-d', strtotime($request->date));
        }
        $task->save();
        $return_data = [
            'status_code' => 200,
            'data' => $task,
        ];
        return response()->json($return_data);
    }
    
    public function deleteTaskUser($id) 
    {
        $task = Task::find($id);
        if($task){
            $task->delete();
    		$return_data = [
                'status_code' => 200,
            ];
        }else{
            $return_data = [
                'status_code' => 404,
            ];
        }
        return response()->json($return_data);
    }
}

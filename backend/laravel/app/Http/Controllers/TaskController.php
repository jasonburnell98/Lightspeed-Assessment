<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTaskList()
    {
        $taskList = Task::with(['user', 'project'])->get();

        return response()->json(
            [
                'status' => 'sucess',
                'code' => '200',
                'message' => '',
                'data' =>  $taskList
            ]
        );
    }

    public function createTask(Request $request)
    {

        try {
            $taskUser = new Task;
            $taskUser->project_id = $request->project_id;
            $taskUser->task_name = $request->task_name;
            $taskUser->assinged_to = $request->assinged_to;
            $taskUser->estimated_hours = $request->estimated_hours;
            $taskUser->save();

            return response()->json(
                [
                    'status' => 'sucess',
                    'code' => '200',
                    'message' => 'Data Save Sucessfully',
                    'data' => []
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'code' => '500',
                    'message' => $e->getMessage(),
                    'data' => []
                ]
            );
        }
    }
}

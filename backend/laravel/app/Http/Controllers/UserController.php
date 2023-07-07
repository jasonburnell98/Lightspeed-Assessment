<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class UserController extends Controller
{

    public function getUserList(Request $request)
    {

        if (isset($request->user_id)) {
            $userData = User::where('id', $request->user_id)->first();
            $projects = Project::whereJsonContains('assinged_to', $request->user_id)->withSum('tasks', 'estimated_hours')->get();

            foreach ($projects as $project) {
                $userIds = $project->assinged_to;
                $project->members = User::whereIn('id', $userIds)->get();
            }
            $userData->projects = $projects;
            return response()->json(
                [
                    'status' => 'sucess',
                    'code' => '200',
                    'message' => '',
                    'data' => $userData
                ]
            );
        } else {
            $userList = User::get();
            return response()->json(
                [
                    'status' => 'sucess',
                    'code' => '200',
                    'message' => '',
                    'data' => $userList
                ]
            );
        }
        return response()->json(
            [
                'status' => 'sucess',
                'code' => '200',
                'message' => '',
                'data' => []
            ]
        );
    }

    public function createUser(Request $request)
    {

        try {
            $createUser = new User;
            $createUser->name = $request->name;
            $createUser->contactno = $request->contactno;
            $createUser->save();

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

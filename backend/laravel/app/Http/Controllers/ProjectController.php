<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;


class ProjectController extends Controller
{
    public function getProjectList(Request $request)
    {
        $projectList = Project::withSum('tasks', 'estimated_hours');

        if ($request->project_id) {
            $project = $projectList->where('id', $request->project_id)->with('tasks')->first();
           
            if (isset($project)) {
                $userIds = $project->assinged_to;
                $project->members = User::whereIn('id', $userIds)->get();
            }
            return response()->json(
                [
                    'status' => 'sucess',
                    'code' => '200',
                    'message' => '',
                    'data' =>  $project
                ]
            );
        } else {
            $projectList =  $projectList->get();
            foreach ($projectList as $project) {
                $userIds = $project->assinged_to;
                $project->members = User::whereIn('id', $userIds)->get();
            }

            return response()->json(
                [
                    'status' => 'sucess',
                    'code' => '200',
                    'message' => '',
                    'data' =>  $projectList
                ]
            );
        }


        return response()->json(
            [
                'status' => 'sucess',
                'code' => '200',
                'message' => '',
                'data' =>  []
            ]
        );
    }

    public function createProject(Request $request)
    {

        try {
            $createProject = new Project;
            $createProject->projectname = $request->projectname;
            $createProject->assinged_to = $request->assinged_to;
            $createProject->save();

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

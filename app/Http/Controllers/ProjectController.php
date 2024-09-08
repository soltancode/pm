<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Project::all());
    }

    public function show(Project $project)
    {
        return response()->json($project);
    }
}
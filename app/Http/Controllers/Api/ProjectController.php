<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;

class ProjectController extends Controller
{
    public function index(Request $request)
    {

        $categoryId = $request->input('category_id');

        $projectsQuery = Project::query();

        // Aggiungi la condizione di filtro solo se è specificato un category_id
        if ($categoryId) {
            $projectsQuery->whereHas('category', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        $projects = $projectsQuery->paginate(3);

        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with(['category', 'technologies'])->first();
        return response()->json([
            'success' => true,
            'results' => $project
        ]);
    }
}
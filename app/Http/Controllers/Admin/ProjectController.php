<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId = Auth::id();
        if ($currentUserId == 1) {
            $projects = Project::paginate(10);
        } else {
            $projects = Project::where('user_id', $currentUserId)->paginate(5);
        }
        $projects = Project::where('user_id', $currentUserId)->paginate(5);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $categories = Category::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $slug = Project::getSlug($form_data['title']);
        $form_data['slug'] = $slug;
        $userId = auth()->id();
        $form_data['user_id'] = $userId;
        if ($request->hasFile('image')) {
            $path = Storage::put('images', $request->image);
            $form_data['image'] = $path;
        }
        $newProject = Project::create($form_data);
        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }
        return to_route('admin.projects.show', $newProject->slug);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId == $project->id || $currentUserId == 1) {
            return view('admin.projects.show', compact('project'));
        }
        abort(403);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId != $project->id && $currentUserId != 1) {
            abort(403);
        }
        $technologies = Technology::all();
        $categories = Category::all();
        return view('admin.projects.edit', compact('project', 'categories', 'technologies'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId != $project->id && $currentUserId != 1) {
            abort(403);
        }
        $form_data = $request->validated();
        $form_data['slug'] = $project->slug;
        if ($project->title !== $form_data['title']) {
            $slug = Project::getSlug($form_data['title']);
            $form_data['slug'] = $slug;
        }
        $form_data['user_id'] = $project->user_id;
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $path = Storage::put('images', $request->image);
            $form_data['image'] = $path;
        }
        $project->update($form_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }
        return to_route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId != $project->id && $currentUserId != 1) {
            abort(403);
        }
        // $project->tags->detatch(); //non necessario se cascadeOnDelete
        if ($project->image) {
            Storage::delete($project->image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', "$project->title eliminato con successo!");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUserId = Auth::id();
        if ($currentUserId != 1) {
            abort(403);
        }
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $form_data = $request->validated();
        $slug = Category::getSlug($form_data['name']);
        $form_data['slug'] = $slug;
        $newCategory = Category::create($form_data);
        return to_route('admin.categories.show', $newCategory->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $currentUserId = Auth::id();
        if ($currentUserId != 1) {
            abort(403);
        }
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $form_data = $request->validated();
        $form_data['slug'] = $category->slug;
        if ($category->name !== $form_data['name']) {
            $slug = Category::getSlug($form_data['name']);
            $form_data['slug'] = $slug;
        }
        $category->update($form_data);
        return to_route('admin.categories.show', $category->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $currentUserId = Auth::id();
        if ($currentUserId != 1) {
            abort(403);
        }
        $category->delete();
        return to_route('admin.categories.index')->with('message', "$category->title eliminato con successo!");
    }
}

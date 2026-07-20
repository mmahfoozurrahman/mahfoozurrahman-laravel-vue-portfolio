<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Projects/Index', [
            'projects' => Project::orderBy('sort_order', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Projects/Form');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'required|string|max:255',
            'tech_stack' => 'required|array',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'integer',
        ]);

        $imagePath = 'assets/images/portfolio-placeholder.svg';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        Project::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category' => $validated['category'],
            'description' => $validated['description'],
            'long_description' => $validated['long_description'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'status' => $validated['status'],
            'tech_stack' => $validated['tech_stack'],
            'demo_url' => $validated['demo_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): Response
    {
        return Inertia::render('Admin/Projects/Form', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'required|string|max:255',
            'tech_stack' => 'required|array',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'integer',
        ]);

        $imagePath = $project->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category' => $validated['category'],
            'description' => $validated['description'],
            'long_description' => $validated['long_description'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'status' => $validated['status'],
            'tech_stack' => $validated['tech_stack'],
            'demo_url' => $validated['demo_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}

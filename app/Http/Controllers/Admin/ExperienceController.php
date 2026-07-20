<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ExperienceController extends Controller
{
    /**
     * Display a listing of experiences.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Experiences/Index', [
            'experiences' => Experience::orderBy('sort_order', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new experience.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Experiences/Form');
    }

    /**
     * Store a newly created experience in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'role_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'is_featured' => 'boolean',
            'accomplishments' => 'required|array',
            'skills' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'integer',
        ]);

        $imagePath = 'assets/images/experience-placeholder.svg';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('experiences', 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        Experience::create([
            'role_title' => $validated['role_title'],
            'company' => $validated['company'],
            'location' => $validated['location'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_featured' => $validated['is_featured'] ?? false,
            'accomplishments' => $validated['accomplishments'],
            'skills' => $validated['skills'],
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience created successfully.');
    }

    /**
     * Show the form for editing the specified experience.
     */
    public function edit(Experience $experience): Response
    {
        return Inertia::render('Admin/Experiences/Form', [
            'experience' => $experience,
        ]);
    }

    /**
     * Update the specified experience in storage.
     */
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'role_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255',
            'is_featured' => 'boolean',
            'accomplishments' => 'required|array',
            'skills' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'integer',
        ]);

        $imagePath = $experience->image_path;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('experiences', 'public');
            $imagePath = 'storage/' . $imagePath;
        }

        $experience->update([
            'role_title' => $validated['role_title'],
            'company' => $validated['company'],
            'location' => $validated['location'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'is_featured' => $validated['is_featured'] ?? false,
            'accomplishments' => $validated['accomplishments'],
            'skills' => $validated['skills'],
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated successfully.');
    }

    /**
     * Remove the specified experience from storage.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experience deleted successfully.');
    }
}

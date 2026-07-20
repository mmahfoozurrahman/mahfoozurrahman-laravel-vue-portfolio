<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingController extends Controller
{
    /**
     * Show the settings edit panel.
     */
    public function edit(): Response
    {
        $settings = SiteSetting::first() ?? new SiteSetting();

        return Inertia::render('Admin/Settings/Form', [
            'settings' => $settings,
        ]);
    }

    /**
     * Update global settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $settings = SiteSetting::first();
        if (!$settings) {
            $settings = new SiteSetting();
        }

        $validated = $request->validate([
            'owner_name' => 'required|string|max:255',
            'owner_role' => 'required|string|max:255',
            'owner_bio' => 'required|string',
            'location' => 'required|string|max:255',
            'relocation_notice' => 'required|string',
            'email' => 'required|email|max:255',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'ai_assistant_welcome' => 'required|string',
            'meta_description' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'resume' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $avatarPath = $settings->owner_avatar;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('profile', 'public');
            $avatarPath = 'storage/' . $avatarPath;
        }

        $resumePath = $settings->resume_url;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('docs', 'public');
            $resumePath = 'storage/' . $resumePath;
        }

        $settings->fill([
            'owner_name' => $validated['owner_name'],
            'owner_role' => $validated['owner_role'],
            'owner_bio' => $validated['owner_bio'],
            'location' => $validated['location'],
            'relocation_notice' => $validated['relocation_notice'],
            'email' => $validated['email'],
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'github_url' => $validated['github_url'] ?? null,
            'ai_assistant_welcome' => $validated['ai_assistant_welcome'],
            'meta_description' => $validated['meta_description'],
            'owner_avatar' => $avatarPath,
            'resume_url' => $resumePath,
        ]);

        $settings->save();

        return redirect()->back()->with('success', 'Global site settings updated successfully.');
    }
}

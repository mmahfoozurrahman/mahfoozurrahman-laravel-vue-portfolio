<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the admin panel main dashboard hub.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'metrics' => [
                'total_projects' => Project::count(),
                'total_experiences' => Experience::count(),
                'total_messages' => ContactMessage::count(),
                'unread_messages' => ContactMessage::where('status', 'unread')->count(),
            ],
            'recent_messages' => ContactMessage::orderBy('created_at', 'desc')->take(5)->get(),
        ]);
    }
}

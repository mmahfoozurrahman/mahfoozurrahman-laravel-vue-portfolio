<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\GithubRepo;
use App\Models\Project;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class AppLayoutController extends Controller
{
    /**
     * Get global settings shared across pages.
     */
    private function getSettings()
    {
        return SiteSetting::first() ?? new SiteSetting();
    }

    /**
     * Render the dynamic Home Page.
     */
    public function home(): Response
    {
        return Inertia::render('Home', [
            'settings' => $this->getSettings(),
        ]);
    }

    /**
     * Render the dynamic Experience Timeline Page.
     */
    public function experience(): Response
    {
        return Inertia::render('Experience', [
            'settings' => $this->getSettings(),
            'experiences' => Experience::orderBy('sort_order', 'asc')->get(),
        ]);
    }

    /**
     * Render the dynamic Portfolio Showcase Grid Page.
     */
    public function portfolio(): Response
    {
        return Inertia::render('Portfolio', [
            'settings' => $this->getSettings(),
            'projects' => Project::orderBy('sort_order', 'asc')->get(),
        ]);
    }

    /**
     * Render the dynamic GitHub Cache Repository Grid Page.
     */
    public function github(): Response
    {
        return Inertia::render('GitHub', [
            'settings' => $this->getSettings(),
            'repos' => GithubRepo::orderBy('stars_count', 'desc')->get(),
        ]);
    }

    /**
     * Render the dynamic Contact Card Page.
     */
    public function contact(): Response
    {
        return Inertia::render('Contact', [
            'settings' => $this->getSettings(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Lead;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard home.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'users_count' => User::count(),
                'pages_count' => Page::count(),
                'posts_count' => Post::count(),
                'services_count' => Service::count(),
                'portfolios_count' => Portfolio::count(),
                'leads_count' => Lead::count(),
                'settings_count' => Setting::count(),
            ],
            'recent_portfolios' => Portfolio::latest()->take(5)->get(),
            'recent_leads' => Lead::latest()->take(5)->get(),
        ]);
    }
}

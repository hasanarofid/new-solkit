<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the dynamic frontend homepage for Solkit Tech Software House.
     */
    public function index(): Response
    {
        // 1. Get settings as key-value
        $settingsRaw = Setting::all();
        $settings = $settingsRaw->pluck('value', 'key')->toArray();
        
        // Append site_logo_url
        $logoSetting = $settingsRaw->firstWhere('key', 'site_logo');
        $settings['site_logo_url'] = $logoSetting ? $logoSetting->image_url : null;
        if (empty($settings['primary_color'])) {
            $settings['primary_color'] = '#4f46e5';
        }

        // 2. Navigation
        $navigation = Page::where('is_active', true)
            ->select('id', 'title', 'slug')
            ->get();

        // 3. Homepage with active sections
        $homePage = Page::where('slug', 'home')
            ->where('is_active', true)
            ->with(['sections' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->first();

        // 4. Services (Software House offerings)
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        // 5. Portfolios (Case studies)
        $portfolios = Portfolio::where('is_active', true)
            ->orderBy('order')
            ->get();

        // 6. Latest insights/posts
        $posts = Post::where('status', 'published')
            ->with('category')
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'content' => $post->content,
                    'image_url' => $post->image_url,
                    'category' => $post->category ? ['name' => $post->category->name] : null,
                    'created_at' => $post->created_at,
                ];
            });

        return Inertia::render('Welcome', [
            'settings' => $settings,
            'navigation' => $navigation,
            'page' => $homePage,
            'services' => $services,
            'portfolios' => $portfolios,
            'posts' => $posts,
        ]);
    }

    /**
     * Handle incoming consultation / lead request from potential clients.
     */
    public function storeLead(StoreLeadRequest $request): RedirectResponse
    {
        $lead = Lead::create($request->validated());

        return redirect()->back()->with('success', 'Terima kasih! Tim konsultan Solkit Tech akan segera menghubungi Anda dalam 1x24 jam.');
    }
}

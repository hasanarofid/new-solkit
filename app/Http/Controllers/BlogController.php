<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    /**
     * Display listing of published articles with category filtering & search.
     */
    public function index(Request $request): Response
    {
        $settingsRaw = Setting::all();
        $settings = $settingsRaw->pluck('value', 'key')->toArray();
        $logoSetting = $settingsRaw->firstWhere('key', 'site_logo');
        $settings['site_logo_url'] = $logoSetting ? $logoSetting->image_url : null;

        $selectedCategory = $request->query('category');
        $searchQuery = $request->query('q');

        $postsQuery = Post::where('status', 'published')
            ->with('category')
            ->orderBy('created_at', 'desc');

        if (!empty($selectedCategory)) {
            $postsQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        if (!empty($searchQuery)) {
            $postsQuery->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', "%{$searchQuery}%")
                  ->orWhere('content', 'like', "%{$searchQuery}%");
            });
        }

        $posts = $postsQuery->paginate(9)->withQueryString();

        $categories = Category::withCount(['posts' => function ($q) {
            $q->where('status', 'published');
        }])->having('posts_count', '>', 0)->get();

        $featuredPost = Post::where('status', 'published')
            ->where('is_featured', true)
            ->with('category')
            ->latest()
            ->first();

        return Inertia::render('Blog/Index', [
            'settings' => $settings,
            'posts' => $posts,
            'categories' => $categories,
            'featuredPost' => $featuredPost,
            'filters' => [
                'category' => $selectedCategory,
                'q' => $searchQuery,
            ],
        ]);
    }

    /**
     * Display a single technical article with full reading experience & SEO.
     */
    public function show(string $slug): Response
    {
        $settingsRaw = Setting::all();
        $settings = $settingsRaw->pluck('value', 'key')->toArray();
        $logoSetting = $settingsRaw->firstWhere('key', 'site_logo');
        $settings['site_logo_url'] = $logoSetting ? $logoSetting->image_url : null;

        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->with('category')
            ->firstOrFail();

        // Related posts in same category
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->with('category')
            ->latest()
            ->take(3)
            ->get();

        if ($relatedPosts->isEmpty()) {
            $relatedPosts = Post::where('status', 'published')
                ->where('id', '!=', $post->id)
                ->with('category')
                ->latest()
                ->take(3)
                ->get();
        }

        return Inertia::render('Blog/Show', [
            'settings' => $settings,
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }

    /**
     * Display AdSense-compliant Privacy Policy page.
     */
    public function privacyPolicy(): Response
    {
        $settingsRaw = Setting::all();
        $settings = $settingsRaw->pluck('value', 'key')->toArray();
        $logoSetting = $settingsRaw->firstWhere('key', 'site_logo');
        $settings['site_logo_url'] = $logoSetting ? $logoSetting->image_url : null;

        return Inertia::render('Legal/PrivacyPolicy', [
            'settings' => $settings,
        ]);
    }

    /**
     * Display Terms of Service page.
     */
    public function termsOfService(): Response
    {
        $settingsRaw = Setting::all();
        $settings = $settingsRaw->pluck('value', 'key')->toArray();
        $logoSetting = $settingsRaw->firstWhere('key', 'site_logo');
        $settings['site_logo_url'] = $logoSetting ? $logoSetting->image_url : null;

        return Inertia::render('Legal/TermsOfService', [
            'settings' => $settings,
        ]);
    }
}

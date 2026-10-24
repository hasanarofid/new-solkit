<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Mail\LeadConfirmationMail;
use App\Mail\NewLeadNotificationMail;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

        // 6. Latest insights/posts (strengthen internal linking for SEO crawlers)
        $posts = Post::where('status', 'published')
            ->with('category')
            ->latest()
            ->take(6)
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

        // Dispatch email notifications safely
        try {
            $notificationEmail = Setting::where('key', 'notification_email')->value('value')
                ?: Setting::where('key', 'contact_email')->value('value')
                ?: config('mail.from.address', 'solusicodekita@gmail.com');

            // 1. Send notification to admin / tech lead
            Mail::to($notificationEmail)->send(new NewLeadNotificationMail($lead));

            // 2. Send automated confirmation to the client
            if (!empty($lead->email)) {
                Mail::to($lead->email)->send(new LeadConfirmationMail($lead));
            }
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email notifikasi konsultasi: ' . $e->getMessage(), [
                'lead_id' => $lead->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->back()->with('success', 'Terima kasih! Tim konsultan Solkit Tech akan segera menghubungi Anda dalam 1x24 jam.');
    }
}

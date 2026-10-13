<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(): Response
    {
        $settingsRaw = Setting::all();
        $settings = $settingsRaw->pluck('value', 'key')->toArray();

        $logoSetting = $settingsRaw->firstWhere('key', 'site_logo');
        $settings['site_logo_url'] = $logoSetting ? $logoSetting->image_url : null;

        // Default primary color fallback jika belum diset
        if (empty($settings['primary_color'])) {
            $settings['primary_color'] = '#4f46e5'; // Indigo-600
        }

        // Email fallbacks
        $settings['contact_email'] = $settings['contact_email'] ?? 'solusicodekita@gmail.com';
        $settings['notification_email'] = $settings['notification_email'] ?? 'solusicodekita@gmail.com';

        $mailConfig = [
            'mailer' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'username' => config('mail.mailers.smtp.username'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'has_password' => !empty(config('mail.mailers.smtp.password')),
        ];

        return Inertia::render('Admin/Settings', [
            'settings' => $settings,
            'mail_config' => $mailConfig,
        ]);
    }

    /**
     * Update the global settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'site_name' => 'required|string|max:100',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'primary_color' => ['nullable', 'string', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i'],
            'whatsapp_number' => 'nullable|string|max:25',
            'contact_email' => 'nullable|email|max:100',
            'notification_email' => 'nullable|email|max:100',
            'company_address' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
        ]);

        if ($request->hasFile('site_logo')) {
            $oldLogoSetting = Setting::where('key', 'site_logo')->first();
            $oldLogoPath = $oldLogoSetting ? $oldLogoSetting->value : null;

            if ($oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                Storage::disk('public')->delete($oldLogoPath);
            }

            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::setValue('site_logo', $path, 'image');
        }

        Setting::setValue('site_name', $validatedData['site_name'], 'text');
        Setting::setValue('site_tagline', $validatedData['site_tagline'] ?? 'Modern Digital Agency & Software House', 'text');
        Setting::setValue('site_description', $validatedData['site_description'] ?? '', 'textarea');
        Setting::setValue('primary_color', $validatedData['primary_color'] ?? '#4f46e5', 'color');
        Setting::setValue('whatsapp_number', $validatedData['whatsapp_number'] ?? '', 'text');
        Setting::setValue('contact_email', $validatedData['contact_email'] ?? 'solusicodekita@gmail.com', 'text');
        Setting::setValue('notification_email', $validatedData['notification_email'] ?? 'solusicodekita@gmail.com', 'text');
        Setting::setValue('company_address', $validatedData['company_address'] ?? '', 'text');

        return redirect()->back()->with('success', 'Konfigurasi website berhasil diperbarui.');
    }

    /**
     * Send a test email via configured SMTP.
     */
    public function testMail(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'test_email' => 'required|email|max:100',
        ]);

        try {
            Mail::raw("Halo Tim SOLKIT (Solusi Kode Kita)!\n\nIni adalah email uji coba (SMTP Test) yang dikirim dari Panel Admin Solkit Tech.\nKonfigurasi SMTP Google (smtp.gmail.com:587) berhasil terhubung dan dapat mengirimkan email dengan sempurna!\n\nWaktu pengujian: " . now()->format('d M Y, H:i:s') . " WIB.", function ($message) use ($validated) {
                $message->to($validated['test_email'])
                        ->subject('[SOLKIT] Konfirmasi Pengujian SMTP Berhasil');
            });

            return redirect()->back()->with('success', 'Email uji coba berhasil dikirim ke ' . $validated['test_email'] . '!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email test: ' . $e->getMessage());
        }
    }
}

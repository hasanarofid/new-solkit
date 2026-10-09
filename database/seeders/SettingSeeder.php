<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'SOLKIT',
                'type' => 'text',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Solusi Kode Kita — High-End Software Engineering & Digital Studio',
                'type' => 'text',
            ],
            [
                'key' => 'site_description',
                'value' => 'SOLKIT (Solusi Kode Kita) adalah software house modern yang merekayasa arsitektur cloud, SaaS enterprise, aplikasi mobile terukur, dan integrasi AI dengan standar agensi teknologi kelas dunia.',
                'type' => 'textarea',
            ],
            [
                'key' => 'primary_color',
                'value' => '#0052FF', // Biru Elektrik Resmi SOLKIT
                'type' => 'color',
            ],
            [
                'key' => 'site_logo',
                'value' => 'settings/solkit-dark.svg',
                'type' => 'image',
            ],
            [
                'key' => 'whatsapp_number',
                'value' => '6281234567890',
                'type' => 'text',
            ],
            [
                'key' => 'contact_email',
                'value' => 'partner@solkit.tech',
                'type' => 'text',
            ],
            [
                'key' => 'company_address',
                'value' => 'Equity Tower Lv 28, SCBD Jakarta Selatan, Indonesia',
                'type' => 'text',
            ],
            [
                'key' => 'meta_title',
                'value' => 'SOLKIT (Solusi Kode Kita) | Software House Indonesia & High-End Software Engineering',
                'type' => 'text',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'software house indonesia, jasa pembuatan website profesional, jasa pembuatan aplikasi mobile android ios, software house jakarta, konsultan arsitektur web, custom erp indonesia, enterprise saas development, web developer laravel vue inertia, integrasi ai llm, high performance software house, solkit, solusi kode kita, jasa software house terpercaya',
                'type' => 'textarea',
            ],
            [
                'key' => 'geo_region',
                'value' => 'ID-JK',
                'type' => 'text',
            ],
            [
                'key' => 'geo_placename',
                'value' => 'Jakarta Selatan, DKI Jakarta, Indonesia',
                'type' => 'text',
            ],
            [
                'key' => 'geo_position',
                'value' => '-6.2243;106.8097',
                'type' => 'text',
            ],
            [
                'key' => 'geo_icbm',
                'value' => '-6.2243, 106.8097',
                'type' => 'text',
            ],
            [
                'key' => 'google_site_verification',
                'value' => 'E-tyAYsOQMugMAc2KAkBnFdVc9mAbKbId7ZOAK3gpDQ',
                'type' => 'text',
            ],
            [
                'key' => 'og_image',
                'value' => '/images/solkit-dark.png',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                ]
            );
        }
    }
}

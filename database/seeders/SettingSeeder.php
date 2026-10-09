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
                'value' => 'Solkit Tech',
                'type' => 'text',
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Enterprise Digital Engineering & Modern Software House',
                'type' => 'text',
            ],
            [
                'key' => 'site_description',
                'value' => 'Solkit Tech adalah mitra rekayasa perangkat lunak terpilih untuk startup berkembang dan korporasi. Kami merancang custom web platform, mobile apps, SaaS, dan integrasi kecerdasan buatan (AI) berkinerja tinggi.',
                'type' => 'textarea',
            ],
            [
                'key' => 'primary_color',
                'value' => '#4f46e5', // Modern Indigo Accent
                'type' => 'color',
            ],
            [
                'key' => 'whatsapp_number',
                'value' => '6281234567890',
                'type' => 'text',
            ],
            [
                'key' => 'contact_email',
                'value' => 'hello@solkit.tech',
                'type' => 'text',
            ],
            [
                'key' => 'company_address',
                'value' => 'One Pacific Place Suite 1204, SCBD Jakarta Selatan, Indonesia',
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

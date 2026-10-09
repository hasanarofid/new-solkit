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

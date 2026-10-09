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
                'value' => 'SOLKIT (Solusi Kode Kita) adalah software house modern berbasis di Surabaya, Jawa Timur yang merekayasa arsitektur cloud, SaaS enterprise, aplikasi mobile terukur (iOS & Android), dan integrasi AI dengan standar agensi teknologi kelas dunia.',
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
                'value' => '628814959247',
                'type' => 'text',
            ],
            [
                'key' => 'contact_email',
                'value' => 'partner@solkit.tech',
                'type' => 'text',
            ],
            [
                'key' => 'company_address',
                'value' => 'Surabaya, Jawa Timur, Indonesia',
                'type' => 'text',
            ],
            [
                'key' => 'meta_title',
                'value' => 'SOLKIT (Solusi Kode Kita) | Software House Surabaya, Jawa Timur & Enterprise Engineering',
                'type' => 'text',
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'software house surabaya, jasa pembuatan website surabaya, jasa aplikasi mobile surabaya, web developer surabaya, software house jawa timur, jasa pembuatan website jawa timur, konsultan it surabaya, custom erp surabaya, software house indonesia, jasa pembuatan website profesional, jasa pembuatan aplikasi mobile android ios, software house jakarta, konsultan arsitektur web, custom erp indonesia, enterprise saas development, web developer laravel vue inertia, integrasi ai llm, high performance software house, solkit, solusi kode kita, jasa software house terpercaya',
                'type' => 'textarea',
            ],
            [
                'key' => 'geo_region',
                'value' => 'ID-JI',
                'type' => 'text',
            ],
            [
                'key' => 'geo_placename',
                'value' => 'Surabaya, Jawa Timur, Indonesia',
                'type' => 'text',
            ],
            [
                'key' => 'geo_position',
                'value' => '-7.2575;112.7521',
                'type' => 'text',
            ],
            [
                'key' => 'geo_icbm',
                'value' => '-7.2575, 112.7521',
                'type' => 'text',
            ],
            [
                'key' => 'google_site_verification',
                'value' => 'A1v60g8eChf7ZcmSIzFO9lLZVvjDjFOHAmZcnby5WC0',
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

<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

class PageAndSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homePage = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Solkit Tech | Modern Software House & Digital Studio',
                'meta_description' => 'Solkit Tech merekayasa sistem perangkat lunak kustom berkinerja tinggi, SaaS scalable, mobile apps native/cross-platform, dan integrasi Enterprise AI.',
                'is_active' => true,
            ]
        );

        $sections = [
            [
                'key' => 'hero',
                'title' => 'Hero Banner',
                'order' => 1,
                'content' => [
                    'badge' => '🚀 Terbuka untuk Kolaborasi Proyek Baru',
                    'headline' => 'Kami Merekayasa Produk Digital Berkinerja Tinggi & Siap Skala',
                    'subheadline' => 'Dari ide rintisan hingga arsitektur korporat bernilai miliaran rupiah. Solkit Tech menghadirkan rekayasa software presisi dengan Laravel, Vue 3, Mobile Apps, dan Enterprise AI.',
                    'cta_primary' => 'Konsultasi Gratis',
                    'cta_secondary' => 'Eksplorasi Studi Kasus',
                    'stats' => [
                        ['label' => 'Proyek Terselesaikan', 'value' => '45+'],
                        ['label' => 'SLA Uptime Sistem', 'value' => '99.98%'],
                        ['label' => 'Pengguna Aktif Terlayani', 'value' => '1.2M+'],
                        ['label' => 'Tingkat Retensi Klien', 'value' => '98%'],
                    ],
                ],
            ],
            [
                'key' => 'tech_stack',
                'title' => 'Teknologi & Ekosistem',
                'order' => 2,
                'content' => [
                    'badge' => 'TECH EXCELLENCE',
                    'title' => 'Ekosistem Teknologi Terkini yang Kami Gunakan',
                    'description' => 'Kami hanya memilih stack modern yang teruji dalam stabilitas, skalabilitas, dan kecepatan deployment.',
                    'stacks' => [
                        ['name' => 'Laravel 11', 'category' => 'Backend & API', 'desc' => 'Arsitektur backend tangguh & aman'],
                        ['name' => 'Vue 3 & Inertia', 'category' => 'Frontend Architecture', 'desc' => 'Antarmuka reaktif berkecepatan tinggi'],
                        ['name' => 'Flutter & React Native', 'category' => 'Mobile Ecosystem', 'desc' => 'Fluid 60fps native experience'],
                        ['name' => 'Python & Gemini AI', 'category' => 'Artificial Intelligence', 'desc' => 'RAG & agentic automation'],
                        ['name' => 'PostgreSQL & Redis', 'category' => 'Data & Caching', 'desc' => 'In-memory ultra fast throughput'],
                        ['name' => 'Docker & Kubernetes', 'category' => 'Cloud & DevOps', 'desc' => 'Containerization siap skala horizontal'],
                        ['name' => 'Amazon Web Services', 'category' => 'Cloud Infrastructure', 'desc' => 'Serverless & high availability cluster'],
                        ['name' => 'Tailwind CSS', 'category' => 'Design System', 'desc' => 'Atomic utility UI/UX Pro Max'],
                    ],
                ],
            ],
            [
                'key' => 'workflow',
                'title' => 'Alur Kerja Pengembangan',
                'order' => 3,
                'content' => [
                    'badge' => 'METODOLOGI KAMI',
                    'title' => 'Bagaimana Kami Mewujudkan Visi Digital Anda',
                    'description' => 'Proses terstruktur berbasis Agile Sprint yang transparan, terukur, dan bebas dari kejutan tak terduga.',
                    'steps' => [
                        [
                            'step' => '01',
                            'title' => 'Discovery & Tech Architecture',
                            'description' => 'Kami mendalami model bisnis Anda, memetakan risiko, menyusun PRD detail, dan menentukan skema database optimal.',
                        ],
                        [
                            'step' => '02',
                            'title' => 'UI/UX Pro Max & Prototyping',
                            'description' => 'Perancangan wireframe interaktif di Figma lengkap dengan Design System yang berfokus pada conversion & kemudahan pakai.',
                        ],
                        [
                            'step' => '03',
                            'title' => 'Agile Sprint Development',
                            'description' => 'Penulisan kode clean & maintainable dengan automated testing, code review mingguan, dan demo progress rutin.',
                        ],
                        [
                            'step' => '04',
                            'title' => 'QA, Security Audit & Launch',
                            'description' => 'Pengujian performa beban tinggi, penetration testing OWASP, setup CI/CD pipeline, dan asistensi go-live 24/7.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'testimonials',
                'title' => 'Testimoni Klien',
                'order' => 4,
                'content' => [
                    'badge' => 'KEPERCAYAAN KLIEN',
                    'title' => 'Apa Kata Para Pemimpin Bisnis Tentang Solkit Tech',
                    'items' => [
                        [
                            'name' => 'Reza Pratama',
                            'role' => 'Chief Technology Officer',
                            'company' => 'Artha Digital Mandiri',
                            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=200&auto=format&fit=crop',
                            'comment' => 'Solkit Tech bukan hanya sekadar vendor, mereka adalah partner teknis sejati. Tim mereka berhasil membangun sistem core payment kami dengan nol downtime.',
                        ],
                        [
                            'name' => 'Diana Stephanie',
                            'role' => 'VP of Product',
                            'company' => 'Kargo Nusantara Logistics',
                            'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=200&auto=format&fit=crop',
                            'comment' => 'Aplikasi driver Flutter dan dashboard dispatch web yang dibangun Solkit memangkas biaya BBM kami sebesar 22% dalam 3 bulan pertama pengoperasian.',
                        ],
                        [
                            'name' => 'Hendro Kusumo',
                            'role' => 'Managing Director',
                            'company' => 'Sinar Niaga Global',
                            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=200&auto=format&fit=crop',
                            'comment' => 'Transparansi proses sprint dan kualitas kode mereka luar biasa. Sistem e-procurement kami lolos audit kepatuhan korporat dengan nilai sempurna.',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'cta',
                'title' => 'Call To Action',
                'order' => 5,
                'content' => [
                    'headline' => 'Siap Mentransformasikan Bisnis Anda Menjadi Pemimpin Digital?',
                    'subheadline' => 'Diskusikan tantangan teknis Anda langsung dengan Tech Lead kami. Dapatkan analisis arsitektur & estimasi timeline tanpa biaya.',
                    'button_text' => 'Jadwalkan Konsultasi Gratis Sekarang',
                ],
            ],
        ];

        foreach ($sections as $sec) {
            Section::updateOrCreate(
                [
                    'page_id' => $homePage->id,
                    'key' => $sec['key'],
                ],
                [
                    'title' => $sec['title'],
                    'order' => $sec['order'],
                    'content' => $sec['content'],
                    'is_active' => true,
                ]
            );
        }
    }
}

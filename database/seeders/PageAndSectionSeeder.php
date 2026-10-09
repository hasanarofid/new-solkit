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
                'title' => 'SOLKIT | Software House Indonesia & Enterprise Software Engineering Studio',
                'meta_description' => 'Software house terpercaya di Indonesia. Kami merekayasa aplikasi web kustom skala enterprise, mobile apps iOS & Android, sistem ERP/POS, arsitektur cloud, dan integrasi Enterprise AI berkinerja tinggi.',
                'is_active' => true,
            ]
        );

        $sections = [
            [
                'key' => 'hero',
                'title' => 'Hero Banner',
                'order' => 1,
                'content' => [
                    'badge' => '🚀 Terbuka untuk Kolaborasi Proyek & Konsultasi Arsitektur',
                    'headline' => 'Kami Merekayasa Produk Digital Berkinerja Tinggi & Siap Skala',
                    'subheadline' => 'Dari rintisan teknologi hingga sistem korporat multinasional. SOLKIT menghadirkan rekayasa software presisi dengan Laravel 11, Vue 3 Inertia, Mobile Apps, dan Enterprise AI terukur.',
                    'cta_primary' => 'Konsultasi Gratis',
                    'cta_secondary' => 'Eksplorasi Studi Kasus',
                    'stats' => [
                        ['label' => 'Proyek Terselesaikan', 'value' => '45+'],
                        ['label' => 'SLA Uptime Sistem', 'value' => '99.99%'],
                        ['label' => 'Pengguna Aktif Terlayani', 'value' => '1.5M+'],
                        ['label' => 'Tingkat Kepuasan Klien', 'value' => '99%'],
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
                    'badge' => 'KEPERCAYAAN KLIEN & MITRA',
                    'title' => 'Apa Kata Para Pemilik Bisnis & Mitra Tentang SOLKIT',
                    'client_brands' => [
                        'Amtech EV Malaysia',
                        'Mr. Lux Indonesia',
                        'Mitra Syiar Baitullah',
                        'Nitajaya Catering Group',
                        'No Limits Training',
                        'Afpro Aquarium',
                        'Gringgo Foundation',
                        'Education Oversight Board',
                    ],
                    'items' => [
                        [
                            'name' => 'Amtech EV Engineering Team',
                            'role' => 'Enterprise SaaS Partner',
                            'company' => 'Amtech EV Malaysia',
                            'avatar' => null,
                            'comment' => 'Sistem cloud dan infrastruktur telemetri hardware yang dibangun tim SOLKIT sangat stabil. Operasional jaringan stasiun pengisian daya EV kami di Malaysia menjadi 100% otomatis, tersinkronisasi, dan berkinerja tinggi.',
                        ],
                        [
                            'name' => 'Direksi Mr. Lux Indonesia',
                            'role' => 'Principal Client',
                            'company' => 'Mr. Lux Indonesia',
                            'avatar' => null,
                            'comment' => 'Sistem ERP kustom yang dikembangkan tim SOLKIT mengubah alur kerja pergudangan, pencatatan surat jalan, dan audit inventaris kami. Efisiensi pengiriman meningkat pesat dengan nol selisih stok.',
                        ],
                        [
                            'name' => 'Tim Eksekutif Mitra Syiar Baitullah',
                            'role' => 'Digital Travel Client',
                            'company' => 'Mitra Syiar Baitullah',
                            'avatar' => null,
                            'comment' => 'Platform travel umroh kami mampu menangani traffic jamaah tinggi dengan kecepatan responsif di bawah 1 detik. Sistem pendaftaran paket dan kemitraan agen nasional berjalan sangat mulus.',
                        ],
                        [
                            'name' => 'Founder Nitajaya Catering',
                            'role' => 'F&B Business Owner',
                            'company' => 'Nitajaya Catering & Resto',
                            'avatar' => null,
                            'comment' => 'Manajemen pesanan katering dan sistem POS kustom dari SOLKIT memangkas waktu operasional staf kami secara signifikan. Penjadwalan pesanan dapur terintegrasi dan akurat tanpa ada pesanan yang terlewat.',
                        ],
                        [
                            'name' => 'Institutional Oversight Officer',
                            'role' => 'Government & Institutional Client',
                            'company' => 'Education Oversight Board',
                            'avatar' => null,
                            'comment' => 'Solusi digital sistem manajemen dan pengawasan sekolah dari tim SOLKIT benar-benar menjawab kendala operasional kami. Transparansi dan akurasi audit meningkat 100%.',
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

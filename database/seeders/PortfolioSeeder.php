<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'Amtech EV: Unified IoT Fleet & EV Charging Network SaaS',
                'slug' => 'amtech-ev-infrastructure-iot-saas',
                'client_name' => 'Amtech EV Malaysia',
                'industry' => 'CleanTech & Smart Mobility IoT',
                'problem' => 'Jaringan stasiun pengisian daya EV (kendaraan listrik) di Malaysia memerlukan pemrosesan telemetri hardware real-time berkapasitas tinggi dan sistem penagihan multi-tenant yang rentan desinkronisasi.',
                'solution' => 'Merekayasa sistem cloud terpadu dengan arsitektur telemetry IoT real-time, microservices auto-reconciliation, dashboard manajemen armada web, dan integrasi payment gateway internasional.',
                'impact_metric' => '100% Otomatisasi Operasional & 99.99% Hardware Sync',
                'tech_stack' => ['Laravel 11', 'Vue 3', 'IoT Telemetry', 'PostgreSQL', 'Docker', 'WebSockets', 'Redis'],
                'thumbnail' => 'portfolios/amtechev.png',
                'project_url' => 'https://amtechev.com/',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Mr. Lux Indonesia: Enterprise Distribution ERP & Inventory Engine',
                'slug' => 'mr-lux-indonesia-enterprise-erp',
                'client_name' => 'Mr. Lux Indonesia',
                'industry' => 'Wholesale & Supply Chain Distribution',
                'problem' => 'Distribusi grosir multi-cabang terhambat oleh pembuatan surat jalan manual, selisih stok gudang berkala, serta ketiadaan audit trail penjualan real-time.',
                'solution' => 'Membangun core enterprise ERP kustom yang mencakup otomatisasi penerbitan surat jalan legal, pelacakan inventaris multi-warehouse FIFO, analitik omzet grosir, dan kontrol akses berjenjang.',
                'impact_metric' => '3.8x Kecepatan Proses Gudang & 0% Selisih Stok',
                'tech_stack' => ['Laravel', 'Vue.js', 'Inertia.js', 'MySQL', 'Tailwind CSS', 'Alpine.js'],
                'thumbnail' => 'portfolios/mrluxindonesia.png',
                'project_url' => 'https://hasanarofid.site/portofolio',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Mitra Syiar Baitullah: High-Traffic Umrah & Hajj Digital Ecosystem',
                'slug' => 'mitra-syiar-baitullah-hajj-travel-platform',
                'client_name' => 'Mitra Syiar Baitullah',
                'industry' => 'Travel Tech & Religious Tourism',
                'problem' => 'Pendaftaran ribuan jamaah, verifikasi jadwal keberangkatan dinamis, serta rekrutmen agen kemitraan nasional memerlukan platform web berkecepatan tinggi dan mobile-first.',
                'solution' => 'Mengembangkan portal publik berkinerja tinggi dengan sistem listing paket ibadah real-time, modul pendaftaran agen mitra terintegrasi, dan sinkronisasi kuota keberangkatan.',
                'impact_metric' => '+280% Pertumbuhan Booking & Page Load < 0.8s',
                'tech_stack' => ['PHP Modern', 'Tailwind CSS', 'JavaScript ES6', 'Technical SEO', 'Cloudflare CDN'],
                'thumbnail' => 'portfolios/mitrasyiarbaitullah.png',
                'project_url' => 'https://www.mitrasyiarbaitullah.com/',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'EduTrack: Multi-School Monitoring & Academic Oversight System',
                'slug' => 'edutrack-school-management-system',
                'client_name' => 'Education Oversight Board',
                'industry' => 'EdTech & Public Administration',
                'problem' => 'Pemantauan presensi siswa, kedisiplinan, catatan konseling, dan audit kurikulum di berbagai unit sekolah dilakukan terfragmentasi tanpa visibilitas data terpusat.',
                'solution' => 'Membangun sistem pengawasan terpusat dengan dashboard analitik perilaku siswa real-time, modul evaluasi konseling, dan pelaporan audit instansional otomatis.',
                'impact_metric' => '100% Transparansi Audit & Hemat 120 Jam/Bulan',
                'tech_stack' => ['Laravel', 'Bootstrap 5', 'Tailwind CSS', 'MySQL', 'Chart.js', 'RBAC Security'],
                'thumbnail' => 'portfolios/point-sekolah.png',
                'project_url' => 'https://hasanarofid.site/portofolio',
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Nitajaya: Integrated Cloud POS & Catering Order Management',
                'slug' => 'nitajaya-catering-pos-management',
                'client_name' => 'Nitajaya Catering & Resto',
                'industry' => 'Food & Beverage (F&B) Hospitality',
                'problem' => 'Pencatatan pesanan catering acara skala besar bercampur dengan kasir harian, mengakibatkan bentrok jadwal pengiriman dan kesulitan rekapitulasi kebutuhan bahan baku.',
                'solution' => 'Sistem POS kustom dan manajemen pesanan katering terintegrasi dengan penjadwalan timeline produksi dapur, perhitungan otomatis bahan baku, dan laporan kasir harian.',
                'impact_metric' => '+35% Kapasitas Pesanan Harian & Zero Missed Order',
                'tech_stack' => ['PHP Modern', 'MySQL', 'JavaScript', 'Responsive UI', 'Thermal Receipt Printing'],
                'thumbnail' => 'portfolios/nitajaya.png',
                'project_url' => 'https://hasanarofid.site/portofolio',
                'is_featured' => false,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'No Limits Training: High-Conversion Athlete Coaching Platform',
                'slug' => 'no-limits-training-coaching-platform',
                'client_name' => 'No Limits Training Indonesia',
                'industry' => 'Sports Tech & Professional Fitness',
                'problem' => 'Platform sebelumnya lambat dan tidak responsif di perangkat mobile, dengan tingkat bounce rate tinggi dan kesulitan konversi lead ke program pelatihan privat.',
                'solution' => 'Merancang ulang UI/UX kelas dunia dengan animasi interaktif modern, micro-interactions, mobile-first performance, dan alur pendaftaran program pelatihan yang mulus.',
                'impact_metric' => '+65% Conversion Rate & 99/100 Lighthouse Score',
                'tech_stack' => ['Modern Web Architecture', 'Tailwind CSS', 'Vite', 'Interaction Design', 'Analytics'],
                'thumbnail' => 'portfolios/nolimitstraining.png',
                'project_url' => 'https://nolimitstraining.id/',
                'is_featured' => false,
                'is_active' => true,
                'order' => 6,
            ],
            [
                'title' => 'Afpro Aquarium: Interactive Digital Showcase & Product Engine',
                'slug' => 'afpro-aquarium-product-showcase',
                'client_name' => 'Afpro Aquarium Indonesia',
                'industry' => 'Aquascaping & Specialty Retail',
                'problem' => 'Katalog produk aquascape dan ekosistem akuarium spesifikasi tinggi membutuhkan visualisasi interaktif yang elegan untuk menarik kolektor dan penghobi premium.',
                'solution' => 'Membangun website katalog interaktif dengan galeri visual high-definition, filter spesifikasi produk instan, dan integrasi direct inquiry WhatsApp terotomatisasi.',
                'impact_metric' => '2.4x Peningkatan Inquiry Pembeli Tertarget',
                'tech_stack' => ['HTML5 / CSS3', 'Modern JS', 'Custom Filtering', 'Asset Optimization'],
                'thumbnail' => 'portfolios/afpro1.png',
                'project_url' => 'https://afproaquarium.com/',
                'is_featured' => false,
                'is_active' => true,
                'order' => 7,
            ],
            [
                'title' => 'Gringgo: Community Waste Management & Sustainability Tech',
                'slug' => 'gringgo-community-waste-tech',
                'client_name' => 'Gringgo Indonesia Foundation',
                'industry' => 'CleanTech & Environmental Impact',
                'problem' => 'Inisiatif pengelolaan sampah masyarakat memerlukan platform digital yang edukatif dan mampu menghubungkan bank sampah dengan jejaring daur ulang.',
                'solution' => 'Mengembangkan platform publik interaktif yang menyajikan data dampak daur ulang, edukasi pilah sampah, dan pemberdayaan komunitas lingkungan lokal.',
                'impact_metric' => 'Mendukung Edukasi & Jejak Daur Ulang Komunitas',
                'tech_stack' => ['Web Architecture', 'UI/UX Human-Centered', 'GIS Mapping Integration', 'Cloud Hosting'],
                'thumbnail' => 'portfolios/gringgo.png',
                'project_url' => 'https://gringgo.org/',
                'is_featured' => false,
                'is_active' => true,
                'order' => 8,
            ],
        ];

        foreach ($portfolios as $data) {
            Portfolio::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}

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
                'title' => 'ArthaPay: Enterprise Payment Gateway & Core Ledger',
                'slug' => 'arthapay-enterprise-payment-gateway',
                'client_name' => 'PT Artha Digital Mandiri',
                'industry' => 'Financial Technology',
                'problem' => 'Sistem pemrosesan transaksi lama sering mengalami timeout saat lonjakan payload gajian, dengan rekonsiliasi manual yang memakan waktu hingga 14 jam per hari.',
                'solution' => 'Membangun arsitektur microservices event-driven dengan Laravel 11, Redis cluster, dan Apache Kafka untuk memproses antrean transaksi instan secara idempotent.',
                'impact_metric' => '+400% Kecepatan Transaksi & 99.99% Uptime',
                'tech_stack' => ['Laravel 11', 'Vue 3', 'Redis', 'PostgreSQL', 'Docker', 'AWS'],
                'thumbnail' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop',
                'project_url' => 'https://example.com/case/arthapay',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'KargoTrack: IoT Fleet Management & Logistics SaaS',
                'slug' => 'kargotrack-iot-fleet-management',
                'client_name' => 'Kargo Nusantara Logistics',
                'industry' => 'Logistics & Supply Chain',
                'problem' => 'Pelacakan 2.500+ armada truk ekspedisi tersebar tanpa telemetri real-time, menyebabkan pemborosan bahan bakar 18% dan keterlambatan pengiriman paket.',
                'solution' => 'Mengembangkan dashboard web real-time dengan Vue 3 Inertia + WebSockets dan aplikasi mobile Flutter driver dengan offline GPS caching serta rute navigasi cerdas.',
                'impact_metric' => '-22% Biaya BBM & 3.5x Efisiensi Dispatcer',
                'tech_stack' => ['Laravel', 'Vue 3', 'Flutter', 'WebSockets', 'Google Maps API'],
                'thumbnail' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=1200&auto=format&fit=crop',
                'project_url' => 'https://example.com/case/kargotrack',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'MedikaVision: AI Clinical Diagnostics & Radiology RAG',
                'slug' => 'medikavision-ai-clinical-diagnostics',
                'client_name' => 'Medika Health Network',
                'industry' => 'Healthcare & HealthTech',
                'problem' => 'Radiolog dan dokter spesialis membutuhkan waktu rata-rata 45 menit untuk membaca dan menyusun laporan ringkasan rekam medis pasien kompleks.',
                'solution' => 'Mengintegrasikan pipeline Computer Vision dan LLM RAG multi-modal untuk pra-analisis citra medis serta penyusunan draf resume medis otomatis yang aman sesuai HIPAA.',
                'impact_metric' => 'Pangkas Waktu Diagnosa dari 45 ke 8 Menit',
                'tech_stack' => ['Python FastAPI', 'Gemini AI API', 'Vue 3', 'Laravel', 'PostgreSQL'],
                'thumbnail' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=1200&auto=format&fit=crop',
                'project_url' => 'https://example.com/case/medikavision',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'ProcureHub: B2B E-Procurement & Tender Portal',
                'slug' => 'procurehub-b2b-eprocurement-portal',
                'client_name' => 'Sinar Niaga Agro Tbk',
                'industry' => 'Manufacturing & Agriculture',
                'problem' => 'Proses pengadaan vendor barang senilai ratusan miliar masih menggunakan formulir kertas dan email manual, rentan terhadap dispute audit internal.',
                'solution' => 'Platform e-procurement terpusat dengan multi-level approval matrix, digital signature, audit trail anti-tamper, dan integrasi modul SAP ERP.',
                'impact_metric' => 'Efisiensi Siklus Pengadaan 65% Lebih Cepat',
                'tech_stack' => ['Laravel 11', 'Vue 3', 'Tailwind CSS', 'Inertia.js', 'MySQL'],
                'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop',
                'project_url' => 'https://example.com/case/procurehub',
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($portfolios as $port) {
            Portfolio::updateOrCreate(
                ['slug' => $port['slug']],
                $port
            );
        }
    }
}

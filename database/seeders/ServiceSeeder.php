<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Custom Web & Enterprise SaaS',
                'slug' => 'custom-web-enterprise-saas',
                'tagline' => 'High-Performance & Scalable Web Applications',
                'description' => 'Membangun aplikasi web kustom berskala besar dengan arsitektur modern (Laravel, Vue 3, Inertia, Node.js) yang cepat, aman, dan siap menangani jutaan transaksi.',
                'icon' => 'Layout',
                'features' => [
                    'Arsitektur Multi-Tenant & Scalable Microservices',
                    'Real-time Dashboard & Analitik Data Cepat',
                    'Keamanan Enkripsi Enterprise & Perlindungan OWASP',
                    'Integrasi Payment Gateway & Open Banking API',
                ],
                'tech_stack' => ['Laravel 11', 'Vue 3', 'Inertia.js', 'PostgreSQL', 'Redis', 'Docker'],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Mobile App Development (iOS & Android)',
                'slug' => 'mobile-app-development',
                'tagline' => 'Native & Cross-Platform Fluid Experience',
                'description' => 'Pembuatan aplikasi mobile responsif dengan performa native menggunakan Flutter dan React Native. Antarmuka halus 60fps dengan offline-first synchronization.',
                'icon' => 'Smartphone',
                'features' => [
                    'Cross-platform codebase (iOS & Android)',
                    'Push Notification & Background Geolocation',
                    'Integrasi Biometrik & Secure Storage',
                    'Publikasi & Maintenance App Store & Play Store',
                ],
                'tech_stack' => ['Flutter', 'React Native', 'Kotlin', 'Swift', 'Firebase'],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'AI Integration & Intelligent Automation',
                'slug' => 'ai-integration-automation',
                'tagline' => 'Transformative Enterprise AI & Machine Learning',
                'description' => 'Integrasikan model Large Language Model (Gemini, OpenAI, Claude), agen AI mandiri, dan automated data pipeline ke dalam alur kerja bisnis Anda untuk memotong biaya operasional.',
                'icon' => 'Cpu',
                'features' => [
                    'Custom AI Chatbot & Internal Knowledge Base RAG',
                    'Automated Document Processing & OCR Extraction',
                    'Predictive Analytics & Recommendation Engine',
                    'Agentic Workflow Automation untuk Proses Berulang',
                ],
                'tech_stack' => ['Python', 'LangChain', 'OpenAI API', 'Gemini AI', 'Vector DB', 'FastAPI'],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Cloud Infrastructure & DevOps CI/CD',
                'slug' => 'cloud-infrastructure-devops',
                'tagline' => 'Zero-Downtime Deployment & Auto-Scaling',
                'description' => 'Perancangan arsitektur cloud tangguh (AWS, GCP, DigitalOcean) dengan automated pipeline CI/CD, monitoring 24/7, dan mitigasi disaster recovery.',
                'icon' => 'Cloud',
                'features' => [
                    'Infrastructure as Code (Terraform & Ansible)',
                    'Automated CI/CD (GitHub Actions, GitLab CI)',
                    'Kubernetes & Docker Container Orchestration',
                    'High Availability & Disaster Recovery Setup',
                ],
                'tech_stack' => ['AWS', 'Google Cloud', 'Docker', 'Kubernetes', 'Terraform', 'GitHub Actions'],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'UI/UX & Digital Product Design',
                'slug' => 'ui-ux-digital-product-design',
                'tagline' => 'User-Centric & Conversion-Optimized Interface',
                'description' => 'Riset mendalam, wireframing, interactive prototyping, dan perancangan Design System komprehensif yang menjamin user satisfaction dan tingkat konversi maksimal.',
                'icon' => 'Figma',
                'features' => [
                    'User Journey Mapping & Competitive Analysis',
                    'High-Fidelity Interactive Prototype (Figma)',
                    'Design System & Component Token Standard',
                    'Usability Testing & Conversion Rate Optimization',
                ],
                'tech_stack' => ['Figma', 'FigJam', 'Design Tokens', 'Tailwind CSS', 'Storybook'],
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(
                ['slug' => $srv['slug']],
                $srv
            );
        }
    }
}

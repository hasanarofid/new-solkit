<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleGeneratorService
{
    protected ?string $apiKey;
    protected array $models = [
        'gemini-flash-latest',
        'gemini-2.5-flash-lite',
        'gemini-flash-lite-latest',
        'gemini-3.1-flash-lite'
    ];

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key') ?: env('GEMINI_API_KEY');
    }

    /**
     * Curated high-value technical topics targeting real developer search intent & high E-E-A-T standards.
     */
    protected array $curatedTopics = [
        'Optimalisasi Query SQL pada Skala 10 Juta Transaksi: Indexing B-Tree, Explain Analyze, dan Partitioning',
        'Panduan Implementasi Event-Driven Architecture Menggunakan Redis & Apache Kafka pada Aplikasi FinTech',
        'Cara Mengatasi Memory Leak pada Single Page Application Vue 3 dan Inertia.js di Lingkungan Produksi',
        'Strategi Menurunkan LCP dan INP (Core Web Vitals) di Bawah 1 Detik untuk Skor 100 Google Lighthouse',
        'Panduan Zero-Downtime Deployment Menggunakan Docker Swarm, Traefik, dan GitHub Actions CI/CD',
        'Pengamanan REST API Laravel 11 dari Serangan Replay Attack, Brute Force, dan IDOR (Insecure Direct Object References)',
        'Arsitektur Multi-Tenant SaaS: Perbandingan Database Per Tenant vs Shared Database dengan Row-Level Security',
        'Implementasi Retrieval Augmented Generation (RAG) untuk Dokumentasi Enterprise Menggunakan Python & LLM',
        'Strategi Multi-Tier Caching dengan Edge Cloudflare, Reverse Proxy Nginx, dan In-Memory Redis Cluster',
        'Cara Membangun Sistem POS & Inventory Real-Time dengan WebSockets dan Sinkronisasi Offline-First',
        'Panduan Clean Architecture & Domain-Driven Design (DDD) pada Laravel untuk Aplikasi Skala Menengah ke Atas',
        'Pencegahan N+1 Query Problem dan Memory Spike pada Eloquent ORM di Lingkungan High-Concurrency',
        'Panduan Lengkap Structured Data Schema.org (Article, TechArticle, FAQPage) untuk Meningkatkan CTR Google',
        'Optimalisasi Biaya Cloud Infrastructure (AWS / GCP) Hingga 40% Tanpa Mengorbankan High Availability 99.99%',
        'Teknik State Management Reaktif & Form Validation Kompleks pada Vue 3 Composition API',
        'Panduan Migrasi Database Relasional MySQL ke PostgreSQL Tanpa Downtime Menggunakan Logical Replication',
        'Membangun Microservices Resilient dengan Circuit Breaker Pattern dan Dead Letter Queue',
        'Strategi Backup Database Otomatis Terenkripsi ke Multi-Cloud Storage dengan Notifikasi Telegram/Slack',
        'Panduan Keamanan OWASP Top 10 untuk Aplikasi Web Modern: Pencegahan XSS, SQLi, dan Broken Access Control',
        'Membangun Aplikasi Mobile Fluid 60fps dengan Flutter: Arsitektur BLoC, Caching, dan Native Bridge'
    ];

    /**
     * Generate and save a high-quality article into posts table.
     *
     * @param string|null $customTopic
     * @return Post|null
     */
    public function generateArticle(?string $customTopic = null): ?Post
    {
        if (empty($this->apiKey)) {
            Log::error('Gemini API key is not configured in services.gemini.api_key or GEMINI_API_KEY');
            return null;
        }

        $topic = $customTopic ?: $this->selectTopic();
        $prompt = $this->buildPrompt($topic);

        $generatedData = $this->callGemini($prompt);
        if (!$generatedData || empty($generatedData['title']) || empty($generatedData['content'])) {
            Log::error("Failed to generate article data from Gemini for topic: {$topic}");
            return null;
        }

        // Resolve or create category
        $categoryName = $generatedData['category_name'] ?? 'Teknologi & Rekayasa Web';
        $categorySlug = Str::slug($categoryName);
        $category = Category::firstOrCreate(
            ['slug' => $categorySlug],
            ['name' => $categoryName]
        );

        $title = trim($generatedData['title']);
        $slug = Str::slug($title);

        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-" . $counter++;
        }

        $post = Post::create([
            'category_id' => $category->id,
            'title' => $title,
            'slug' => $slug,
            'content' => $generatedData['content'],
            'image' => null,
            'status' => 'published',
            'is_featured' => !empty($generatedData['is_featured']),
        ]);

        Log::info("Successfully generated article: {$post->title} (ID: {$post->id})");

        return $post;
    }

    /**
     * Pick a fresh topic that hasn't been used yet.
     */
    protected function selectTopic(): string
    {
        $existingTitles = Post::pluck('title')->toArray();

        $available = array_filter($this->curatedTopics, function ($t) use ($existingTitles) {
            foreach ($existingTitles as $title) {
                // Check similarity with beginning of topic
                if (stripos($title, substr($t, 0, 20)) !== false) {
                    return false;
                }
            }
            return true;
        });

        if (empty($available)) {
            // Return random topic with timestamp variation
            return $this->curatedTopics[array_rand($this->curatedTopics)];
        }

        return $available[array_rand($available)];
    }

    /**
     * Build rich E-E-A-T AdSense compliant prompt.
     */
    protected function buildPrompt(string $topic): string
    {
        return <<<PROMPT
Anda adalah Principal Software Architect di SOLKIT (Solusi Kode Kita) dengan pengalaman 12+ tahun merancang arsitektur sistem enterprise, cloud scalable, dan aplikasi modern.

Tulis artikel panduan teknis mendalam (in-depth technical guide), otoritatif, solutif, dan ramah Google AdSense (memenuhi standar E-E-A-T: Experience, Expertise, Authoritativeness, Trustworthiness) tentang topik:
"{$topic}"

ATURAN STRUKTUR & KUALITAS KONTEN (Anti-AI Cliché & Standar Editorial Tinggi):
1. Format output WAJIB JSON valid murni (tanpa tanda ```json atau markdown codeblock di luar JSON).
2. JSON harus berisi 4 field:
   - "title": Judul artikel spesifik, memikat, solutif, dan natural (maksimal 70 karakter).
   - "category_name": Pilih salah satu: "Arsitektur Web", "Backend & Database", "DevOps & Cloud Infrastructure", "Keamanan Siber", atau "Mobile & Frontend".
   - "is_featured": boolean (true/false).
   - "content": Isi artikel lengkap dalam format semantic HTML bersih (panjang 1.200 - 1.800 kata).

STRUKTUR HTML WAJIB DI DALAM FIELD "content":
- <h2>1. Latar Belakang & Urgensi Masalah di Lingkungan Produksi</h2>
  (Jelaskan skenario nyata mengapa masalah ini terjadi pada sistem bisnis yang sedang berkembang).
- <h2>2. Analisis Akar Masalah (Root Cause) & Mengapa Solusi Konvensional Gagal</h2>
  (Pembahasan teknis mendalam tentang bottleneck, race condition, atau kesalahan desain umum).
- <h2>3. Panduan Solusi Teknis Langkah Demi Langkah</h2>
  (Wajib menyertakan minimal 2 blok kode nyata yang siap pakai menggunakan <pre><code class="language-php"> atau <code class="language-javascript"> atau <code class="language-sql">, dilengkapi penjelasan baris demi baris).
- <h2>4. Studi Kasus Implementasi & Benchmark Performa</h2>
  (Bisa menyertakan tabel komparasi menggunakan <table>, <thead>, <tbody> sebelum vs sesudah optimasi).
- <h2>5. Best Practices & Kesalahan Fatal yang Harus Dihindari</h2>
  (Gunakan <blockquote> untuk tips kritis dari pengalaman praktisi lapangan).
- <h2>6. Pertanyaan Umum yang Sering Diajukan (FAQ Teknis)</h2>
  (Sertakan minimal 3 pertanyaan dan jawaban menggunakan <h3> dan <p>).
- <h2>7. Kesimpulan & Rekomendasi Arsitektur Tim SOLKIT</h2>
  (Ringkasan takeaways dan saran implementasi bertahap).

PENTING:
- Hindari bahasa klise AI seperti "Di era digital saat ini", "Dalam dunia modern", "Tak dapat dipungkiri".
- Gunakan gaya bahasa profesional, lugas, teknis, dan mengalir seperti tulisan insinyur senior di engineering blog Stripe, Vercel, atau Uber.
PROMPT;
    }

    /**
     * Call Gemini API endpoint with model fallback.
     */
    protected function callGemini(string $prompt): ?array
    {
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'responseMimeType' => 'application/json',
                'temperature' => 0.7,
                'maxOutputTokens' => 8192
            ]
        ];

        foreach ($this->models as $model) {
            try {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";

                $response = Http::timeout(90)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, $payload);

                if ($response->successful()) {
                    $json = $response->json();
                    $rawText = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    
                    // Clean fences if any
                    $cleanText = trim(preg_replace('/^```(?:json)?\s*|\s*```$/i', '', trim($rawText)));
                    $data = json_decode($cleanText, true);

                    if (is_array($data) && !empty($data['title']) && !empty($data['content'])) {
                        return $data;
                    }
                } else {
                    Log::warning("Gemini model {$model} returned status {$response->status()}: " . substr($response->body(), 0, 200));
                }
            } catch (\Exception $e) {
                Log::warning("Error calling Gemini model {$model}: " . $e->getMessage());
            }
        }

        return null;
    }
}

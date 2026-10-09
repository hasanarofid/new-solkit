<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\ArticleGeneratorService;
use Illuminate\Console\Command;

class GenerateArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solkit:generate-article {topic? : Optional custom topic to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a high-value technical article using Gemini API for SEO and Google AdSense compliance';

    /**
     * Execute the console command.
     */
    public function handle(ArticleGeneratorService $generator): int
    {
        $customTopic = $this->argument('topic');

        $this->info('🚀 Memulai proses pembuatan artikel teknis dengan Gemini API...');
        if ($customTopic) {
            $this->line("📌 Topik spesifik: {$customTopic}");
        }

        $post = $generator->generateArticle($customTopic);

        if (!$post) {
            $this->error('❌ Gagal menghasilkan artikel. Periksa log atau konfigurasi GEMINI_API_KEY.');
            return Command::FAILURE;
        }

        $this->info("✅ Berhasil mempublikasikan artikel baru!");
        $this->line("   - Judul: {$post->title}");
        $this->line("   - Kategori: " . ($post->category->name ?? 'Uncategorized'));
        $this->line("   - Slug: {$post->slug}");
        $this->line("   - URL: " . url("/blog/{$post->slug}"));

        // Auto-update sitemap.xml
        $this->updateSitemap();

        return Command::SUCCESS;
    }

    /**
     * Regenerate public/sitemap.xml with latest blog posts.
     */
    protected function updateSitemap(): void
    {
        try {
            $posts = Post::where('status', 'published')->orderBy('updated_at', 'desc')->get();
            $baseUrl = rtrim(config('app.url', 'https://solkit.tech'), '/');
            $now = now()->toIso8601String();

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

            // Static pages
            $xml .= "  <url><loc>{$baseUrl}/</loc><lastmod>{$now}</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>" . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/blog</loc><lastmod>{$now}</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>" . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/privacy-policy</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>" . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/terms-of-service</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>" . PHP_EOL;

            // Blog posts
            foreach ($posts as $post) {
                $postUrl = "{$baseUrl}/blog/{$post->slug}";
                $postDate = $post->updated_at ? $post->updated_at->toIso8601String() : $now;
                $xml .= "  <url><loc>{$postUrl}</loc><lastmod>{$postDate}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>" . PHP_EOL;
            }

            $xml .= '</urlset>' . PHP_EOL;

            file_put_contents(public_path('sitemap.xml'), $xml);
            $this->info("🗺️  Sitemap public/sitemap.xml berhasil diperbarui dengan {$posts->count()} artikel!");
        } catch (\Exception $e) {
            $this->warn("⚠️  Peringatan saat memperbarui sitemap: " . $e->getMessage());
        }
    }
}

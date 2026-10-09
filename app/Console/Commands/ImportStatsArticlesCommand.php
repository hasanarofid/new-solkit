<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Console\Command;
use PDO;

class ImportStatsArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solkit:import-stats-articles {db_path? : Path to stats.db file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import articles from hasanarofid.site stats.db into SOLKIT posts table';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $dbPath = $this->argument('db_path') ?: '/home/hasanarofid/Documents/hasanarofid.site/stats.db';

        if (!file_exists($dbPath)) {
            $this->error("Database file tidak ditemukan di: {$dbPath}");
            return Command::FAILURE;
        }

        try {
            $sqlite = new PDO("sqlite:{$dbPath}");
            $sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $articles = $sqlite->query("SELECT * FROM articles")->fetchAll(PDO::FETCH_ASSOC);
            $this->info("Menemukan " . count($articles) . " artikel di stats.db. Memulai impor...");

            // Default categories
            $categories = [
                'Web Development' => Category::firstOrCreate(['slug' => 'web-development'], ['name' => 'Web Development']),
                'Arsitektur Web' => Category::firstOrCreate(['slug' => 'arsitektur-web'], ['name' => 'Arsitektur Web']),
                'DevOps & Cloud' => Category::firstOrCreate(['slug' => 'devops-cloud'], ['name' => 'DevOps & Cloud']),
                'Kecerdasan Buatan' => Category::firstOrCreate(['slug' => 'ai-automation'], ['name' => 'Kecerdasan Buatan & AI']),
                'Teknologi' => Category::firstOrCreate(['slug' => 'technology'], ['name' => 'Teknologi']),
            ];

            $imported = 0;
            foreach ($articles as $art) {
                $title = trim($art['title']);
                $slug = trim($art['slug']);
                $content = $art['content'];

                // Select matching category based on keywords in title
                $cat = $categories['Teknologi'];
                if (stripos($title, 'Laravel') !== false || stripos($title, 'PHP') !== false || stripos($title, 'MySQL') !== false || stripos($title, 'PostgreSQL') !== false) {
                    $cat = $categories['Web Development'];
                } elseif (stripos($title, 'AI') !== false || stripos($title, 'Intelligence') !== false) {
                    $cat = $categories['Kecerdasan Buatan'];
                } elseif (stripos($title, 'Docker') !== false || stripos($title, 'Cloud') !== false || stripos($title, 'Vitals') !== false || stripos($title, 'SEO') !== false) {
                    $cat = $categories['DevOps & Cloud'];
                } elseif (stripos($title, 'React') !== false || stripos($title, 'Vue') !== false || stripos($title, 'Arsitektur') !== false) {
                    $cat = $categories['Arsitektur Web'];
                }

                Post::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $cat->id,
                        'title' => $title,
                        'content' => $content,
                        'status' => 'published',
                        'is_featured' => ($imported < 3),
                        'created_at' => $art['created_at'] ?? now(),
                        'updated_at' => now(),
                    ]
                );

                $imported++;
            }

            $this->info("✅ Berhasil mengimpor {$imported} artikel ke SOLKIT posts table!");

            // Update sitemap
            $posts = Post::where('status', 'published')->orderBy('updated_at', 'desc')->get();
            $baseUrl = rtrim(config('app.url', 'https://solkit.tech'), '/');
            $now = now()->toIso8601String();
            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/</loc><lastmod>{$now}</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>" . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/blog</loc><lastmod>{$now}</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>" . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/privacy-policy</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>" . PHP_EOL;
            $xml .= "  <url><loc>{$baseUrl}/terms-of-service</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>" . PHP_EOL;
            foreach ($posts as $post) {
                $postDate = $post->updated_at ? $post->updated_at->toIso8601String() : $now;
                $xml .= "  <url><loc>{$baseUrl}/blog/{$post->slug}</loc><lastmod>{$postDate}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>" . PHP_EOL;
            }
            $xml .= '</urlset>' . PHP_EOL;
            file_put_contents(public_path('sitemap.xml'), $xml);
            $this->info("🗺️  Sitemap public/sitemap.xml berhasil diperbarui dengan {$posts->count()} artikel!");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Gagal mengimpor artikel: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}

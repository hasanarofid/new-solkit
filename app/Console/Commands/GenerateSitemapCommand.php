<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate and refresh public/sitemap.xml with canonical URLs';

    public function handle(): int
    {
        $baseUrl = 'https://solkit.tech';
        $now = now()->toIso8601String();

        $posts = Post::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        // Static Pages
        $xml .= "  <url><loc>{$baseUrl}/</loc><lastmod>{$now}</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>" . PHP_EOL;
        $xml .= "  <url><loc>{$baseUrl}/blog</loc><lastmod>{$now}</lastmod><changefreq>daily</changefreq><priority>0.9</priority></url>" . PHP_EOL;
        $xml .= "  <url><loc>{$baseUrl}/privacy-policy</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>" . PHP_EOL;
        $xml .= "  <url><loc>{$baseUrl}/terms-of-service</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.5</priority></url>" . PHP_EOL;

        // Dynamic Published Articles
        foreach ($posts as $post) {
            $postUrl = "{$baseUrl}/blog/{$post->slug}";
            $postDate = $post->updated_at ? $post->updated_at->toIso8601String() : $now;
            $xml .= "  <url><loc>{$postUrl}</loc><lastmod>{$postDate}</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>" . PHP_EOL;
        }

        $xml .= '</urlset>' . PHP_EOL;

        file_put_contents(public_path('sitemap.xml'), $xml);

        $this->info("🗺️  Sitemap public/sitemap.xml berhasil digenerate dengan {$posts->count()} artikel pada domain {$baseUrl}!");

        return Command::SUCCESS;
    }
}

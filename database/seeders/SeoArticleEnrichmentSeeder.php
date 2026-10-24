<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class SeoArticleEnrichmentSeeder extends Seeder
{
    /**
     * Run the database seeds for enriched SEO articles.
     */
    public function run(): void
    {
        Artisan::call('solkit:enrich-seo');
    }
}

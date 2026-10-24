<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php
            $component = $page['component'] ?? '';
            $props = $page['props'] ?? [];
            
            // Enforce authoritative canonical URL on https://solkit.tech
            $baseDomain = 'https://solkit.tech';
            $cleanPath = '/' . ltrim(parse_url(request()->getRequestUri(), PHP_URL_PATH) ?? '/', '/');
            $canonicalUrl = $cleanPath === '/' ? $baseDomain : $baseDomain . rtrim($cleanPath, '/');

            // Default Branding & Meta
            $defaultTitle = 'SOLKIT - Solusi Kode Kita | Studio Rekayasa Perangkat Lunak & Sistem Digital Surabaya';
            $defaultDescription = 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak di Surabaya untuk pembuatan custom web application, sistem mobile iOS & Android, arsitektur cloud, dan otomatisasi AI berskala enterprise.';
            $defaultImage = "{$baseDomain}/images/og-share.jpg";
            $type = 'website';

            // Dynamic detection
            if ($component === 'Blog/Show' && isset($props['post'])) {
                $post = $props['post'];
                $canonicalUrl = "{$baseDomain}/blog/{$post['slug']}";
                $metaTitle = ($post['title'] ?? 'Artikel') . ' - SOLKIT Insight';
                $metaDescription = !empty($post['content']) 
                    ? \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($post['content']))), 160)
                    : $defaultDescription;
                $metaImage = !empty($post['image_url']) ? url($post['image_url']) : $defaultImage;
                $type = 'article';
            } elseif ($component === 'Blog/Index') {
                $canonicalUrl = "{$baseDomain}/blog";
                $metaTitle = 'Blog & Panduan Rekayasa Software - SOLKIT (Solusi Kode Kita)';
                $metaDescription = 'Koleksi artikel teknis, arsitektur cloud, performa web, dan panduan rekayasa sistem enterprise oleh para engineer SOLKIT Surabaya.';
                $metaImage = $defaultImage;
            } elseif ($component === 'Legal/PrivacyPolicy') {
                $canonicalUrl = "{$baseDomain}/privacy-policy";
                $metaTitle = 'Kebijakan Privasi (Privacy Policy) - SOLKIT';
                $metaDescription = 'Kebijakan privasi resmi SOLKIT (Solusi Kode Kita) mengenai pemrosesan data, penggunaan cookie, dan kepatuhan standar industri digital.';
                $metaImage = $defaultImage;
            } elseif ($component === 'Legal/TermsOfService') {
                $canonicalUrl = "{$baseDomain}/terms-of-service";
                $metaTitle = 'Syarat & Ketentuan Layanan (Terms of Service) - SOLKIT';
                $metaDescription = 'Syarat dan ketentuan perjanjian layanan rekayasa perangkat lunak dan konsultasi teknologi digital SOLKIT.';
                $metaImage = $defaultImage;
            } else {
                $metaTitle = $defaultTitle;
                $metaDescription = $defaultDescription;
                $metaImage = $defaultImage;
            }
        ?>

        <!-- Primary SEO Meta Tags -->
        <title inertia>{{ $metaTitle }}</title>
        <meta name="title" content="{{ $metaTitle }}">
        <meta name="description" content="{{ $metaDescription }}">
        <meta name="keywords" content="software house surabaya, jasa pembuatan aplikasi surabaya, jasa website custom surabaya, web development surabaya, mobile app ios android surabaya, arsitektur sistem digital, rekayasa perangkat lunak jawa timur, solusi kode kita, solkit tech, ai automation indonesia">
        <meta name="author" content="Hasan Arofid - SOLKIT (Solusi Kode Kita)">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <!-- Google Search Console Verification -->
        <meta name="google-site-verification" content="A1v60g8eChf7ZcmSIzFO9lLZVvjDjFOHAmZcnby5WC0">

        <!-- Local GEO Meta Tags (Surabaya, Jawa Timur, Indonesia) -->
        <meta name="geo.region" content="ID-JI">
        <meta name="geo.placename" content="Surabaya">
        <meta name="geo.position" content="-7.257472;112.752088">
        <meta name="ICBM" content="-7.257472, 112.752088">

        <!-- Open Graph / Facebook / WhatsApp Preview Meta Tags -->
        <meta property="og:site_name" content="SOLKIT (Solusi Kode Kita)">
        <meta property="og:type" content="{{ $type }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:image" content="{{ $metaImage }}">
        <meta property="og:image:secure_url" content="{{ $metaImage }}">
        <meta property="og:image:type" content="image/jpeg">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="SOLKIT - Studio Rekayasa Perangkat Lunak Surabaya">
        <meta property="og:locale" content="id_ID">

        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@solkittech">
        <meta name="twitter:creator" content="@hasanarofid">
        <meta name="twitter:url" content="{{ $canonicalUrl }}">
        <meta name="twitter:title" content="{{ $metaTitle }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
        <meta name="twitter:image" content="{{ $metaImage }}">

        <!-- Favicon & Touch Icons (Multi-format support for Chrome, Safari, Firefox, Edge) -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}?v=2">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=2">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
        <meta name="msapplication-TileColor" content="#07080E">
        <meta name="theme-color" content="#07080E">

        <!-- Google AdSense Verification -->
        <meta name="google-adsense-account" content="ca-pub-7190047001129861">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7190047001129861" crossorigin="anonymous"></script>

        <!-- Structured Data Organization Schema (JSON-LD) -->
        <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'ProfessionalService',
          'name' => 'SOLKIT (Solusi Kode Kita)',
          'alternateName' => 'Solkit Tech Software House',
          'url' => 'https://solkit.tech',
          'logo' => asset('images/solkit-dark.svg'),
          'image' => asset('images/og-share.jpg'),
          'description' => 'Studio rekayasa perangkat lunak enterprise untuk custom web application, sistem mobile, dan otomatisasi AI.',
          'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Surabaya',
            'addressRegion' => 'Jawa Timur',
            'addressCountry' => 'ID',
          ],
          'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => -7.257472,
            'longitude' => 112.752088,
          ],
          'founder' => [
            '@type' => 'Person',
            'name' => 'Hasan Arofid',
            'jobTitle' => 'Principal Software Architect',
          ],
          'areaServed' => ['Surabaya', 'Jawa Timur', 'Indonesia', 'Global'],
          'priceRange' => '$$',
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>

        @if ($component === 'Blog/Show' && isset($props['post']))
        <!-- Article Structured Data (Schema.org) for Google Search Article Rich Snippets -->
        <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'TechArticle',
          'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => $canonicalUrl,
          ],
          'headline' => $post['title'] ?? $metaTitle,
          'description' => $metaDescription,
          'image' => [$metaImage],
          'datePublished' => isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->toIso8601String() : now()->toIso8601String(),
          'dateModified' => isset($post['updated_at']) ? \Carbon\Carbon::parse($post['updated_at'])->toIso8601String() : (isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->toIso8601String() : now()->toIso8601String()),
          'author' => [
            '@type' => 'Person',
            'name' => 'Hasan Arofid',
            'url' => 'https://solkit.tech',
            'jobTitle' => 'Principal Software Architect',
          ],
          'publisher' => [
            '@type' => 'Organization',
            'name' => 'SOLKIT (Solusi Kode Kita)',
            'url' => 'https://solkit.tech',
            'logo' => [
              '@type' => 'ImageObject',
              'url' => "{$baseDomain}/images/solkit-dark.svg",
            ],
          ],
          'articleSection' => $post['category']['name'] ?? 'Technology',
          'inLanguage' => 'id-ID',
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>

        <!-- BreadcrumbList Schema for Google Search Hierarchy -->
        <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'BreadcrumbList',
          'itemListElement' => [
            [
              '@type' => 'ListItem',
              'position' => 1,
              'name' => 'Beranda',
              'item' => $baseDomain,
            ],
            [
              '@type' => 'ListItem',
              'position' => 2,
              'name' => 'Blog & Riset',
              'item' => "{$baseDomain}/blog",
            ],
            [
              '@type' => 'ListItem',
              'position' => 3,
              'name' => $post['title'] ?? 'Artikel',
              'item' => $canonicalUrl,
            ],
          ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
        @elseif ($component === 'Blog/Index')
        <!-- BreadcrumbList Schema for Blog Index -->
        <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'BreadcrumbList',
          'itemListElement' => [
            [
              '@type' => 'ListItem',
              'position' => 1,
              'name' => 'Beranda',
              'item' => $baseDomain,
            ],
            [
              '@type' => 'ListItem',
              'position' => 2,
              'name' => 'Blog & Riset',
              'item' => "{$baseDomain}/blog",
            ],
          ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
        @elseif ($component === 'Legal/TermsOfService')
        <!-- BreadcrumbList Schema for Terms of Service -->
        <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'BreadcrumbList',
          'itemListElement' => [
            [
              '@type' => 'ListItem',
              'position' => 1,
              'name' => 'Beranda',
              'item' => $baseDomain,
            ],
            [
              '@type' => 'ListItem',
              'position' => 2,
              'name' => 'Syarat & Ketentuan Layanan',
              'item' => "{$baseDomain}/terms-of-service",
            ],
          ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
        @elseif ($component === 'Legal/PrivacyPolicy')
        <!-- BreadcrumbList Schema for Privacy Policy -->
        <script type="application/ld+json">
        {!! json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'BreadcrumbList',
          'itemListElement' => [
            [
              '@type' => 'ListItem',
              'position' => 1,
              'name' => 'Beranda',
              'item' => $baseDomain,
            ],
            [
              '@type' => 'ListItem',
              'position' => 2,
              'name' => 'Kebijakan Privasi',
              'item' => "{$baseDomain}/privacy-policy",
            ],
          ],
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-[#07080E] text-slate-100 selection:bg-[#0052FF] selection:text-white">
        @inertia

        <noscript>
            @if ($component === 'Blog/Show' && isset($props['post']))
                <article style="max-width: 800px; margin: 40px auto; padding: 20px; font-family: sans-serif; color: #cbd5e1;">
                    <h1 style="color: #ffffff; font-size: 2rem;">{{ $props['post']['title'] ?? '' }}</h1>
                    <p style="color: #94a3b8; font-size: 0.875rem;">Kategori: {{ $props['post']['category']['name'] ?? 'Teknologi' }} | Penulis: Hasan Arofid</p>
                    <div style="line-height: 1.8; margin-top: 20px;">{!! $props['post']['content'] ?? '' !!}</div>
                </article>
            @elseif ($component === 'Legal/TermsOfService')
                <article style="max-width: 800px; margin: 40px auto; padding: 20px; font-family: sans-serif; color: #cbd5e1;">
                    <h1 style="color: #ffffff; font-size: 2rem;">Syarat dan Ketentuan Layanan (Terms of Service) - SOLKIT</h1>
                    <p style="color: #94a3b8; font-size: 0.875rem;">Terakhir diperbarui: 24 Oktober 2026</p>
                    <p>Syarat dan ketentuan perjanjian layanan rekayasa perangkat lunak dan konsultasi teknologi digital SOLKIT.</p>
                </article>
            @endif
        </noscript>
    </body>
</html>

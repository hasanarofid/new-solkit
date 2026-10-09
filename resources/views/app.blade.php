<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <?php
            $component = $page['component'] ?? '';
            $props = $page['props'] ?? [];
            $currentUrl = url()->current();

            // Default Branding & Meta
            $defaultTitle = 'SOLKIT - Solusi Kode Kita | Studio Rekayasa Perangkat Lunak & Sistem Digital Surabaya';
            $defaultDescription = 'SOLKIT (Solusi Kode Kita) adalah studio rekayasa perangkat lunak di Surabaya untuk pembuatan custom web application, sistem mobile iOS & Android, arsitektur cloud, dan otomatisasi AI berskala enterprise.';
            $defaultImage = asset('images/og-share.jpg');
            $type = 'website';

            // Dynamic detection
            if ($component === 'Blog/Show' && isset($props['post'])) {
                $post = $props['post'];
                $metaTitle = ($post['title'] ?? 'Artikel') . ' - SOLKIT Insight';
                $metaDescription = !empty($post['content']) 
                    ? \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($post['content']))), 160)
                    : $defaultDescription;
                $metaImage = !empty($post['image_url']) ? url($post['image_url']) : $defaultImage;
                $type = 'article';
            } elseif ($component === 'Blog/Index') {
                $metaTitle = 'Blog & Panduan Rekayasa Software - SOLKIT (Solusi Kode Kita)';
                $metaDescription = 'Koleksi artikel teknis, arsitektur cloud, performa web, dan panduan rekayasa sistem enterprise oleh para engineer SOLKIT Surabaya.';
                $metaImage = $defaultImage;
            } elseif ($component === 'Legal/PrivacyPolicy') {
                $metaTitle = 'Kebijakan Privasi (Privacy Policy) - SOLKIT';
                $metaDescription = 'Kebijakan privasi resmi SOLKIT (Solusi Kode Kita) mengenai pemrosesan data, penggunaan cookie, dan kepatuhan standar industri digital.';
                $metaImage = $defaultImage;
            } elseif ($component === 'Legal/TermsOfService') {
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
        <link rel="canonical" href="{{ $currentUrl }}">

        <!-- Local GEO Meta Tags (Surabaya, Jawa Timur, Indonesia) -->
        <meta name="geo.region" content="ID-JI">
        <meta name="geo.placename" content="Surabaya">
        <meta name="geo.position" content="-7.257472;112.752088">
        <meta name="ICBM" content="-7.257472, 112.752088">

        <!-- Open Graph / Facebook / WhatsApp Preview Meta Tags -->
        <meta property="og:site_name" content="SOLKIT (Solusi Kode Kita)">
        <meta property="og:type" content="{{ $type }}">
        <meta property="og:url" content="{{ $currentUrl }}">
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
        <meta name="twitter:url" content="{{ $currentUrl }}">
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
        <meta name="msapplication-TileColor" content="#090A0E">
        <meta name="theme-color" content="#07080B">

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
          'logo' => asset('images/solkit-clean.png'),
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

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased bg-[#07080B] text-slate-100 selection:bg-blue-600 selection:text-white">
        @inertia
    </body>
</html>

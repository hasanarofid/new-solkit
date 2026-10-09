<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, BookOpen } from '@lucide/vue';
import FloatingWhatsApp from '@/Components/FloatingWhatsApp.vue';

defineProps({
  settings: {
    type: Object,
    required: true
  }
});
</script>

<template>
  <Head title="Syarat dan Ketentuan (Terms of Service) | SOLKIT">
    <meta name="description" content="Syarat dan Ketentuan layanan rekayasa perangkat lunak dan penggunaan konten di situs SOLKIT (Solusi Kode Kita)." />
    <meta name="robots" content="index, follow" />
  </Head>

  <div class="min-h-screen bg-[#090A0E] text-slate-100 font-sans selection:bg-[#0052FF] selection:text-white">
    <header class="sticky top-0 z-50 bg-[#090A0E]/80 backdrop-blur-xl border-b border-white/[0.08]">
      <div class="max-w-5xl mx-auto px-6 h-20 flex items-center justify-between">
        <Link href="/" class="flex items-center gap-3">
          <img :src="settings.site_logo_url || '/images/solkit-dark.svg'" alt="SOLKIT" class="h-9 w-auto" />
        </Link>
        <Link href="/" class="text-xs font-semibold text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
          <ArrowLeft class="w-3.5 h-3.5" /> Beranda
        </Link>
      </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-16 space-y-10 text-sm leading-relaxed text-slate-300">
      <div class="space-y-4 border-b border-white/[0.08] pb-8">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-sky-400 text-xs font-mono">
          <BookOpen class="w-3.5 h-3.5" /> LEGAL AGREEMENT
        </div>
        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Syarat dan Ketentuan (Terms of Service)</h1>
        <p class="text-xs font-mono text-slate-500">Terakhir diperbarui: 9 Oktober 2026</p>
      </div>

      <div class="space-y-6">
        <h2 class="text-xl font-bold text-white">1. Ketentuan Umum</h2>
        <p>
          Dengan mengakses situs web SOLKIT yang beralamat di https://solkit.tech, Anda setuju untuk terikat oleh Syarat dan Ketentuan Layanan ini, semua hukum dan peraturan yang berlaku, dan setuju bahwa Anda bertanggung jawab untuk mematuhi hukum setempat yang berlaku.
        </p>

        <h2 class="text-xl font-bold text-white">2. Lisensi Konten</h2>
        <p>
          Materi dan artikel teknis yang ditampilkan di situs SOLKIT dilindungi oleh undang-undang hak cipta dan merek dagang yang berlaku. Pengunjung diizinkan untuk membaca, membagikan kutipan dengan atribusi yang jelas, namun dilarang keras untuk menduplikasi seluruh artikel secara otomatis (scraping) tanpa izin tertulis dari manajemen SOLKIT.
        </p>

        <h2 class="text-xl font-bold text-white">3. Layanan Rekayasa Perangkat Lunak</h2>
        <p>
          SOLKIT menyediakan layanan konsultasi, arsitektur cloud, pembuatan website kustom, aplikasi mobile, dan solusi AI. Setiap perikatan proyek komersial tunduk pada Perjanjian Kerja Sama (PKS) dan Dokumen Spesifikasi Kebutuhan Perangkat Lunak (PRD) tersendiri yang disepakati oleh kedua belah pihak.
        </p>

        <h2 class="text-xl font-bold text-white">4. Penafian (Disclaimer)</h2>
        <p>
          Materi pada situs web SOLKIT disediakan atas dasar "sebagaimana adanya". SOLKIT tidak memberikan jaminan, tersurat maupun tersirat, mengenai keakuratan atau keandalan penggunaan materi dalam artikel blog di luar konteks teknis yang dijelaskan.
        </p>

        <h2 class="text-xl font-bold text-white">5. Perubahan Ketentuan</h2>
        <p>
          SOLKIT dapat merevisi Syarat Layanan ini untuk situs webnya setiap saat tanpa pemberitahuan sebelumnya. Dengan menggunakan situs web ini, Anda setuju untuk terikat oleh versi Syarat Layanan yang berlaku saat itu.
        </p>
      </div>
    </main>

    <footer class="py-8 border-t border-white/[0.06] text-center text-xs text-slate-500">
      © {{ new Date().getFullYear() }} SOLKIT (Solusi Kode Kita). Seluruh hak cipta dilindungi.
    </footer>

    <!-- Floating WhatsApp Button -->
    <FloatingWhatsApp :phone-number="settings.whatsapp_number || '628814959247'" />
  </div>
</template>
